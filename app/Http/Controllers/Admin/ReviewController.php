<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use MongoDB\BSON\ObjectId;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(10);
        return view('admin.review.index',compact('reviews'));
    }
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['Approved' => true]); // Change 1 to true for better readability
    
        return back()->with('message', 'Review approved successfully!');
    }

    public function disapprove($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['Approved' => false]);

        return back()->with('message', 'Review disapproved successfully!');
    }

    
    

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
    
        return redirect()->back()->with('message', 'Review deleted successfully.');
    }
    
    
    
}
