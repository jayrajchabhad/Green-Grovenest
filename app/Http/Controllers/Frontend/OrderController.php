<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where("user_id", auth()->user()->id)
                       ->orderBy("created_at", "desc")
                       ->paginate(10);
    
        return view("frontend.orders.index", compact("orders"));
    }
    
    public function show($orderId)
    {
        // Ensure the orderId is converted to MongoDB ObjectId
        try {
            $order = Order::where("user_id", auth()->user()->id)
                          ->where('_id', new ObjectId($orderId))
                          ->first();
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "Invalid Order ID");
        }
    
        if ($order) {
            return view("frontend.orders.view", compact("order"));
        } else {
            return redirect()->back()->with("message", "No Order Found");
        }
    }
}
