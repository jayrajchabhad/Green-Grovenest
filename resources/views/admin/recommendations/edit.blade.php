@extends('layouts.admin')

@section('title', 'Edit Product Recommendation')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Edit Product Recommendation</h3>
                <a href="{{ url('admin/recommendations') }}" class="btn btn-danger btn-sm">Back</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/recommendationEdit/'.$recommendation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $recommendation->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="recommended_product_id">Recommended Product</label>
                        <select name="recommended_product_id" id="recommended_product_id" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $recommendation->recommended_product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                   
                    <button type="submit" class="btn btn-primary">Update Recommendation</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection