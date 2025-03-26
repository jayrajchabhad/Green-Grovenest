@extends('layouts.app')

@section('title','All Categories')

@section('content')


<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="">Our Categories</h4>
                <div class="underline "></div>

            </div>

            @forelse ($sports_categories as $categoryitem)

            <div class="col-6 col-md-3">   
                <div class="category-card">

                    <a href="{{ url('/collections/'.$categoryitem->slug)}}">
                        <div class="category-card-img">
                            <img src="{{ url("$categoryitem->image")}}" class="w-100" style="height: 250px;" alt="Laptop">
                        </div>
                        <div class="category-card-body">
                            <h5>{{$categoryitem->name }}</h5>
                        </div>
                    </a>
                </div>
            </div>
            @empty
                <div class="col-md-12">
                    <h5> No Categories Avaleble</h5>
                </div>  
            @endforelse
           
        </div>
    </div>
</div>

<style>
    /* Category Card Styles */
    .category-card {
        background: white;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        text-align: center;
        
    }

    .category-card a {
        text-decoration: none;
        color: inherit;
        display: block;
        
    }

    /* Image Hover Effect */
    .category-card-img {
        overflow: hidden;

    }
 

    .category-card-img img {
        transition: transform 0.3s ease-in-out;
        
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);

        
    }

    .category-card:hover .category-card-img img {
        transform: scale(1.1);
        
    }

  
</style>


@endsection

