@extends('layouts.app')

@section('title','Thank you for Shopping')

@section('content')

<br>

        <div class="py-3 pyt-md-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        @if (session('message'))
                             <h5 class="alert alert-success">{{ (session('message')) }}</h5>
                        @endif
                        <div class="p-4 shadow bg-white">
                            <img src="{{ asset($appSetting->about_img ) }}"   style="height: 40%; width: 40%;">
                            <h4>Thank you for Shopping with Green Grovenest</h4>
                            <a href="{{ url('collections')}}" class="btn text-white" style="background-color: {{ $appSetting->button }}">Shop Now</a>
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>


@endsection  