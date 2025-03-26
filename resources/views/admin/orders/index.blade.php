@extends('layouts.admin')

@section('title','My Orders')

@section('content')

  
   
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg rounded">
                <div class="card-header">
                    <h3>Orders</h3>
                     
                </div>
                <div class="card-body">   
                    
                    <form  method="get">
                        <div class="row">
                            <div class="col-md-3">
                                 <label class="mb-2">Filter By Date</label>
                                 <input type="date" name="date" value="{{ Request::get('date') ??  date('Y-m-d') }}" class="form-control" style="height: 50%">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-2" >Filter By Status</label>
                                <select name="status" class="form-select" style="height: 50%">
                                    <option value="">Select Status</option>
                                        <option value="confirmed" {{ Request::get('status') == 'confirmed' ? 'selected':''}}>confirmed</option>
                                        <option value="processing" {{ Request::get('status') == 'processing' ? 'selected':''}}>processing</option>
                                        <option value="shipped" {{ Request::get('status') == 'shipped' ? 'selected':''}}>shipped</option>
                                        <option value="current city" {{ Request::get('status') == 'current city' ? 'selected':''}}>current city</option>
                                        <option value="out for delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':''}}>out for delivery</option>
                                        <option value="delivered" {{ Request::get('status') == 'delivered' ? 'selected':''}}>delivered</option>
                                        <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':''}}>cancelled</option>

                                </select>
                           </div>
                           <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                            </div> 
                         </div>
                    </form>
                    <hr>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Traking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Messge</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $orderitem)
                                    <tr>
                                        <td>{{ $orderitem->_id}}</td>
                                        <td>{{ $orderitem->tracking_no}}</td>
                                        <td>{{ $orderitem->fullname}}</td>
                                        <td>{{ $orderitem->payment_mode}}</td>
                                        <td>{{ $orderitem->created_at->format('d-m-y ')}}</td>
                                        <td>{{ $orderitem->status_message}}</td>
                                        <td><a href="{{ url('admin/ordersdetail/'.$orderitem->_id ) }}" class="btn  btn-primary btn-sm">View</a></td>
                                    </tr> 
                                @empty
                                    <tr>
                                        <td colspan="7">No order avilable</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>

                </div>
            </div> 
        </div>
    </div>
    

@endsection  