<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <div class="underline"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row text-white rounded p-1" style="background-color: {{$appSetting->primary}}">
                                <div class="col-md-6"><h4>Products</h4></div>
                                <div class="col-md-1"><h4>Price</h4></div>
                                <div class="col-md-2"><h4>Quantity</h4></div>
                                <div class="col-md-1"><h4>Total</h4></div>
                                <div class="col-md-2"><h4>Remove</h4></div>
                            </div>
                        </div>

                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug)}}">
                                                @if($cartItem->productColor && $cartItem->productColor->color)
                                                        <span class="text-muted">Color: {{ $cartItem->productColor->color->name }}</span>
                                                @endif
                                                <label class="product-name" style="color:{{ $appSetting->primary }}">
                                                    <img src="{{ asset($cartItem->product->productImages[0]->image ?? '')}}" style="width: 50px; height: 50px" alt="">
                                                    {{ $cartItem->product->name }} <br>
                                                    
                                                </label> 
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">₹{{  $cartItem->product->selling_price }}</label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:click="decrementQuantity('{{ $cartItem->_id }}')" class="btn btn1">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input type="text" readonly value="{{$cartItem->quantity}}" class="input-quantity" />
                                                    <button type="button" wire:click="incrementQuantity('{{ $cartItem->_id }}')" class="btn btn1">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-1 my-auto">
                                            <label class="price">₹{{ $cartItem->product->selling_price * $cartItem->quantity }}</label>
                                        </div> --}}
                                        <div class="col-md-1 my-auto">
                                            <label class="price">₹{{  $cartItem->product->selling_price * $cartItem->quantity  }}</label>
                                             @php
                                             $totalPrice += $cartItem->product->selling_price * $cartItem->quantity
                                             @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:click="removeCartItem('{{ $cartItem->_id }}')" class="btn text-white btn-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem('{{ $cartItem->_id }}')">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem('{{ $cartItem->_id }}')">
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif  
                        @empty
                            <h4>No Cart Items available</h4>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>Get the best deals & Offers <a href="{{ url('collections')}}">Shop Now</a></h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm p-3">
                        <h4>Total: <span class="float-end">₹{{ $totalPrice }}</span></h4>
                        <hr>
                        <a href="{{url('/checkout')}}" class="btn text-white w-100" style="background-color: {{$appSetting->button}};"> Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
