@extends('layouts.admin')

@section('content')

<!-- Alert Message -->
@if (session('message'))
    <div class="alert alert-success position-fixed w-100 text-center fade show" 
         style="top: 10px; left: 0; right: 0; z-index: 1050;" 
         role="alert">
        {{ session('message') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Contact Inquiries</h3>
            </div>
            <div class="card-body table-responsive"> 
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($contactData as $item)
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->message }}</td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    @if (!$item->reply)
                                        <a href="{{ url('admin/contactUs/'.$item->id.'/reply') }}" 
                                           class="btn btn-sm btn-success text-white w-100 w-md-auto">
                                            Reply
                                        </a>
                                    @else
                                        <span class="btn btn-sm text-success w-100 w-md-auto">Replied</span>
                                    @endif
                                    
                                    <!-- Delete Button to Trigger Modal -->
                                    <button type="button" class="btn btn-sm btn-danger text-white w-100 w-md-auto delete-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $item->id }}">
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
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this inquiry?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Yes, Delete it</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");

    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            deleteForm.action = `/admin/contactUs/${id}/delete`;
            deleteForm.method = "POST"; // Ensure it's a POST request
        });
    });
});

</script>
@endpush

@endsection
