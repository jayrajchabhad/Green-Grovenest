@php
    $approvedReviews = $product->reviews->where('Approved', 1); // Only get approved reviews
    $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
    $ratingCount = $approvedReviews->count();
@endphp

<div>
    <div class="py-2 py-md-5">
        <div class="container">
            <div class="mx-3">
            <div class="row product">   

                <div class="col-lg-5 col-md-12 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if($product->productImages->count() > 0)
                            <div class="exzoom" id="exzoom">
                                <div class="exzoom_img_box">
                                    <ul class="exzoom_img_ul">
                                        @foreach ($product->productImages as $itemImg)
                                            <li><img src="{{ asset($itemImg->image) }}" class="img-fluid w-100"/></li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="img">
                                    <div class="exzoom_nav"></div>
                                    <p class="exzoom_btn">
                                        <a href="javascript:void(0);" class="exzoom_prev_btn">‹</a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn">›</a>
                                    </p>
                                </div> 
                            </div>
                        @else
                            <p class="text-center p-3">No Image Available</p>
                        @endif
                    </div>
                </div>


                <div class="col-md-7  mt-3">
                    <div class="product-view">
                        <h4 class="product-name">{{ $product->name }}</h4>
                        <hr>
                        <p class="product-path">Categories / {{ $product->category->name }} / {{ $product->brand }} / {{ $product->name }}</p>

                        <div class="d-flex align-items-center">
                            <span class="btn-sm text-black px-1 py-1 rounded">
                                {{ $averageRating ?? 0 }} 
                                <i class="fas fa-star" style="color: gold;"></i>
                            </span>
                            <br>
                            <span class="text-muted">
                                {{ $ratingCount ?? 0 }} Ratings
                            </span>
                        </div>
                        
                        
                        

                        
                        <div>
                            <span class="selling-price"> ₹{{ number_format($product->selling_price, 2) }}</span>
                            <span class="original-price">₹{{ number_format($product->original_price, 2) }} </span>
                        </div>
                        <br>
                        <div>
                            @if($product->productColors && $product->productColors->count() > 0)
                                @foreach ($product->productColors as $colorItem)
                                    @if (!empty($colorItem->color)) {{-- Ensure color exists --}}
                                    <label class="colorSelectionLabel" 
                                    style="background-color: {{ $colorItem->color->code ?? '#ffffff' }}; border: 1px solid black;"
                                    wire:click="colorSelected('{{ $colorItem->_id }}')">
                                    {{ substr($colorItem->color->name ?? '', 0, 1) }}
                                </label>
                                
                                    @endif
                                @endforeach
                        
                                {{-- Stock check after selecting color --}}
                                <div>
                                    @if ($this->prodColorSelectedQuantity === 'outOfStock')
                                        <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                    @elseif($this->prodColorSelectedQuantity > 0)
                                        <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                    @endif
                                </div>
                            @else
                                {{-- No color options, check default product stock --}}
                                @if ($product->quantity > 0)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @else
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                @endif
                            @endif
                        </div>
                        
                         

                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" readonly wire:model="quantityCount" value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                         
                        <div class="mt-2">
                           
                            <button wire:click="addToCart('{{ $product->_id }}')" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>

                            <button type="button" wire:click="addToWishlist('{{ $product->_id}}')" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishlist">
                                    Adding...
                                </span>
                            </button>
    
                        </div>
                        <hr>

                        <p>{!! $product->small_description !!}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="description-card">
                        <h4>Description</h4>
                        <p class="product-description" id="productDescription">
                            {!! $product->description !!}
                        </p>
                        <button class="read-more-btn" onclick="toggleDescription()" id="readMoreBtn">Read More</button>
                    </div>
                </div>
            </div>

            @if ($recommendedProducts->isNotEmpty())
            <div class="container my-4">
                <h4 class="fw-bold">Buy it with</h4>
            
                <div class="row align-items-center  rounded p-3">
                    @foreach ($recommendedProducts as $item)
                    <div class="col-12 col-sm-5 col-md-4 text-center">
                        <a href="#">
                            <img src="{{ asset($item->product->productImages[0]->image) }}" class="img-fluid w-100 rounded" style="max-width: 130px;">
                        </a>
                        <p class="fw-bold mb-0 text-dark mt-2">{{ $item->product->name }}</p>
                        <p class="text-muted mb-0">₹{{ $item->product->selling_price }}</p>
                    </div>
            
                    <!-- Plus Sign -->
                    <div class="col-12 col-sm-1 text-center my-2">
                        <span class="fs-2 fw-bold text-secondary">+</span>
                    </div>
            
                    <!-- Recommended Product -->
                    <div class="col-12 col-sm-5 col-md-4 text-center">
                        <a href="{{ url('/collections/'.$item->recommendedProduct->category->slug.'/'.$item->recommendedProduct->slug) }}">
                            <img src="{{ asset($item->recommendedProduct->productImages[0]->image) }}" class="img-fluid w-100 rounded" style="max-width: 130px;">
                        </a>
                        <p class="fw-bold mb-0 text-dark mt-2">{{ $item->recommendedProduct->name }}</p>    
                        <p class="text-muted mb-0">₹{{ $item->recommendedProduct->selling_price }}</p>
                    </div>
            
                    <!-- Total Price & Add to Cart Button -->
                    <div class="col-12 col-md-3 text-center text-md-end mt-3 mt-md-0">
                        <p class="fw-bold fs-5 text-center">Total price: ₹{{ $item->product->selling_price + $item->recommendedProduct->selling_price }}</p>
                        <button class="btn text-white fw-bold px-4 py-2 w-100 w-md-auto" style="background-color: {{ $appSetting->button }}" 
                                wire:click="addToCartboth([ '{{ $item->product->_id }}','{{ $item->recommendedProduct->_id }}'])">
                            <i class="fa fa-shopping-cart"></i> Add both to Cart
                        </button>
                        <p class="small text-muted mt-2 text-center">These items are dispatched from different sellers.</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif


            <div class="review-container">
                <h4 class="p-3">Customer Reviews 
                      
                        <span class="btn-sm text-muted float-end">
                            {{ $ratingCount }} Ratings 
                        </span>
                        <span class="btn-sm float-end" style="margin-left: 290px">
                            <i class="fas fa-star" style="color: gold;"> </i> {{ $averageRating }}/5
                        </span>
                        
                </h4>
                <br>
                <div class="p-2" style="max-height: 300px; overflow-y: auto;">
                    @foreach($approvedReviews as $review)
                        <div class="col-md-12">
                            <div class="review p-3 mb-3 border-bottom">
                                <strong>{{ $review->user->name }}  
                                    <span class="text-muted small float-end">
                                        {{ $review->created_at->format('d/M/Y') }}
                                    </span>
                                </strong>
                                <br>
                                <span class="review-stars text-warning">
                                    {!! str_repeat('<i class="fas fa-star"></i>', $review->rating) !!}
                                </span>
                                <p class="mt-2 text-muted">{{ $review->review }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
            
            



        </div>
    </div>


    

    


 
    

    
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Related 
                        @if ($category)
                            {{$category->name}}
                        @endif
                        Products</h3>
                    <div class="underline"></div>
                </div>


                <div class="col-md-12">
                    @if ($category)
                    <div class="owl-carousel owl-theme four-cuarousel">
                    
                    @foreach($category->reletedproducts as $reletedproductitem)
                        <div class="item mb-3">
                            <div class="product-card border-0 rounded-lg overflow-hidden rounded">  
                                <div class="product-card-img">

                                    @php
                                        // Ensure only approved reviews are used
                                        $approvedReviews = $reletedproductitem->reviews->where('Approved', 1); // Only get approved reviews
                                        $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                                        // Calculate star breakdown
                                        $fullStars = floor($averageRating);
                                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStar);
                                    @endphp
                                    
                                    <div class="flex items-center space-x-1 float-end m-1 text-muted">
                                        {{-- Full stars --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @endfor
                                    
                                        {{-- Half star --}}
                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                                        @endif
                                    
                                        {{-- Empty stars --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star text-gray-400"></i>
                                        @endfor
                                    
                                        {{-- Display numeric rating --}}
                                        <span class="ml-2 text-gray-600 text-sm">{{ number_format($averageRating, 1) }}/5</span>
                                    </div>
                                    
                                    @if ($reletedproductitem->quantity > 0)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">In Stock</span>

                                    @else
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Out Of Stock</span>
                                    @endif

                                    @if ($reletedproductitem->productImages->count() > 0)
                                        <a href="{{ url(path: '/collections/'.$reletedproductitem->category->slug.'/'.$reletedproductitem->slug) }}">
                                            <img src="{{ asset($reletedproductitem->productImages[0]->image)}}" alt="{{ $reletedproductitem->name }}">
                                        </a>     
                                    @endif

                                </div>
                                <div class="p-4 text-center bg-white">
                                    <p class="text-muted text-uppercase small mb-1">{{ $reletedproductitem->brand }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$reletedproductitem->category->slug.'/'.$reletedproductitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                            {{ $reletedproductitem->name }}
                                        </a>
                                    </h5>
                                    <hr>
                                    <div class="price mt-2">
                                        <span class="selling-price h5">₹{{ number_format($reletedproductitem->selling_price, 2) }}</span>
                                        <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($reletedproductitem->original_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    @endforeach
                </div>    
                @else
                    <div class="col-md-12 p-2">
                        <h4>No Related Products Available </h4>
                    </div>
                @endif 
            </div>   
            </div>    
        </div>
    </div>

    <div class="py-3 py-md-5" style="background-color:{{$appSetting->home}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related 
                        @if ($product)
                            {{$product->brand}}
                        @endif
                        Products</h3>
                    <div class="underline"></div>
                </div>
                    
                <div class="col-md-12 ">
                    @if ($category)
                    <div class="owl-carousel owl-theme ">

                            @foreach($category->reletedproducts as $reletedproductitem)
                                @if ($reletedproductitem->brand == "$product->brand")                    
                                        <div class="item mb-3 ">
                                            <div class="product-card border-0 rounded-lg overflow-hidden rounded">  
                                                <div class="product-card-img">

                                                    @php
                                                        // Ensure only approved reviews are used
                                                        $approvedReviews = $reletedproductitem->reviews->where('Approved', 1); // Only get approved reviews
                                                        $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                                                        // Calculate star breakdown
                                                        $fullStars = floor($averageRating);
                                                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                                        $emptyStars = 5 - ($fullStars + $halfStar);
                                                    @endphp
                                                    
                                                    <div class="flex items-center space-x-1 float-end m-1 text-muted">
                                                        {{-- Full stars --}}
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fas fa-star text-yellow-500"></i>
                                                        @endfor
                                                    
                                                        {{-- Half star --}}
                                                        @if ($halfStar)
                                                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                                                        @endif
                                                    
                                                        {{-- Empty stars --}}
                                                        @for ($i = 0; $i < $emptyStars; $i++)
                                                            <i class="far fa-star text-gray-400"></i>
                                                        @endfor
                                                    
                                                        {{-- Display numeric rating --}}
                                                        <span class="ml-2 text-gray-600 text-sm">{{ number_format($averageRating, 1) }}/5</span>
                                                    </div>
                                                    
                                                    @if ($reletedproductitem->quantity > 0)
                                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">In Stock</span>

                                                    @else
                                                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Out Of Stock</span>
                                                    @endif


                                                    @if ($reletedproductitem->productImages->count() > 0)
                                                        <a href="{{ url(path: '/collections/'.$reletedproductitem->category->slug.'/'.$reletedproductitem->slug) }}">
                                                            <img src="{{ asset($reletedproductitem->productImages[0]->image)}}" alt="{{ $reletedproductitem->name }}">
                                                        </a>     
                                                    @endif

                                                </div>
                                                <div class="p-4 text-center bg-white">
                                                    <p class="text-muted text-uppercase small mb-1">{{ $reletedproductitem->brand }}</p>
                                                    <h5 class="product-name">
                                                        <a href="{{ url('/collections/'.$reletedproductitem->category->slug.'/'.$reletedproductitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                                            {{ $reletedproductitem->name }}
                                                        </a>
                                                    </h5>
                                                    <hr>
                                                    <div class="price mt-2">
                                                        <span class="selling-price h5">₹{{ number_format($reletedproductitem->selling_price, 2) }}</span>
                                                        <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($reletedproductitem->original_price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    @endif

                            @endforeach
                    </div>    
                    @else
                    <div class="col-md-12 p-2">
                        <h4>No Related Products Available </h4>
                    </div>
                    @endif 
                </div>    
                
            </div>
        </div>
    </div>

</div>



@push('scripts')

<script>
$(function () {
    $("#exzoom").exzoom({
        "navWidth": 80,
        "navHeight": 80,
        "navItemNum": 3,
        "navItemMargin": 7,
        "navBorder": 1,
        "autoPlay": true,
        "autoPlayTimeout": 8000
    });

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        responsive: {
            0: { items: 1 },
            600: { items: 3 },
            1000: { items: 4 }
        }
    });
});

    function changeMainImage(img) {
        document.getElementById('mainProductImage').src = img.src;
    }

    function scrollThumbnails(direction) {
        let container = document.getElementById('thumbnailScroll');
        let scrollAmount = 100;

        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    function toggleDescription() {
    let description = document.getElementById("productDescription");
    let button = document.getElementById("readMoreBtn");

    if (description.classList.contains("expanded")) {
        description.classList.remove("expanded");
        button.innerText = "Read More";
    } else {
        description.classList.add("expanded");
        button.innerText = "Read Less";
    }
}

// Instead of this:
const codeString = "console.log('Hello, world!');";
const dynamicFunction = new Function(codeString); // Risky and error-prone

// Do this:
function handleButtonClick(productId) {
    console.log("Adding product to cart:", productId);
    // Add to cart logic
}
  

   



</script>  



@endpush

