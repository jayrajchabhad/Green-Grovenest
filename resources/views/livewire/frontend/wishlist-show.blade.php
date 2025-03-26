<div class="mb-5">
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Wishlist</h4>
            <div class="underline "></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row text-white rounded p-1"  style="background-color: {{$appSetting->primary}}">
                                <div class="col-md-8">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                               
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse($wishlist as $wishlistItem)
                        @if ($wishlistItem->product)  
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-8 my-auto">
                                    <a href="{{ url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug )}}">
                                        <label class="product-name" style="color: #002349;">
                                            <img src="{{ $wishlistItem->product->productImages[0]->image}}" 
                                             style="width: 50px; height: 50px" alt="{{ $wishlistItem->product->name}}">
                                            {{ $wishlistItem->product->name}}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">₹{{ $wishlistItem->product->selling_price}} </label>
                                </div>
                             
                                <div class="col-md-2 col-12 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeWishlistItem('{{ $wishlistItem->_id }}')" class="btn text-white btn-danger btn-sm">
                                            <span wire:loading.remove wire:target="removeWishlistItem('{{ $wishlistItem->_id }}')">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                            <span wire:loading wire:target="removeWishlistItem('{{ $wishlistItem->_id }}')">
                                                <i class="fa fa-trash"></i> Removing
                                            </span>
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <br>
                        <h4>No wishlist Added</h4>
                        @endforelse
 
                                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <br><br><br><br><br><br><br>