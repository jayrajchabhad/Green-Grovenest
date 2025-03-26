<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\cart;
use Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;

    protected $listeners = ['CartAddedUpadate' => 'checkCartCount'];

    public function checkCartCount()
    {
        if(Auth::check())
        {
            return $this->cartCount = cart::where('user_id',auth()->user()->id)->count();
        }
        else{
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount(); 
        return view('livewire.frontend.cart.cart-count',[
            ' ' => $this->cartCount
        ]);
    }
}
