@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Colors List
                     <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Color
                    </a>
                 </h3>
            </div>
            <div class="card-body table-responsive"> 
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($colors as $item)
                        <tr>     
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="badge text-black" style="padding: 5px 10px;">{{ $item->code }}</span>
                            </td>
                            <td>{{ $item->status ? 'Hidden' : 'Visible' }}</td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    <a href="{{ url('admin/colors/'.$item->id.'/edit') }}" 
                                       class="btn btn-sm btn-success text-white w-90 w-md-auto">
                                       Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger text-white w-90 w-md-auto"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-color-id="{{ $item->id }}">
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
                        Are you sure you want to delete this color?
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

<!-- JavaScript to Handle Delete Confirmation -->
<script>
    document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const colorId = button.getAttribute('data-color-id'); 
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/colors/${colorId}/delete`; // Correct action
    });
</script>

@endsection
