@extends('layouts.app')

@section('title','User  Profile')

@section('content')

<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
            </div>
            <div class="col-md-10">
                <h4>Edit Profile
                </h4>
                <div class="underline"></div>
                

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                
                @endif

                <div class="card shadow-lg rounded">
                    <div class="card-header" style="background-color:{{$appSetting->primary}};">
                        <h4 class="mb-0 text-white">User Details
                            <a href="{{ url(path: 'change-password') }}"  class="btn btn-sm btn-danger text-white float-end">Change Password ?</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/profile')}}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{ Auth::user()->name    }}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email Address</label>
                                        <input type="text" readonly name="email" value="{{ Auth::user()->email }}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Zip/Pin Code</label>
                                        <input type="text" name="pin_code" value="{{ Auth::user()->userDetail->pin_code ?? '' }}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="3">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn text-white" style="background-color: {{$appSetting->button}}">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection 