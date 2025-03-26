<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('_id', 'DESC')->paginate(10); // Use _id for MongoDB
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move($uploadPath, $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->meta_titel = $validatedData['meta_titel'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status == true ? '1' : '0';
        $category->electronics = $request->electronics == true ? '1' : '0';
        $category->sports = $request->sports == true ? '1' : '0';

        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }



    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id); // Get the category instance
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        $validatedData = $request->validated();
    
        // Retrieve the category instance
        $category = Category::findOrFail($category_id);
    
        // Update properties
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
    
        // Handle image upload
        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            // Delete old image
            if (File::exists($category->image)) {
                File::delete($category->image);
            }
    
            // Upload new image
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move($uploadPath, $filename);
            $category->image = $uploadPath . $filename;
        }
    
        // Update meta fields
        $category->meta_titel = $validatedData['meta_titel'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
    
        // Update status flags
        $category->status = $request->status ? '1' : '0';
        $category->electronics = $request->electronics ? '1' : '0';
        $category->sports = $request->sports ? '1' : '0';
    
        // Save changes
        $category->save();
    
        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }

    public function destroy($category_id) // Use $category_id as string (ObjectId)
    {
        $category = Category::findOrFail($category_id); // MongoDB handles ObjectId

        // Delete the category image if it exists
        if (File::exists($category->image)) {
            File::delete($category->image);
        }

        $category->delete();

        return redirect('admin/category')->with('message', 'Category Deleted Successfully');
    }
}