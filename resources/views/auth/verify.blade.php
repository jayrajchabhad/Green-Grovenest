@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center p-5">
        <div class="col-md-8 p-5">
            <div class="card shadow-lg rounded">
                <div class="card-header text-white" style="background-color:{{ $appSetting->primary }};">
                    <h4>{{ __('Verify Your Email Address') }}</h4>
                </div>

                <div class="card-body p-5">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                   
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                    </form>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
