@extends('layouts.admin')

@section('content')

<div class="row">
   <div class="col-md-12">
        <div class="card shadow-lg rounded">
            <div class="card-header ">
                <h3>Edit Category
                    <a href="{{ url('admin/category')}}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body ">
                <form action="{{ url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="mb-2">Name:</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2">Slug:</label>
                            <input type="text" name="slug" value="{{$category->slug}}" class="form-control" />
                            @error('slug')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Description:</label>
                            <input type="text" name="description" value="{{$category->description}}" class="form-control" />
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2">Image:</label>
                            <input type="file" name="image"  class="form-control" />
                            <img src="{{ asset($category->image) }}" width="60px" height="60px">
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-1 mb-3">
                            <label class="mb-2">Status:</label><br>
                            <input type="checkbox" name="status" {{$category->status == '1' ? 'checked' : '' }} class="big" style="height: 30px; width: 30px;" />
                            {{-- @error('status')
                            <small class="text-danger">{{$message}}</small>
                        @enderror --}}
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="mb-2">Electronics:</label><br>
                            <input type="checkbox" name="electronics" {{$category->electronics == '1' ? 'checked' : '' }} class="big" style="height: 30px; width: 30px;" />
                            {{-- @error('status')
                            <small class="text-danger">{{$message}}</small>
                        @enderror --}}
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="mb-2">Sports:</label><br>
                            <input type="checkbox" name="sports" {{$category->sports == '1' ? 'checked' : '' }} class="big" style="height: 30px; width: 30px;" />
                            {{-- @error('status')
                            <small class="text-danger">{{$message}}</small>
                        @enderror --}}
                        </div>
                       
                        <div class="col-md-12">
                            <h3>SEO Tage</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Meta Titel:</label>
                            <input type="text" name="meta_titel" value="{{$category->meta_titel}}" class="form-control" />
                            @error('meta_titel')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Meta Keyword:</label>
                            <textarea type="text" name="meta_keyword"  class="form-control" rows="3" >{{$category->meta_keyword}}</textarea>
                            @error('meta_keyword')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2">Meta Description:</label>
                            <textarea type="text" name="meta_description"  class="form-control" rows="3">{{$category->meta_description}}</textarea>
                            @error('meta_description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                            
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>

   </div>
</div> 
@endsection