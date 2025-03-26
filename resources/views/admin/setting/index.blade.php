@extends('layouts.admin')

@section( 'title' ,'admin Setting')

@section('content')





<div class="row">
   <div class="col-md-12 grid-margin">

      @if (session('message'))
      <div class="alert alert-success mb-3">{{ session('message')}}</div>
      @endif

      @error('about_img')
      <div class="alert alert-danger mb-3">{{ $message }}</div>
      @enderror

      @error('web_logo')
      <div class="alert alert-danger mb-3">{{ $message }}</div>
      @enderror

      <form action="{{ url('/admin/settings')}}" method="POST">
            @csrf

         <div class="card mb-3  rounded">
            <div class="card-header">
                  <h3 class="text-black mb-0">
                     Website
                  </h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label for="">Website Name</label>
                     <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Website URL</label>
                     <input type="text" name="website_url" value="{{ $setting->website_url ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-1 mt-2 bg-dark">
                     <img src="{{ asset($setting->web_logo ?? '' ) }}" width="60px" height="60px">
                  </div>
                  <div class="col-md-11 mb-3">
                     <label for="web_logo">Website Logo Image</label>
                     <input type="file" name="web_logo" value="{{ asset($setting->web_logo ?? '' ) }}"   class="form-control">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="">Page Title</label>
                     <input type="text" name="title" value="{{ $setting->title ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Meta Keywords</label>
                     <textarea type="text" name="meta_keywords" class="form-control">{{ $setting->meta_keywords ?? '' }}</textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Meta Description</label>
                     <textarea type="text" name="meta_description" class="form-control">{{ $setting->meta_description ?? '' }}</textarea>
                  </div>
               </div>
            </div>
         </div> 

         <div class="card mb-3  rounded">
            <div class="card-header">
                  <h3 class="text-black mb-0">
                     Website - Information
                  </h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <label for="">Address</label>
                     <textarea type="text" name="address" class="form-control">{{ $setting->address ?? '' }}</textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                        <label for="latitude">Latitude:</label>
                        <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $setting->latitude ?? '' }}" readonly>
                  </div>
                  <div class="col-md-12 mb-3">
                        <label for="longitude">Longitude:</label>
                        <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $setting->longitude ?? '' }}" readonly>
                  </div>
                  <div class="mx-4 rounded" id="map" style="height: 400px; width: 95%;"></div>
                  
                 
                  <div class="col-md-6 mb-3">
                     <label for="">Phone 1 *</label>
                     <input type="text" name="phone1" value="{{ $setting->phone1 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Phone No. 2</label>
                     <input type="text" name="phone2" value="{{ $setting->phone2  ?? ''}}"  class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Email Id 1 *</label>
                     <input type="text" name="email1" value="{{ $setting->email1 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Email Id 2</label>
                     <input type="text" name="email2" value="{{ $setting->email2 ?? '' }}" class="form-control">
                  </div>
               </div>
            </div>
         </div>

         <div class="card mb-3  rounded">
            <div class="card-header">
                  <h3 class="text-black mb-0">
                     Website - Social Media
                  </h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label for="">Facebook (Optional)</label>
                     <input type="text" name="facebook" value="{{ $setting->facebook ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Twitter (Optional)</label>
                     <input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">Instagram (Optional)</label>
                     <input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">YouTube (Optional)</label>
                     <input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control">
                  </div>
               </div>
            </div>
         </div>

         <div class="card mb-3  rounded">
            <div class="card-header">
                  <h3 class="text-black mb-0">
                     Website - About Us
                  </h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <label for="">Title</label>
                     <input type="text" name="about_title" value="{{ $setting->about_title ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="">Description</label>
                     <input type="text" name="about_description" value="{{ $setting->about_description ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">point-1</label>
                     <input type="text" name="p_1" value="{{ $setting->p_1 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">point-2</label>
                     <input type="text" name="p_2" value="{{ $setting->p_2 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">point-3</label>
                     <input type="text" name="p_3" value="{{ $setting->p_3 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">point-4</label>
                     <input type="text" name="p_4" value="{{ $setting->p_4 ?? '' }}" class="form-control">
                  </div>
                  <div class="col-md-1 mt-2">
                     <img src="{{ asset($setting->about_img ?? '' ) }}" width="60px" height="60px">
                  </div>
                  <div class="col-md-11 mb-3">
                     <label for="">Logo Image</label>
                     <input type="file" name="about_img" value="{{ asset($setting->about_img ?? '' ) }}"   class="form-control">
                    
                  </div>
               </div>
            </div>
         </div>

         <div class="card mb-3 rounded">
            <div class="card-header">
                <h3 class="text-black mb-0">Website - Theme</h3>
            </div>
            <div class="card-body">
                <div class="row">
                     <label>Primary Color</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <input type="color" id="primaryColorPicker" class="form-control form-control-color p-0" value="{{ $setting->primary ?? '#000000' }}" onchange="document.getElementById('primaryColorInput').value = this.value;">
                        <input type="text" id="primaryColorInput" name="primary" value="{{ $setting->primary ?? '' }}" class="form-control ms-2">
                    </div>
                    <label>Button Color</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <input type="color" id="buttonColorPicker" class="form-control form-control-color p-0" value="{{ $setting->button ?? '#000000' }}" onchange="document.getElementById('buttonColorInput').value = this.value;">
                        <input type="text" id="buttonColorInput" name="button" value="{{ $setting->button ?? '' }}" class="form-control ms-2">
                    </div>
                    <label>Heading Color</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <input type="color" id="headerFooterColorPicker" class="form-control form-control-color p-0" value="{{ $setting->header_footer ?? '#000000' }}" onchange="document.getElementById('headerFooterColorInput').value = this.value;">
                        <input type="text" id="headerFooterColorInput" name="header_footer" value="{{ $setting->header_footer ?? '' }}" class="form-control ms-2">
                    </div>
                    <label>Line Color</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <input type="color" id="lineColorPicker" class="form-control form-control-color p-0" value="{{ $setting->line ?? '#000000' }}" onchange="document.getElementById('lineColorInput').value = this.value;">
                        <input type="text" id="lineColorInput" name="line" value="{{ $setting->line ?? '' }}" class="form-control ms-2">
                    </div>
                    <label>Product box Color</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <input type="color" id="homeColorPicker" class="form-control form-control-color p-0" value="{{ $setting->home ?? '#000000' }}" onchange="document.getElementById('homeColorInput').value = this.value;">
                        <input type="text" id="homeColorInput" name="home" value="{{ $setting->home ?? '' }}" class="form-control ms-2">
                    </div>
                    <label class="mb-2">Choose font style:</label>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                     <select id="font_style" name="font_style" class="form-control">
                        @if(!empty($setting->font_style))
                            <option value="{{ $setting->font_style }}" selected>{{ $setting->font_style }}</option>
                        @endif
                        
                        @php
                            $fonts = [
                                "Lucida Sans,Lucida Sans Regular,Lucida Grande,Lucida Sans Unicode,Geneva,Verdana,sans-serif" => "Lucida Sans, Lucida Sans Regular",
                                "Arial Black, sans-serif" => "Arial Black",
                                "Verdana, sans-serif" => "Verdana",
                                "Tahoma, sans-serif" => "Tahoma",
                                "Trebuchet MS, sans-serif" => "Trebuchet MS",
                                "Impact, sans-serif" => "Impact",
                                "Times New Roman, serif" => "Times New Roman",
                                "Georgia, serif" => "Georgia",
                                "Garamond, serif" => "Garamond",
                                "Courier New, monospace" => "Courier New",
                                "Brush Script MT, cursive" => "Brush Script MT",
                                "Lucida Console, monospace" => "Lucida Console",
                                "Lucida Sans Unicode, sans-serif" => "Lucida Sans Unicode",
                                "Palatino Linotype, Book Antiqua, Palatino, serif" => "Palatino Linotype",
                                "Comic Sans MS, cursive" => "Comic Sans MS"
                            ];
                        @endphp
                    
                        @foreach($fonts as $value => $label)
                            @if($value != $setting->font_style) 
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endif
                        @endforeach
                    </select>
                    
                     </div>
                </div>
            </div>
        </div>
        

         <div class="text-end">
            <button type="submit" class="btn btn-primary text-white">Save  Setting</button>
         </div>

      </form>
   </div>
</div>






<script>
   document.addEventListener("DOMContentLoaded", function() {
      const latitude = {{ $setting->latitude ?? 0 }};
      const longitude = {{ $setting->longitude ?? 0 }};
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

  