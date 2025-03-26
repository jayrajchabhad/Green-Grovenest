  @extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card shadow-lg rounded">
            <div class="card-header">
                 <h3>Add Products
                     <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm text-white float-end">
                        BACK
                    </a>
                 </h3>
            </div>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
                @endforeach
                </div>
                @endif
                <form action="{{ url('admin/products')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                Home
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pan" type="button" role="tab" aria-controls="seotag" aria-selected="false">
                                SEO Tage 
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">
                                Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">
                                Product Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab" aria-controls="image" aria-selected="false">
                                Product Color  
                            </button>
                        </li> 
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane border p-3 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-3">
                                <label >Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                    <option   value="{{ $category->id }}">{{ $category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label> Product Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Select Brand</label>
                                <select name="brand" class="form-control" >
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">{{ $brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label> Small Description (500 Words)</label>
                                <textarea name="small_description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>


                        </div>
                        <div class="tab-pane border p-3 fade" id="seotag-tab-pan" role="tabpanel" aria-labelledby="seotag-tab">
                            
                            <div class="mb-3">
                                <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                            </div>

                            
                        </div>
                        <div class="tab-pane border p-3 fade" id="details" role="tabpanel" aria-labelledby="details-tab">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="text" name="original_price" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="text" name="selling_price" class="form-control" />
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" />
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending"  style="width: 50px; heigh:50px;"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Featured</label>
                                        <input type="checkbox" name="featured"  style="width: 50px; heigh:50px;"/>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status"  style="width: 50px; heigh:50px;"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane border p-3 fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                            <div class="mb-3">
                                <label>Upload Product Images</label>
                                <input type="file" name="image[]" multiple class="form-control">
                            </div>
                        </div>
                        <div class="tab-pane border p-3 fade" id="color" role="tabpanel" aria-labelledby="image-tab">
                            <div class="mb-3">
                                <label>Select Color</label>
                                <hr>
                                <div class="row">
                                    @forelse($colors as $coloritem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">
                                            Color:  <input type="checkbox" name="colors[{{ $coloritem->id }}]" value="{{ $coloritem->id }}"> 
                                            {{ $coloritem->name}}
                                            <br>
                                            Quantity: <input type="number" name="colorquantity[{{ $coloritem->id }}]" style=" width:70px; border: 1px solid ">
                                        </div>
                                    </div>

                                    @empty
                                        <div class="col-md-12">
                                            <h1>No Colors Found</h1>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Order Process
                </h4>

                
            </div>
        </div>

    </div>  
</div>      
@endsection