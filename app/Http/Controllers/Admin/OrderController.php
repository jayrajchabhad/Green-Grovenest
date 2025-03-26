<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Mail\InvoiceOrderMailable;
use Illuminate\Support\Facades\Mail;
use MongoDB\BSON\UTCDateTime;

class OrderController extends Controller
{
    public function index(Request $request) 
    {
        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate(10);

        $todayDate = Carbon::now()->format('Y-m-d');
   

        $orders = Order::when($request->date != null, function ($q) use ($request) {
                $startOfDay = new UTCDateTime(Carbon::parse($request->date)->startOfDay()->timestamp * 1000);
                $endOfDay = new UTCDateTime(Carbon::parse($request->date)->endOfDay()->timestamp * 1000);

                return $q->whereBetween('created_at', [$startOfDay, $endOfDay]);

                }, function ($q) use ($todayDate) {
                $startOfToday = new UTCDateTime(Carbon::parse($todayDate)->startOfDay()->timestamp * 1000);
                $endOfToday = new UTCDateTime(Carbon::parse($todayDate)->endOfDay()->timestamp * 1000);

                return $q->whereBetween('created_at', [$startOfToday, $endOfToday]);

                })
                ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status_message', $request->status);
                })
                ->paginate(10);


        return view("admin.orders.index",compact("orders"));
    }
    public function show( $orderId)
    {
        $order = Order::where('_id',$orderId)->first();
        if($order){
            return view("admin.orders.view",compact("order")); 
        }
        else{
            return redirect("admin/orders")->with("message","Order Id Not Found");
        }
    }
    public function updateOrderStatus( $orderId , Request $request)
    {
        $order = Order::where('_id',$orderId)->first();
        if($order){
            $order->update([
                'status_message' => $request->order_status 
            ]);
            return redirect("admin/ordersdetail/".$orderId )->with("message","Order Status Updated"); 
        }
        else{
            return redirect("admin/ordersdetail/".$orderId)->with("message","Order Id Not Found");
        } 
    }
    public function viewInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice',compact('order'));
    }
    
    public function generateInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }



    public function mailInvoice( $orderId)
    {
        try{
            $order = Order::findOrFail($orderId);

            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect('admin/ordersdetail/'.$orderId)->with('message','Invoice Mail has been sent to '.$order->email);

        }catch(\Exception $e){

            return redirect('admin/ordersdetail/'.$orderId)->with('message','Something Went Wrong.!');
        }

    }
}
