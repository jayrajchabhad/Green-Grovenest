@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
            <img src="{{ asset($appSetting->about_img ) }}" alt="About Us" class="img-fluid" >
        </div>
        <div class="col-md-6 order-md-1">
            <div class="p-4">
                <h2 class="display-4 fw-bold">{{ $appSetting->about_title }}</h2>
                <div class="underline"></div>
                <p class="lead">{{ $appSetting->about_description }}</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>{{ $appSetting->p_1 }}</li>
                    <li class="mb-2"><i class="fas fa-tag text-info me-2"></i>{{ $appSetting->p_2 }}</li>
                    <li class="mb-2"><i class="fas fa-shopping-cart text-primary me-2"></i>{{ $appSetting->p_3 }}</li>
                    <li class="mb-2"><i class="fas fa-heart text-danger me-2"></i>{{ $appSetting->p_4 }}</li>
                </ul>
                {{-- <a href="#" class="btn btn-primary btn-lg">Learn More</a> --}}
            </div>
        </div>
    </div>
</div>

<br><br>


@endsection



