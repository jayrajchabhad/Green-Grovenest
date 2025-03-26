<!DOCTYPE html>
<html lang="en">
<head>

@extends('layouts.app')


@section('title','Home Page')

@section('content')

</head>

<body>

   

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  
  
            <div class="carousel-inner">
            @foreach ($sliders as $key => $slideritem)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                @if ($slideritem->image)
                <img src="{{ asset("$slideritem->image") }}" class="d-block w-100 img-fluid">
                @endif
                 
                <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                    
                        <h1 style="color: {{ $appSetting->header_footer }}">{!! $slideritem->title !!}</h1>

                        <p>{!! $slideritem->description !!}</p>
                        <div>
                            {{-- href="{{ url('/new-arrivals') }}" --}}

                            @if ($slideritem->title == 'Special Offer to get 20% off!')
                                <a class="btn btn-slider stylish-btn" data-bs-toggle="modal" data-bs-target="#couponModal">Get Now</a>
                            @else
                                <a href="new-arrivals" class="btn btn-slider stylish-btn">Shop Now</a>
                            @endif

                                @foreach ($coupons as $item)

                                <!-- Bootstrap Modal -->
                                <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content custom-modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="couponModalLabel">🎉 Exclusive Coupon for You!</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h4 class="coupon-text">Use Code: <span class="coupon-code">{{ $item->code }}</span></h4>
                                        <p class="coupon-desc text-dark">🎁 Get <strong>20% OFF</strong> on your next purchase! Don't miss out.</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary copy-btn" onclick="copyCoupon('{{ $item->code }}')">Copy Code</button>

                                    </div>
                                    </div>
                                </div>
                                </div>

                            @endforeach
    

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

  

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>


  <div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>{{ $appSetting->meta_keywords }}</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                       {{ $appSetting->meta_description}}
                    </p>
            </div>
        </div>
    </div>
  </div>

  <div class="py-5" style="background-color: {{$appSetting->home}}">
    <div class="container">
        <div class=" mb-4">
            <h2 class=" font-weight-bold">Trending Products</h2>
            <div class="underline "></div>
        </div>
        @if ($trendingProducts)
        <div class="owl-carousel owl-theme four-cuarousel">
            @foreach($trendingProducts as $productitem) 
            <div class="item">
                <div class="product-card border-0 overflow-hidden rounded">
                    <div class="product-card-img position-relative">
                        

                    @php
                        // Ensure only approved reviews are used
                        $approvedReviews = $productitem->reviews->where('Approved', 1); // Only get approved reviews
                        $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                        // Calculate star breakdown            
                        $fullStars = floor($averageRating);
                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - ($fullStars + $halfStar);
                    @endphp
                    
                    <div class="flex items-center space-x-1 float-end m-1 text-muted">
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star text-yellow-500"></i>
                        @endfor
                        
                        @if ($halfStar)
                            <i class="fas fa-star-half-alt text-yellow-500"></i>
                        @endif
                        
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="far fa-star text-gray-400"></i>
                        @endfor
                        
                        <span class="ml-2 text-gray-600 text-sm">{{ number_format($averageRating, 1) }}/5</span>
                    </div>

                        <span class="badge bg-danger position-absolute m-2">Trending</span>

                        @if ($productitem->productImages->count() > 0)
                        <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}">
                            <img src="{{ asset($productitem->productImages[0]->image)}}" class="w-100 product-img rounded-top" alt="{{ $productitem->name }}">
                        </a>
                        @endif
                    </div>
                    <div class="p-4 text-center bg-white">
                        <p class="text-muted text-uppercase small mb-1">{{ $productitem->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                {{ $productitem->name }}
                            </a>
                        </h5>
                        <hr>
                        <div class="price mt-2">
                            <span class="selling-price h5">₹{{ number_format($productitem->selling_price, 2) }}</span>
                            <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($productitem->original_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
        @else
        <div class="text-center py-4">
            <h4 class="text-muted">No Products Available</h4>
        </div>
        @endif    
    </div>
</div>


<div class="py-5 bg-light">
    <div class="container">
        <div class="mb-4">
            <h2 class="font-weight-bold">New Arrivals
                <a href="{{ url('new-arrivals') }}" class="btn text-white float-end" style="background-color: {{$appSetting->button}}">View More</a>
            </h2>
            <div class="underline"></div>
        </div>

        @if ($newArrivalsProducts)
        <div class="owl-carousel owl-theme four-cuarousel">
            @foreach($newArrivalsProducts as $productitem)
            <div class="item">
                <div class="product-card border-0  overflow-hidden rounded">
                    
                    <div class="product-card-img position-relative">
                        @php
                            // Ensure only approved reviews are used
                            $approvedReviews = $productitem->reviews->where('Approved', 1); // Only get approved reviews
                            $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                            // Calculate star breakdown                          
                            $fullStars = floor($averageRating);
                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - ($fullStars + $halfStar);
                        @endphp
                        
                        <div class="flex items-center space-x-1 float-end m-1 text-muted">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star text-yellow-500"></i>
                            @endfor
                            
                            @if ($halfStar)
                                <i class="fas fa-star-half-alt text-yellow-500"></i>
                            @endif
                            
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star text-gray-400"></i>
                            @endfor
                            
                            <span class="ml-2 text-gray-600 text-sm">{{ number_format($averageRating, 1) }}/5</span>
                        </div>

                     

                        {{-- New Arrival Badge --}}
                        <span class="badge bg-primary position-absolute m-2">New</span>

                        {{-- Product Image --}}
                        @if ($productitem->productImages->count() > 0)
                        <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}">
                            <img src="{{ asset($productitem->productImages[0]->image) }}" class="w-100 product-img rounded-top" alt="{{ $productitem->name }}">
                        </a>
                        @endif
                    </div>

                    <div class="p-4 text-center bg-white">
                        <p class="text-muted text-uppercase small mb-1">{{ $productitem->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                {{ $productitem->name }}
                            </a>
                        </h5>
                        <hr>
                        <div class="price mt-2">
                            <span class="selling-price h5">₹{{ number_format($productitem->selling_price, 2) }}</span>
                            <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($productitem->original_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
        @else
        <div class="text-center py-4">
            <h4 class="text-muted">No Arrivals Available</h4>
        </div>
        @endif    
    </div>
</div>



<div class="py-5" style="background-color: {{$appSetting->home}}">
    <div class="container">
        <div class="mb-4">
            <h2 class="font-weight-bold">Featured Products
                <a href="{{ url('/featured-product') }}" class="btn text-white float-end" style="background-color: {{$appSetting->button}}">View More</a>
            </h2>
            <div class="underline"></div>
        </div>

        @if ($featuredProducts)
        <div class="owl-carousel owl-theme four-cuarousel">
            @foreach($featuredProducts as $productitem)
            <div class="item">
                <div class="product-card border-0  overflow-hidden rounded">
                    <div class="product-card-img position-relative">
                        @php
                            // Ensure only approved reviews are used
                            $approvedReviews = $productitem->reviews->where('Approved', 1); // Only get approved reviews
                            $averageRating = $approvedReviews->count() > 0 ? number_format($approvedReviews->avg('rating'), 1) : '0.0';
                            // Calculate star breakdown                   
                            $fullStars = floor($averageRating);
                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - ($fullStars + $halfStar);
                        @endphp
                        
                        <div class="flex items-center space-x-1 float-end m-1 text-muted">
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star text-yellow-500"></i>
                            @endfor
                            
                            @if ($halfStar)
                                <i class="fas fa-star-half-alt text-yellow-500"></i>
                            @endif
                            
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star text-gray-400"></i>
                            @endfor
                            
                            <span class="ml-2 text-gray-600 text-sm">{{ number_format($averageRating, 1) }}/5</span>
                        </div>

                        <span class="badge bg-success position-absolute m-2">Featured</span>
                      

                        @if ($productitem->productImages->count() > 0)
                        <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}">
                            <img src="{{ asset($productitem->productImages[0]->image) }}" class="w-100 product-img rounded-top" alt="{{ $productitem->name }}">
                        </a>
                        @endif
                    </div>
                    <div class="p-4 text-center bg-white">
                        <p class="text-muted text-uppercase small mb-1">{{ $productitem->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                {{ $productitem->name }}
                            </a>
                        </h5>
                        <hr>
                        <div class="price mt-2">
                            <span class="selling-price h5">₹{{ number_format($productitem->selling_price, 2) }}</span>
                            <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($productitem->original_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
        @else
        <div class="text-center py-4">
            <h4 class="text-muted">No Featured Products Available</h4>
        </div>
        @endif    
    </div>
</div>


</body>
</html>


@endsection

@section('script')

<script>
    $('.four-cuarousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
}) 

document.addEventListener("DOMContentLoaded", function () {
    let carousel = document.querySelector("#carouselExampleCaptions");
    let couponModal = document.querySelector("#couponModal");
    let toast = document.getElementById("coupon-toast");
    
    // Get Bootstrap Carousel instance
    let bsCarousel = new bootstrap.Carousel(carousel);

    // Stop the slider when modal is opened
    couponModal.addEventListener("show.bs.modal", function () {
        bsCarousel.pause();
    });

    // Restart the slider when modal is closed
    couponModal.addEventListener("hidden.bs.modal", function () {
        bsCarousel.cycle();
    });

    // Hide the toast message on scroll
    window.addEventListener("scroll", function () {
        if (toast.classList.contains("show")) {
            toast.classList.remove("show");
        }
    });
});

// Function to copy coupon code and show toast
function copyCoupon(couponCode) {
    navigator.clipboard.writeText(couponCode).then(() => {
        let toast = document.getElementById("coupon-toast");
        document.getElementById("copied-code").innerText = couponCode;
        toast.classList.add("show");

        // Hide the toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove("show");
        }, 3000);
    });
}



</script>

@endsection


