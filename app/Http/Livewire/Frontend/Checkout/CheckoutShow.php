<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\PlaceOrderMailable;
use App\Models\Coupons;
use MongoDB\BSON\UTCDateTime;
use Carbon\Carbon;

use Livewire\Features\Placeholder;
use Mail;


class CheckoutShow extends Component
{
    public $carts,$totalProductAmount = 0; 
    
    public $fullname, $email ,$phone ,$pincode,$address,$payment_mode = null,$payment_id = null,$couponCode;

    public function rules(){
        return [
            "fullname"=> "required|string|max:121",
            "email"=> "required|email|max:121",
            "phone"=> "required|string|max:11|min:10",
            "pincode"=> "required|string|max:6|min:6",
            "address"=> "required|string|max:500",

        ];
    }
    public function placeOrder()
    {
        $this->validate();
    
        // Ensure total and discount amounts are calculated
        $this->totalProductAmount(); 
    
        $order = Order::create([
            'user_id'        => auth()->user()->id,          
            'tracking_no'    => 'greengrovenest-' . Str::random(10),
            'fullname'       => $this->fullname,     
            'email'          => $this->email,      
            'phone'          => $this->phone,       
            'pincode'        => $this->pincode,
            'address'        => $this->address,
            'status_message' => 'in progress',
            'payment_mode'   => $this->payment_mode,
            'payment_id'     => $this->payment_id,
            'original_price' => round($this->totalProductAmount), 
            'discount_price' => round($this->discountAmount),
            'total_amount'   => round($this->finalAmount),

        ]);
    
        foreach ($this->carts as $cartItem) {
            OrderItem::create([
                'order_id'          => $order->id,
                'product_id'        => $cartItem->product_id,
                'product_color_id'  => $cartItem->product_color_id,
                'quantity'          => $cartItem->quantity,       
                'price'             => $cartItem->product->selling_price 
            ]);
    
            // Update stock quantity
            if ($cartItem->product_color_id != null) {
                $productColor = $cartItem->productColor;
                if ($productColor) {
                    $productColor->update([
                        'quantity' => $productColor->quantity - $cartItem->quantity
                    ]);
                }
            } else {
                $product = $cartItem->product;
                if ($product) {
                    $product->update([
                        'quantity' => $product->quantity - $cartItem->quantity
                    ]);
                }
            }
            
            
        }
    
        return $order;
    }
    

    public function codOrder(){


        $this->payment_mode ='Cash on Delivery'; 
        $codOrder = $this->placeOrder();
        if($codOrder){

            cart::where('user_id', auth()->user()->id)->delete();

            try{
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                //mail sent successfully
            }catch(\Exception $e){
                //somthing want wrong
            }

            session()->flash('message','Order placed Successfuly');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type'=> 'success',
                'status' => 200 
            ]);
            return redirect()->to('thank-you');  
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Somthing went wrong',
                'type'=> 'error',
                'status' => 500
            ]);
        }
    }


    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = cart::where('user_id', auth()->user()->id)->get();

        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        // Apply coupon discount if a coupon is entered
        if ($this->couponCode) {
            $this->applyCoupon();
        } else {
            $this->discountAmount = 0;
        }

        // Calculate final amount after discount
        $this->finalAmount = $this->totalProductAmount - $this->discountAmount;

        return $this->finalAmount;
    }

    
    public function applyCoupon()
    {
        try {
            // Get current date in MongoDB UTCDateTime format
            $currentDate = new UTCDateTime(now()->timestamp * 1000);
    
            // Find the coupon details
            $coupon = Coupons::where('code', $this->couponCode)
                ->where('is_active', "0") // 0 for active
                ->where('valid_from', '<=', $currentDate)
                ->where('valid_until', '>=', $currentDate)
                ->first();
    
            if ($coupon) {
                // Calculate discount
                $this->discountAmount = ($this->totalProductAmount * floatval($coupon->discount_percentage)) / 100;
    
                // Apply "upto" limit if defined
                if ($coupon->upto_price && $this->discountAmount > floatval($coupon->upto_price)) {
                    $this->discountAmount = floatval($coupon->upto_price);
                }
    
                // Notify the user
                session()->flash('message', "Coupon Applied! You saved ₹" . number_format($this->discountAmount, 2));
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Coupon Applied Successfully!',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                // Invalid or expired coupon
                $this->discountAmount = 0;
                session()->flash('message', "Invalid or Expired Coupon");
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Invalid or Expired Coupon',
                    'type' => 'error',
                    'status' => 400
                ]); 
            }
        } catch (\Exception $e) {
            // Catch any errors and display message
            session()->flash('message', "Something went wrong! Please try again.");
            $this->dispatchBrowserEvent('message', [
                'text' => 'Error: ' . $e->getMessage(),
                'type' => 'error',
                'status' => 500
            ]);
        }
    }
    
    
    

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->userDetail->phone ?? '';
        $this->pincode = auth()->user()->userDetail->pin_code ?? '';
        $this->address = auth()->user()->userDetail->address ?? '';
        // $this->reset('couponCode');

 


        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount

            

        ]);




    }
}
