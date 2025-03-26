@extends('layouts.admin')

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
                 <h3>Slider List
                     <a href="{{ url('admin/slider/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Slider 
                    </a>
                 </h3>
            </div>
            <div class="card-body table-responsive"> 
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($slider as $sliders)
                          <tr>
                            <td>{{ $sliders->id }}</td>
                            <td>{{ $sliders->title }}</td>
                            <td>{{ $sliders->description }}</td>
                            <td>
                               <img src="{{ asset($sliders->image) }}" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>{{ $sliders->status == '0' ? 'Visible' : 'Hidden' }}</td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    <a href="{{ url('admin/slider/'.$sliders->id.'/edit') }}" 
                                       class="btn btn-sm btn-success text-white  w-md-auto">
                                       Edit
                                    </a>

                                    <!-- Delete Button (Opens Modal) -->
                                    <button type="button" class="btn btn-sm btn-danger  w-md-auto"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-slider-id="{{ $sliders->id }}">
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

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this slider?
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
        var sliderId = button.getAttribute('data-slider-id');
        var form = document.getElementById('deleteForm');
        form.action = "{{ route('slider.destroy', '') }}/" + sliderId;
    });
});
</script>

@endsection
