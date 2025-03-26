<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlists; // Ensure correct model name
use Illuminate\Support\Facades\Auth;

class WishlistShow extends Component
{
    public function removeWishlistItem(string $wishlistId)
    {
        Wishlists::where('user_id', Auth::id())->where('_id', $wishlistId)->delete(); // Use _id instead of id
    
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Item Removed Successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }
    

    public function render()
    {
        $wishlist = Wishlists::where('user_id', Auth::id())->get();
        return view('livewire.frontend.wishlist-show', ['wishlist' => $wishlist]);
    }
}
