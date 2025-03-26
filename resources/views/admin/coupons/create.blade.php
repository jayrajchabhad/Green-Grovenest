@extends('layouts.admin')


@section('content')

@if (session('message') )
                <div class="alert alert-success">{{session('message') }}</div>
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


<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg rounded">
            <div class="card-header">
                <h3>Add Coupon
                    <a href="{{ url('admin/coupons') }}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body"> 
                <form action="{{ url('admin/coupons') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control"  name="code" required>
                        </div>
                
                        <div class="col-md-12 mb-3">
                            <label for="discount_percentage">Discount Percentage</label>
                            <input type="number" class="form-control"  name="discount_percentage" min="0" max="100" required>
                        </div>
                
                        <div class="col-md-12 mb-3">
                            <label for="upto_price">Max Discount Amount</label>
                            <input type="number" class="form-control"  name="upto_price" min="0">
                        </div>
                
                        <div class="col-md-5 mb-3">
                            <label for="valid_from">Valid From</label>
                            <input type="date" class="form-control"  name="valid_from" required>
                        </div>
                
                        <div class="col-md-5 mb-3">
                            <label for="valid_until">Valid Until</label>
                            <input type="date" class="form-control" name="valid_until" required>
                        </div>
                
                        <div class="col-md-2 mb-3">
                            <label for="is_active">Status</label><br>
                            Check = Hidden            
                            <input type="checkbox" name="is_active" style="height:30px;width:30px; margin-left: 20px; margin-top: -10px;" >  
                            Uncheck = Visible   
                        </div>
                
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end">Create Coupon</button>
                        </div>
                    </div>
                </form>
              
            </div>
        </div>
    </div> 
</div>  
@endsection
