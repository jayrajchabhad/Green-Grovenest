 @extends('layouts.admin')

 @section('content')

 <style>
  #view{
    text-decoration: none;
    margin-left: 87%;
  }
  .card:hover {
  transform: scale(1.05);
  transition: transform 0.3s ease-in-out;
  }
.card a {
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease-in-out;
}

.card:hover a {
  transform: scale(1.50);
  transition: transform 0.9s ease-in-out;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
.card:hover h1 {
  transform: scale(1.02);
  transition: transform 0.9s ease-in-out;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}



 </style>

 <div class="row">

  <h1>{{ old('name', $contact->name ?? '') }}</h1>

    <div class="col-md-12 grid-margin">
      @if(session('message'))
        <h2 class="alert alert-success">{{ session('message')}}, </h2>
      @endif
      <div class="me-md-3 me-xl-5">
        <h2>Dashboard,</h2>
        <p class="mb-md-0">Your analytics dashboard template.</p>
        <hr>
      </div>


      <div class="row">
        <div class="col-md-3">
          <div class="card card-body bg-info text-white mb-3 rounded">
              <label>Total Orders</label>
              <h1>{{ $totalOrder }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-success text-white mb-3 rounded">
              <label>Today Orders</label>
              <h1>{{ $todayOrder }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-warning text-white mb-3 rounded">
              <label>This Month Orders</label>
              <h1>{{ $thisMonthOrder }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-danger text-white mb-3 rounded">
              <label>Year Orders</label>
              <h1>{{ $thisYearOrder }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>
      </div>
      <hr>
      
      <div class="row">
        <div class="col-md-3">
          <div class="card card-body bg-info text-white mb-3  rounded">
              <label>Total Product</label>
              <h1>{{ $totalProduct }}</h1>
              <a href="{{ url('admin/products') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-success text-white mb-3 rounded">
              <label>Total Category</label>
              <h1>{{ $totalCategory }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-warning text-white mb-3 rounded">
              <label>Total Brand</label>
              <h1>{{ $totalBrands }}</h1>
              <a href="{{ url('admin/orders') }}" class="text-white " id="view">view</a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <div class="card card-body bg-info text-white mb-3 rounded">
              <label>All Users</label>
              <h1>{{ $totalAllUser }}</h1>
              <a href="{{ url('admin/users') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-success text-white mb-3 rounded">
              <label>Total Gast Users</label>
              <h1>{{ $totalUser }}</h1>
              <a href="{{ url('admin/users') }}" class="text-white " id="view">view</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-body bg-warning text-white mb-3 rounded">
              <label>Total Admins</label>
              <h1>{{ $totalAdmin }}</h1>
              <a href="{{ url('admin/users') }}" class="text-white " id="view">view</a>
          </div>
        </div>
      </div>

    </div>
</div> 
 @endsection