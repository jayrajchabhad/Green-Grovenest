
    <div class="" >
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="footer-heading ">{{ $appSetting->website_name ?? 'website name'  }}</h4>
                        <div class="footer-underline"></div>
                        <p>
                            {{ $appSetting->title  }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading ">Quick Links</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ url('/')}}" class="text-white">Home</a></div>
                        <div class="mb-2"><a href="{{ url('/about-us')}}" class="text-white">About Us</a></div>
                        <div class="mb-2"><a href="{{ url('/contact-us')}}" class="text-white">Contact Us</a></div>
                        <div class="mb-2"><a href="{{ url('orders') }}" class="text-white">Orders</a></div>
                        <div class="mb-2"><a href="{{ url('wishlist') }}"class="text-white">Wishlist</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading ">Shop Now</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ url('/collections')}}" class="text-white">Collections</a></div>
                        <div class="mb-2"><a href="{{ url('/')}}" class="text-white">Trending Products</a></div>
                        <div class="mb-2"><a href="{{ url('/new-arrivals')}}" class="text-white">New Arrivals Products</a></div>
                        <div class="mb-2"><a href="{{ url('/featured-product')}}" class="text-white">Featured Products</a></div>
                        <div class="mb-2"><a href="{{ url('/cart')}}" class="text-white">Cart</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading ">Reach Us</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2">
                            <p>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($appSetting->address ?? 'Your Address') }}" 
                                    class="text-white" 
                                    target="_self">
                                     <i class="fa fa-map-marker"></i> {{ $appSetting->address ?? 'Address' }}
                                </a>
                                 
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="tel:{{ $appSetting->phone1 ?? '' }}" class="text-white">
                                <i class="fa fa-phone"></i>  {{ $appSetting->phone1 ?? 'Phone No.' }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="mailto:greengrovenest@gmail.com"  class="text-white">
                                <i class="fa fa-envelope"></i> {{ $appSetting->email1 ?? 'Emil Id.' }}
                            </a>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">

                    <div class="col-md-10">
                        <marquee behavior="scroll" direction="right" class="text-white">&copy; 2025 - {{ $appSetting->website_name ?? 'website name'  }} - Ecommerce. All rights reserved. Exclusive Coupon for You! Use Code: NESTSAVE
                        </marquee>
                    </div>
                    <div class="col-md-2">
                        <div class="social-media">
                            @if ( $appSetting->facebook )
                            <a href="{{ $appSetting->facebook  }}" target="_blank"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if ( $appSetting->twitter )
                            <a href="{{ $appSetting->twitter  }}" target="_blank"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if ( $appSetting->instagram )
                            <a href="{{ $appSetting->instagram  }}" target="_blank"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if ( $appSetting->youtube )
                            <a href="{{ $appSetting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
                            @endif
                        </div>
                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    