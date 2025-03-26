<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use MongoDB\BSON\ObjectId; // Import ObjectId for MongoDB

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('_id', 'DESC')->paginate(10); // Use _id for MongoDB
        return view("admin.products.index", compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status', '0')->get();
        return view("admin.products.create", compact('categories', 'brands', 'colors'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->_id, // Use _id for MongoDB
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->_id, // Use _id for MongoDB
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0,
                ]);
            }
        }

        return redirect('admin/products')->with('message', 'Product Added Successfully.');
    }

    public function edit($product_id) // Use $product_id as string (ObjectId)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id); // MongoDB handles ObjectId
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('_id', $product_color)->get(); // Use _id for MongoDB

        return view('admin.products.edit', compact('categories', 'brands', 'product', 'colors'));
    }

    public function update(ProductFormRequest $request, $product_id) // Use $product_id as string (ObjectId)
    {
        $validatedData = $request->validated();

        $product = Product::findOrFail($product_id); // MongoDB handles ObjectId

        $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'featured' => $request->featured == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->_id, // Use _id for MongoDB
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->_id, // Use _id for MongoDB
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0,
                ]);
            }
        }

        return redirect('admin/products')->with('message', 'Product Updated Successfully.');
    }

    public function destroyImage($product_image_id) // Use $product_image_id as string (ObjectId)
    {
        $productImage = ProductImage::findOrFail($product_image_id); // MongoDB handles ObjectId
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted');
    }

    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        // Delete associated images
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
                $image->delete();
            }
        }

        // Delete the product
        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        $productColor = ProductColor::findOrFail($prod_color_id);
        $productColor->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message' => 'Product Color Quantity Updated']);
    }

    public function deleteProdColor($prod_color_id)
    {
        $productColor = ProductColor::findOrFail($prod_color_id);
        $productColor->delete();
        return response()->json(['message' => 'Product Color Deleted']);
    }
}