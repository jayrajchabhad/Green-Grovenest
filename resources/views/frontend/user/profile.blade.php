@extends('layouts.app')

@section('title','User Profile')

@section('content')

<!-- Background Section -->
<div class="profile-background">
    <div class="overlay"></div>
</div>



<div class="container d-flex justify-content-center align-items-center p-5">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6"> <!-- Increased width for better UX -->
            @if (session('message'))
                <p class="alert alert-success">{{ session('message') }}</p> 
            @endif
            <div class="card profile-card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0 text-white"> Your Profile </h4> 
                    <a href="{{ url('edit-profile') }}" class="position-absolute top-0 end-0 m-4  text-decoration-none">
                        <i class="fa-solid fa-pen-to-square text-white  fs-4 "></i>
                    </a>
                </div>
            
                
                <div class="card-body text-center">

                    <!-- Profile Icon -->
                    <div class="profile-icon">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    <hr>

                    <div class="profile-details text-start">
                        <p><strong>Phone:</strong> {{ Auth::user()->userDetail->phone ?? 'N/A' }}</p>
                        <p><strong>Zip Code:</strong> {{ Auth::user()->userDetail->pin_code ?? 'N/A' }}</p>
                        <p><strong>Address:</strong> {{ Auth::user()->userDetail->address ?? 'N/A' }}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<!-- Custom Styles -->
<style>
 
   /* Profile Card */
   .profile-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .card-header{
        background-color:{{$appSetting->primary}};
    }

    /* Profile Icon */
    .profile-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg,{{ $appSetting->primary }},{{ $appSetting->button }});
        color: white;
        font-size: 40px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
  

    /* Text Styles */
    h3 {
        font-weight: bold;
    }

    .text-muted {
        font-size: 14px;
    }

    /* Button Styling */
    .btn {
        background-color: {{ $appSetting->button }};
        border: none;
        transition: 0.3s ease-in-out;
    }


</style>

@endsection
