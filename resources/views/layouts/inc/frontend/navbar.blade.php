<div class="main-navbar navbar-dark shadow-sm sticky-top ">
     
    
    <!-- Top Navbar -->
    <div class="top-navbar py-1" >
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left: Brand Name -->
                <div class="col-md-2 d-none d-md-block ">
                    <a class="navbar-brand  text-white" href="{{ url('/') }}">
                        {{-- <i class="fa fa-leaf fa-lg me-2" style="font-size: 2rem; color:#fff;"></i> --}}
                        <img src="{{ asset($appSetting->web_logo ) }}" alt="About Us" class="img-fluid mx-4" style="height: 45px; width: 150px;">
                    </a>
                </div>

                <!-- Center: Large Search Bar -->
                <div class="col-md-8 p-1">
                    <form action="{{ url('search') }}" method="GET" role="search" class="search-form px-1">
                        <div class="position-relative">
                            <input type="search" name="search" value="{{ Request::get('search') }}"
                                placeholder="Search for products..." class="form-control search-input rounded-pill"/>
                        </div>
                    </form>
                </div>
                

                <!-- Right: Icons -->
                <div class="col-md-2 d-flex justify-content-end align-items-center mt-1">
                    <!-- Cart Icon -->
                    <a href="{{ url('cart') }}" class="text-white me-3  position-relative text-decoration-none">
                        <i class="fa fa-shopping-cart" style="font-size: 1.7rem;"></i>
                        <span class="badge position-absolute translate-middle badge-sm" style="margin-top: -2px">
                            <livewire:frontend.cart.cart-count/>
                        </span>
                    </a>

                    <!-- Wishlist Icon -->
                    <a href="{{ url('wishlist') }}" class="text-white me-3 position-relative text-decoration-none">
                        <i class="fa fa-heart" style="font-size: 1.7rem;"></i>
                        <span class="badge position-absolute  translate-middle badge-sm" style="margin-top: -2px">
                            <livewire:frontend.wishlist-count/>
                        </span>
                    </a>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        @guest
                            @if (Route::has('login'))
                                <a class="text-white" style="text-decoration: none;" href="{{ route('login') }}">
                                    <button class="btn btn-sm btn-outline-light  rounded-pill shadow-sm">Login</button>
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a class="text-white" href="{{ route('register') }}">
                                    <button class="btn btn-sm btn-outline-light rounded-pill shadow-sm">Register</button>
                                </a>
                            @endif
                        @else
                            <a class="text-white dropdown-toggle d-flex align-items-center" style=" text-decoration: none !important;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-2" style="font-size: 1.7rem;"></i> {{ Auth::user()->name }}
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end p-3 shadow-lg" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-white"  href="{{ url('profile') }}"><i class="fa fa-user" style="color: #fff"></i> Profile</a></li>
                                <li><a class="dropdown-item text-white" href="{{ url('orders') }}"><i class="fa fa-list" style="color: #fff"></i> My Orders</a></li>
                                <li><a class="dropdown-item text-white" href="{{ url('wishlist') }}"><i class="fa fa-heart" style="color: #fff"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item text-white" href="{{ url('cart') }}"><i class="fa fa-shopping-cart" style="color: #fff"></i> My Cart</a></li>
                                <li>
                                    <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" style="color: #fff"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-navbar navbar-dark shadow-sm">


    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-md-none d-blockalign-items-center" href="{{ url('/') }}">
                        {{-- <i class="fa fa-leaf fa-lg me-2" style="font-size: 2rem; color:#002349;"></i> --}}
                        <span class="fs-4 font-weight-bold" style="color:#002349;">{{ $appSetting->website_name ?? 'website name'  }}</span>
            </a>   
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-white" href="{{ url('/collections') }}">All Categories</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/electronics') }}">Electronics</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/sports') }}">Sports & fitness</a></li>
                            <li><a class="dropdown-item text-white" href="#"></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/new-arrivals') }}">New Arrivals</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/featured-product') }}">Featured</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about-us') }}">About-us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact-us') }}">Contact-us</a></li>

                </ul>
            </div>
        </div>
    </nav>
</div>

<style>
    .dropdown-menu{
        background-color:#020d1850;
        backdrop-filter: blur(5px); /* Blur effect */
        padding: 20px;
    }
</style>

