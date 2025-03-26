<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('shopping-bag copy.png') }}" type="image/x-icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="Funda of web IT">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- style --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    
    {{-- owlcarousel --}}
    <link href="{{ asset('assets/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css')}}" rel="stylesheet">
    
    {{-- exzoom - product - image --}}
    <link href="{{ asset('assets/exzoom/jquery.exzoom.css')}}" rel="stylesheet">



    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>


    @livewireStyles

</head>
<body>
        <div id="coupon-toast" class="toast-container">
            ✅ Coupon Code Copied: <span id="copied-code"></span>
        </div>

    <div id="app">
        @extends('frontend.theme')
        @include('layouts.inc.frontend.navbar')
     
        @push('styles')
        @endpush

        <main>
            @yield('content')
            
        </main>
        
        @include('layouts.inc.frontend.footer')

    </div>


    @livewireScripts


 

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}" ></script> 

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>  
    <script>
        window.addEventListener('message', event => {
            alertify.set('notifier','position', 'top-left');
            alertify.notify(event.detail.text, event.detail.type);
        });
    </script>



    <script src="{{ asset('assets/js/owl.carousel.min.js') }}" ></script>

    <script src="{{ asset('assets/exzoom/jquery.exzoom.js') }}" ></script>

    @yield('script')


    @livewireScripts
    @stack('scripts')

</body>
</html>
