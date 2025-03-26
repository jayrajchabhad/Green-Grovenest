@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Coupons List
                     <a href="{{ url('admin/couponscreate') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Coupons
                    </a>
                 </h3>
            </div>
            <div class="card-body table-responsive"> 
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coupon Code</th>
                            <th>Discount</th>
                            <th>Maximum Amount</th>
                            <th>Valid From</th>
                            <th>Valid Until</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($coupons as $item)
                        <tr>     
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->discount_percentage }}</td>
                            <td>₹{{ $item->upto_price }}</td>
                            <td>{{ $item->valid_from }}</td>
                            <td>{{ $item->valid_until }}</td>
                            <td>{{ $item->is_active ? 'Hidden' : 'Visible' }}</td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    <a href="{{ url('admin/couponsEdit/'.$item->id) }}" 
                                       class="btn btn-sm btn-success text-white w-90 w-md-auto">
                                       Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger text-white w-90 w-md-auto delete-coupon"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            Delete
                                    </button>
                            

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

    <!-- Stylish Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Coupon?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete it</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

</div>

<script>
    $(document).on('click', '.delete-coupon', function () {
        var couponId = $(this).data('id'); // Get Coupon ID
        var url = '/admin/couponsDelete/' + couponId; // Define correct URL

        $('#deleteForm').attr('action', url); // Set form action dynamically
    });
</script>



@endsection
