@extends('layouts.admin')

@section('title', 'Product Recommendations')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Product Recommendat
                    <a href="{{ url('admin/recommendationCreate') }}" class="btn btn-primary btn-sm text-white float-end">
                        ADD Recommendation
                    </a>
                </h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Recommended Product</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recommendations as $recommendation)
                        <tr>
                            <td>{{ $recommendation->id }}</td>
                            <td>
                                @if ($recommendation->product)
                                    {{ $recommendation->product->name }}
                                @else
                                    No Product
                                @endif
                            </td>
                            <td>
                                @if ($recommendation->recommendedProduct)
                                    {{ $recommendation->recommendedProduct->name }}
                                @else
                                    No Recommended Product
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/recommendationEdit/'.$recommendation->id) }}" class="btn btn-sm btn-success">Edit</a>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-recommendation-id="{{ $recommendation->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No Product Recommendations Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this recommendation?
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

<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const recommendationId = button.getAttribute('data-recommendation-id');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/recommendationDelete/${recommendationId}`;
    });
</script>

@endsection