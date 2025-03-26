@extends('layouts.admin')

@section( 'title' ,'admin Setting')

@section('content')



<div class="row">
   <div class="col-md-12 grid-margin">
         @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
         @endif

         <form action="{{ url('admin/contact/reply/'.$contactdata->id)}}" method="POST">
            @csrf

            <div class="card mb-3  rounded">
               <div class="card-header">
                     <h3 class="text-dark mb-0">
                        Reply To {{ $contactdata->name }}
                     </h3>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12 mb-3">
                        <label>Phone :</label>
                        <p class="text-danger">{{ $contactdata->phone }}</p>

                     </div>
                     <hr>
                     <div class="col-md-12 mb-3">
                        <label>Email :</label>
                        <p class="text-danger">{{ $contactdata->email }}</p>
                     </div>
                     <hr>
                     <div class="col-md-12 mb-3">
                        <label>Messages Is :</label>
                        <p class="text-danger">{{ $contactdata->message }}</p>
                     </div>
                     <hr>
                     <div class="col-md-12 mb-3">
                        <label for="">Messages</label>
                        <input type="textarea" name="reply" class="form-control">

                     </div>
                  </div>
                  <div class="text-end">
                  <button type="submit" class="btn btn-primary text-white">Send</button>
               </div>
               </div>
               
            </div> 
      
         </form>

   </div>
</div>

@endsection