<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\Cart;
use MongoDB\BSON\ObjectId;


class CartShow extends Component
{
    public $cart, $totalPrice = 0 ;


    public function removeCartItem($cartId)
    {
        $cartRemoveData = Cart::where('user_id', auth()->user()->id)
            ->where('_id', new ObjectId($cartId))
            ->first();

        if ($cartRemoveData) {
            $cartRemoveData->delete();
            $this->emit('CartAddedUpdate');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function incrementQuantity($cartId )
    {
         $cartData = cart::where('_id',$cartId)->where('user_id', auth()->user()->id)->first();
         if($cartData) {

            if($cartData->productColor()->where('_id',$cartData->product_color_id)->exists()){
                $productColor = $cartData->productColor()->where('_id',$cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity )
                {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                           'text' => 'quantty updated',
                           'type'=> 'success',
                           'status' => 200 
                           ]);

                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$productColor->quantity.' Quantity Available',
                        'type'=> 'info',
                        'status' => 200 
                        ]);
                }

        }else{
                if($cartData->product->quantity > $cartData->quantity)
                {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                           'text' => 'quantty updated',
                           'type'=> 'success',
                           'status' => 200 
                           ]);
                }
                else{
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cartData->product->quantity.' Quantity Available',
                        'type'=> 'info',
                        'status' => 200 
                        ]);
                }
            }
        
    
         }
         else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Somthing Went Wrong!',
                'type'=> 'error',
                'status' => 500
                ]);
         }
    }

    public function decrementQuantity($cartId){
        $cartData = cart::where('_id',$cartId)->where('user_id', auth()->user()->id)->first();
       
        if($cartData)
        {
                if($cartData->quantity > 1)
                {    

                        if($cartData->productColor()->where('_id',$cartData->product_color_id)->exists()){
                            $productColor = $cartData->productColor()->where('_id',$cartData->product_color_id)->first();
                        

                            
                            if($productColor->quantity >= $cartData->quantity  )
                            {
                                $cartData->decrement('quantity');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'quantty updated',
                                    'type'=> 'success',
                                    'status' => 200 
                                    ]);

                            }
                        
                            else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only '.$productColor->quantity.' Quantity Available',
                                    'type'=> 'info',
                                    'status' => 200 
                                    ]);
                            }

                        }else{
                            if($cartData->product->quantity >= $cartData->quantity)
                            {
                                $cartData->decrement ('quantity');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'quantty updated',
                                    'type'=> 'success',
                                    'status' => 200 
                                    ]);
                            }
                            else{
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only '.$cartData->product->quantity.' Quantity Available',
                                    'type'=> 'info',
                                    'status' => 200 
                                    ]);
                            }
                        }
                
            
                }
              
        }
        else
        {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Somthing Went Wrong!',
                    'type'=> 'error',
                    'status' => 500
                    ]);
        }
    }
    
    public function render()
    {
        $this->cart = cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }


    
}
