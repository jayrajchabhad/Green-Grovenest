<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use MongoDB\BSON\ObjectId;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);
    
        // Convert product_id to MongoDB ObjectId
        try {
            $productId = new ObjectId($request->product_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Invalid Product ID');
        }
    
        // Create and save the review
        $review = Review::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'rating' => (int) $request->rating,
            'review' => $request->review,
        ]);
    
        if ($review) {
            return redirect()->back()->with('message', 'Review submitted successfully.');
        } else {
            return redirect()->back()->with('message', 'Failed to submit review.');
        }
    }
    
}
