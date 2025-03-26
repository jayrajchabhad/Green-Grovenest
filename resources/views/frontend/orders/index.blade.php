@extends('layouts.app')

@section('title','My Orders')

@section('content')

        <div class="py-3 py-md-5 mb-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-3 shadow-lg rounded bg-white" >

                           
                            <div class="card-header text-white"  style="background-color:{{$appSetting->primary}};">
                                <h3>My Orders</h3>
                           </div>
                            
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
                                                <td><a href="{{ url('orders/'.$orderitem->id )}}" class="btn text-white btn-sm" style="background-color: {{$appSetting->button}}">View</a></td>
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
        </div>

<br><br><br><br><br><br>
@endsection  