@extends('layouts.app')

@section('title','Search Product')

@section('content')

<style>
    .text-muted,.product-name a {
    display: block;
    white-space: nowrap;     
    overflow: hidden;       
    text-overflow: ellipsis; 
    max-width: 100%;         
}
.selling-price{
    color: {{$appSetting->header_footer}};
}

</style>

<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Search Results</h4>
                <div class="underline "></div>
            </div>
                @forelse($searchproduct as $productitem)
                <div class="col-md-12">
                    <div class="product-card border-0" style="height: 270px">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="product-card-img">
                                    @if ($productitem->quantity > 0)
                                        <label class="badge bg-success position-absolute m-2">In Stock</label>
                                    @else
                                        <label class="badge bg-danger position-absolute m-2">Out Of Stock</label>
                                    @endif

                                @if ($productitem->productImages->count() > 0)
                                    <a href="{{ url(path: '/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}">
                                        <img src="{{ asset($productitem->productImages[0]->image)}}" alt="{{ $productitem->name }}" style="height: 270px">
                                    </a>     
                                @endif

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-4 bg-white">
                                    <p class="text-muted text-uppercase small mb-1">Categories /
                                         {{$productitem->category->name}} /
                                         {{$productitem->brand}} / 
                                         {{$productitem->name}}
                                    </p>
                                    
                                    <hr>

                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}" class="text-decoration-none text-dark font-weight-bold">
                                            {{ $productitem->name }}
                                        </a>
                                    </h5>
                                    <div class="price">
                                        <span class="selling-price h5">₹{{ number_format($productitem->selling_price, 2) }}</span>
                                        <span class="original-price text-muted text-decoration-line-through">₹{{ number_format($productitem->original_price, 2) }}</span>
                                        <p style="height:45px; overflow: hidden">
                                            <b>Description : </b>{{ $productitem->description }}
                                        </p>
                                        <a href="{{ url('/collections/'.$productitem->category->slug.'/'.$productitem->slug) }}" class="btn btn-sm float-end" style=" border: 1px solid {{$appSetting->button}}; color: {{$appSetting->button}};">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div> 
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Such Products Found </h4>
                    </div>
                @endforelse

                <div >
                    {{ $searchproduct->appends(request()->input())->links() }}
                </div>

        </div>
    </div>
</div>


@endsection