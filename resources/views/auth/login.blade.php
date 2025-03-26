@extends('layouts.app')

@section('content')



<div class="py-5 bg-light ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                


                <div class="card shadow-lg rounded">
                    <div class="card-header text-white" style="background-color:{{$appSetting->primary}};">
                        <h4 >{{ __('Login') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" >{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password" >{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @if (Route::has('password.request'))
                                        <a class=" btn-link" href="{{ route('password.request') }}">
                                            {{ __(key: 'Forgot Your Password?') }}
                                        </a>
                                    @endif

                                    </div>
                                </div>
                                <div class="col-md-12 float-end mb-3">
                                    <div class="mb-3">
                                        <button type="submit" class="btn text-white col-md-2 float-end" style="background-color:{{$appSetting->button}};">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        @if (Route::has('register'))
                                            <a class=" btn-link float-end" href="{{ route('register') }}" >
                                                {{ __(key: 'Dont have an account? Register') }}
                                            </a>
                                        @endif
                                    </div>
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
