@extends('layouts.admin')

@section('title','User List')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Users
                     <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-sm text-white float-end">
                        Add User
                    </a>
                 </h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email  }}</td>
                            <td class="text-center">
                                @if ($user->role_as == '0')
                                    <span class="badge bg-warning text-dark d-inline-block px-3 py-1">User</span>
                                @elseif($user->role_as == '1')
                                    <span class="badge bg-primary d-inline-block px-3 py-1">Admin</span>
                                @else
                                    <span class="badge bg-danger d-inline-block px-3 py-1">None</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    <a href="{{ url('admin/users/'. $user->id.'/edit')}}" 
                                       class="btn btn-sm btn-success text-white w-md-auto">
                                       Edit
                                    </a>

                                    <!-- Delete Button (Opens Modal) -->
                                    <button type="button" class="btn btn-sm btn-danger  w-md-auto"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-user-id="{{ $user->id }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No users available</td>
                        </tr>
                        @endforelse        
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>    

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  text-black">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="">Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- SCRIPT TO HANDLE DELETE MODAL -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-user-id');
        var form = document.getElementById('deleteForm');
        form.action = "{{ route('users.destroy', '') }}/" + userId;
    });
});
</script>

@endsection
