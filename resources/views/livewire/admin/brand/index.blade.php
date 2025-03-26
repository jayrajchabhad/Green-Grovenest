<div>
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg rounded">
                <div class="card-header">
                    <h4>
                        Brands List
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as $brand)
                            <tr>
                                <td>{{ $brand->_id }}</td> <!-- Use _id for MongoDB -->
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if ($brand->category)
                                        {{ $brand->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                        <!-- Edit Button -->
                                        <a href="#" wire:click="editBrand('{{ $brand->_id }}')"
                                           data-bs-toggle="modal" data-bs-target="#updateBrandModal"
                                           class="btn btn-sm btn-success text-white w-90 w-md-auto">
                                           Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <a href="#" wire:click="deleteBrand('{{ $brand->_id }}')"
                                           data-bs-toggle="modal" data-bs-target="#deleteBrandModal"
                                           class="btn btn-sm btn-danger text-white w-90 w-md-auto">
                                           Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Brands Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    <div class="float-end">
                        {{ $brands->links() }} <!-- Pagination Links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('close-modal', event => {
        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
    });
</script>
@endpush