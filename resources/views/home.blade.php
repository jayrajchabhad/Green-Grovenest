@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded">
                <div class="card-header text-white" style="background-color:{{ $appSetting->primary }};">
                    <h4>{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
<br>

<script>
    setTimeout(function() {
        window.location.href = "{{ url('/') }}"; // Replace with your dashboard route name
    }, 3000); // 10000 milliseconds = 10 seconds
</script>

@endsection
