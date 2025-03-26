 @extends('layouts.admin')

@section('title','My Orders Details')

@section('content')

  
   
    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success mb-3">{{session('message')}}</div>
            @endif

            <div class="card shadow-lg rounded">
                <div class="card-header">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h3 class="mb-2 mb-md-0">Orders Details</h3>
                        <div class="d-flex flex-wrap gap-2">
                           
                            <a href="{{ url('admin/invoice/'.$order->_id.'/generate')}}" class="btn btn-primary btn-sm">
                                Download Invoice
                            </a>
                            <a href="{{ url('admin/invoice/'.$order->_id)}}" target="_blank" class="btn btn-warning btn-sm">
                                View Invoice
                            </a>
                            <a href="{{ url('admin/invoice/'.$order->_id.'/mail')}}" class="btn btn-info btn-sm">
                                Send Invoice Via Mail
                            </a>
                            <a href="{{ url('admin/orders')}}" class="btn btn-danger btn-sm">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
                
                    <div class="card-body"> 

                            <hr> 
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Order details</h5>
                                    <hr>
                                    <h6>Order Id : {{ $order->_id}}</h6>
                                    <h6>Traking Id/No : {{ $order->tracking_no}}</h6>
                                    <h6>Ordered Date : {{ $order->created_at->format('d-m-Y h:i A')}}</h6>
                                    <h6>Payment Mod : {{ $order->payment_mode}}</h6>
                                    
                                    @if ($order->status_message != 'cancelled')
                                    <h6 class="border p-2 text-success">
                                        Order Status Message : 
                                        <span class="text-uppercase"> {{ $order->status_message}}</span>
                                    </h6>
                                    @else
                                    <h6 class="border p-2 text-danger">
                                        Order Status Message : 
                                        <span class="text-uppercase "> {{ $order->status_message}}</span>
                                    </h6>

                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h5>User details</h5>
                                    <hr>
                                    <h6>Full Name: {{ $order->fullname}}</h6>
                                    <h6>Email Id : {{ $order->email}}</h6>
                                    <h6>Phone : {{ $order->phone}}</h6>
                                    <h6>Address : {{ $order->address }}</h6>
                                    <h6>Pin Code : {{ $order->pincode}}</h6>
                                   
                                </div>
                            
                            </div>
                            <br/>
                                <h5>Order Items</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item Id</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                       @foreach ($order->oredrItems as $orderItems)
                                        <tr>
                                            <td width="10%">{{ $orderItems->id}}</td>
                                            <td width="10%">
                                                @if ($orderItems->product->productImages)
                                                        <img src="{{ asset($orderItems->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                                @else
                                                        <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
 
                                            </td>
                                            <td>
                                                {{  $orderItems->product->name }}
                                                
                                               
                                                @if($orderItems->productColor)
                                                    @if ($orderItems->productColor->color)
                                                        <span>- Color:{{ $orderItems->productColor->color->name }}</span>
                                                     @endif
                                                @endif
                                            </td>
                                            <td width="10%">₹{{ $orderItems->price}}</td>
                                            <td width="10%">{{ $orderItems->quantity}}</td>
                                            <td width="10%" class="fw-bold">₹{{ $orderItems->quantity * $orderItems->price}}</td>
                                            @php
                                                 $totalPrice += $orderItems->quantity * $orderItems->price;
                                            @endphp
                                        </tr>
                                       @endforeach
                                       <tr class="table-light">
                                            <td colspan="5" class="fw-bold text-end">Total Amount:</td>
                                            <td class="fw-bold text-center ">₹{{ $order->original_price}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="fw-bold text-danger text-end">Discounts Amount</td>
                                            <td class="fw-bold text-center text-primary">  
                                                <span class="fw-bold text-danger">-₹{{ $order->discount_price }}</span>
                                            </td>   
                                        </tr>
                                        <tr class="table-dark text-white">
                                            <td colspan="5" class="fw-bold text-end">Your Final Amount:</td>
                                            <td class="fw-bold text-center">₹{{ $order->total_amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                         
                    </div>
            </div>

            <div class="card border mt-3 shadow-lg rounded">
                <div class="card-header">
                    <h4>Order Process (Order Status Upadtes)</h4>

                </div>
                <div class="card-body ">
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action=" {{ url('admin/orders/'.$order->id)}}" method="post">
                                @csrf
                                @method('PUT')

                                <label class="mb-2">Update your order</label>
                                <div class="input-group">
                                    <select name="order_status" class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="confirmed" {{ Request::get('status') == 'confirmed' ? 'selected':''}}>confirmed</option>
                                        <option value="processing" {{ Request::get('status') == 'processing' ? 'selected':''}}>processing</option>
                                        <option value="shipped" {{ Request::get('status') == 'shipped' ? 'selected':''}}>shipped</option>
                                        <option value="current city" {{ Request::get('status') == 'current city' ? 'selected':''}}>current city</option>
                                        <option value="out for delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':''}}>out for delivery</option>
                                        <option value="delivered" {{ Request::get('status') == 'delivered' ? 'selected':''}}>delivered</option>
                                        <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':''}}>cancelled</option>

                                        

                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>


                            </form>
                        </div>

                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $order->status_message}}</span> </h4>
                        </div>

                    </div>
                    
                </div>
            </div>

        </div>
    </div> 



@endsection  