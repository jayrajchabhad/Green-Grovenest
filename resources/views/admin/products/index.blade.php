@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Products
                     <a href="{{url('admin/products/P-create')}}" class="btn btn-primary btn-sm text-white float-end">
                        Add Products
                    </a>
                 </h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{$product->_id}}</td> <!-- Changed to _id -->
                            <td>
                                @if ($product->category)
                                {{ $product->category->name}}
                                @else
                                No Category.
                                @endif
                            </td>
                            <td>{{ $product->name}}</td>
                            <td>₹{{ $product->selling_price}}</td>
                            <td>{{ $product->quantity}}</td>
                            <td>{{ $product->status == '1' ? 'Hidden':'Visible'}}</td>
                            <td class="text-center">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                    <a href="{{ url('admin/products/'. $product->_id.'/edit')}}" 
                                       class="btn btn-sm btn-success text-white w-90 w-md-auto">
                                       Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger text-white w-90 w-md-auto"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-product-id="{{ $product->_id }}"> <!-- Changed to _id -->
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No products available</td>
                        </tr>
                        @endforelse        
                    </tbody>
                </table>
                <br>
                <div class="float-end">
                    {{ $products->links() }}
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
                    Are you sure you want to delete this product?
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
    document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const productId = button.getAttribute('data-product-id'); 
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `products/${productId}/delete`;
    });
</script>

@endsection