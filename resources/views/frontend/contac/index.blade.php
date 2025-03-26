@extends('layouts.app')

@section('title', 'contact Us')

@section('content')


<div class="container p-5 mt-5 bg-light mb-3 rounded">
    <div class="row">
        <div class="col-lg-7 col-md-12 px-3">
            @if (session('message'))
                <div class="alert alert-success mb-3">{{ session('message')}}</div>
            @endif
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<br>
            <h2 class="mb-4 fw-bold">Contact Us</h2>
            <div class="underline"></div>
            <p class="lead">We'd love to hear from you! Please fill out the form below, or feel free to contact us directly via email or phone.</p>
            
<br>

            <form action="{{ url('contact-us') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control"   name="name" placeholder="Your Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="email">Phone</label>
                        <input type="number" class="form-control"  name="phone" placeholder="Your Phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control"  name="email" placeholder="Your Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="message">Message</label>
                        <textarea class="form-control"  rows="5" name="message" placeholder="Your Message" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn text-white" style="background-color:{{$appSetting->button}};">Submit</button>
            </form>

        </div>

        <div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
            <div class="p-4 text-white rounded" style="background-color: {{$appSetting->primary}}">
                <h3>Our Contact Information</h3>
                <div class="underline"></div>
                <p>
                    <strong><i class="fa fa-envelope"></i>  Email:</strong> {{ $appSetting->email1 ?? 'Email ID' }} <br><br>
                    <strong><i class="fa fa-phone"></i>  Phone:</strong> {{ $appSetting->phone1 ?? 'Phone No.' }} <br><br>
                    <strong><i class="fa fa-map-marker"></i>  Address:</strong> {{ $appSetting->address ?? 'Address' }}
                </p>
                <br>
                <div class="rounded" id="map" style="height: 400px; width: 100%;"></div>

                <br>
                
            </div>
            <div class= "mt-5 float-end">
                <div class="social-media">
                    @if ($appSetting->facebook)
                    <a href="{{ $appSetting->facebook }}" target="_blank"><i class="fa fa-facebook fs-3 mx-2 " style="color: #002349"></i></a>
                    @endif
                    @if ($appSetting->twitter)
                    <a href="{{ $appSetting->twitter }}" target="_blank"><i class="fa fa-twitter fs-3 mx-2 " style="color: #002349"></i></a>
                    @endif
                    @if ($appSetting->instagram)
                    <a href="{{ $appSetting->instagram }}" target="_blank"><i class="fa fa-instagram fs-3 mx-2 " style="color: #002349"></i></a>
                    @endif
                    @if ($appSetting->youtube)
                    <a href="{{ $appSetting->youtube }}" target="_blank"><i class="fa fa-youtube fs-3 mx-2 " style="color: #002349"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<script>
    document.addEventListener("DOMContentLoaded", function() {
       const latitude = {{ $appSetting->latitude ?? 0 }};
       const longitude = {{ $appSetting->longitude ?? 0 }};
       const map = L.map('map').setView([latitude, longitude], 13);
    
       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       attribution: '© OpenStreetMap contributors'
       }).addTo(map);
 
       let marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);
    
       marker.on('dragend', function (event) {
          const latLng = event.target.getLatLng();
          document.getElementById('latitude').value = latLng.lat;
          document.getElementById('longitude').value = latLng.lng;
       });
 
       map.on('click', function (event) {
          const latLng = event.latlng;
          marker.setLatLng(latLng);
          document.getElementById('latitude').value = latLng.lat;
          document.getElementById('longitude').value = latLng.lng;
       });
      
 
    });
    
 </script>

@endsection

