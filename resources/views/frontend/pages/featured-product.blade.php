@extends('layouts.app')

@section('title','Featured Product')

@section('content')

<style>
    .product-name a {
    display: block;
    white-space: nowrap;     
    overflow: hidden;       
    text-overflow: ellipsis; 
    max-width: 100%;         
}
.selling-price{
    color: {{$appSetting->button}};
}

</style>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Featured Product</h4>
                <div class="underline "></div>
            </div>
                @forelse($featuredProducts as $productitem)
                <div class="col-md-3">
                    <div class="product-card border-0  overflow-hidden rounded">  
                        <div class="product-card-img position-relative">
                            {{-- <h6 class="float-end mt-2 mx-2">Average Rating: {{ number_format($productitem->averageRating(), 1) }} ⭐</h6> --}}

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
                        
                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Featured</span>

                          

                            @if ($productitem->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}">
                                    <img src="{{ asset($productitem->productImages[0]->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $productitem->name }}">
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
                    @empty
                    <div class="col-md-12 p-2">
                        <h4>No Featured Products Available </h4>
                    </div>
                @endforelse

                <div class="text-center">
                    <a href="{{'collections'}}" class="btn text-white px-3" style="background-color:{{$appSetting->button}};">Shop More</a>
                </div>

        </div>
    </div>
</div>


@endsection