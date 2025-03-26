@extends('layouts.admin')

@section('title', 'Product Reviews')


@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{-- FontAwesome Icon for better UI --}}
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Manage Product Reviews</h3>
            </div>
            <div class="card-body table-responsive"> 
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reviews as $review)
                        <tr>     
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->review }}</td>
                            <td>
                                @if ($review->Approved)
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    @if (!$review->Approved)
                                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.reviews.disapprove', $review->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Disapprove</button>
                                    </form>
                                @endif
                                    <br>
                                    <br>
                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('admin.reviews.destroy', $review->id) }}')">
                                            Delete
                                        </button>
                                    
                                    </form>
                                </div>

                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $reviews->links() }}              
                </div>
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
                    Are you sure you want to delete this review?
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
     function setDeleteAction(action) {
        document.getElementById('deleteForm').setAttribute('action', action);
    }

   setTimeout(() => {
    let alert = document.querySelector(".alert");
    if (alert) {
        alert.classList.remove("show"); // Use Bootstrap’s class for hiding
        alert.classList.add("fade"); // Ensures smooth transition
        setTimeout(() => alert.remove(), 500);
    }
}, 3000); // Alert disappears after 3 seconds

</script>




@endsection
