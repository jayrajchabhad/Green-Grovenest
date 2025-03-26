<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\RecommendatProduct;

class ProductRecommendationController extends Controller
{
    public function index()
    {
        // Retrieve all recommendations with their associated products
        $recommendations = RecommendatProduct::with('product', 'recommendedProduct')->get();
        return view('admin.recommendations.index', compact('recommendations'));
    }

    // Show create recommendation form
    public function create()
    {
        $products = Product::all();
        return view('admin.recommendations.create', compact('products'));
    }

    // Store a new recommendation
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,_id',
            'recommended_product_id' => 'required|exists:products,_id|different:product_id',
        ]);

        RecommendatProduct::create([
            'product_id' => $request->product_id,
            'recommended_product_id' => $request->recommended_product_id,
        ]);

        return redirect('admin/recommendations')->with('success', 'Recommendation added successfully.');
    }

    // Show edit recommendation form
    public function edit($id)
    {
        $products = Product::all();
        $recommendation = RecommendatProduct::where('_id', $id)->first(); // Use `_id` for MongoDB

        if (!$recommendation) {
            return redirect('admin/recommendations')->withErrors(['error' => 'Recommendation not found']);
        }

        return view('admin.recommendations.edit', compact('products', 'recommendation'));
    }

    // Update a recommendation
    public function update(Request $request, $id)
    {
        $request->validate([
            'recommended_product_id' => 'required|exists:products,_id|different:product_id',
        ]);

        $productRecommendation = RecommendatProduct::where('_id', $id)->first(); // Use `_id`

        if (!$productRecommendation) {
            return redirect()->back()->withErrors(['error' => 'Product Recommendation not found']);
        }

        $productRecommendation->update([
            'recommended_product_id' => $request->recommended_product_id,
        ]);

        return redirect('admin/recommendations')->with('success', 'Recommendation updated successfully.');
    }

    // Delete a recommendation
    public function destroy($id)
    {
        $recommendation = RecommendatProduct::where('_id', $id)->first(); // Use `_id`

        if ($recommendation) {
            $recommendation->delete();
            return redirect('admin/recommendations')->with('success', 'Recommendation deleted successfully.');
        } else {
            return redirect('admin/recommendations')->withErrors(['error' => 'Recommendation not found']);
        }
    }
}
