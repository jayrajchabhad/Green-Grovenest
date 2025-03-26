<div>
    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this category?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="destroyCategory" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h6 class="alert alert-success">{{ session('message') }}</h6>
            @endif

            <div class="card shadow-lg rounded">
                <div class="card-header">
                    <h3>Categories
                        <a href="{{ url('admin/category/C-create') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
                    </h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->_id }}</td> <!-- Use _id for MongoDB -->
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status == 1 ? 'Hidden' : 'Visible' }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                        <!-- Edit Button -->
                                        <a href="{{ url('admin/category/' . $category->_id . '/edit') }}" 
                                           class="btn btn-success btn-sm text-white w-90 w-md-auto">
                                           Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <button wire:click="deleteCategory('{{ $category->_id }}')" 
                                                class="btn btn-danger btn-sm w-90 w-md-auto" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }} <!-- Pagination Links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('close-modal', event => { 
        $('#deleteModal').modal('hide'); // Close the modal when the event is triggered
    });
</script>
@endpush