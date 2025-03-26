<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContectUsDetail;
use App\Models\Product;
use App\Models\Slider;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Coupons;



class FrontendController extends Controller
{

    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        $trendingProducts = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivalsProducts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured','1')->latest()->take(14)->get();

        $coupons = Coupons::all();
        return view('frontend.index', compact('sliders','trendingProducts','newArrivalsProducts','featuredProducts','coupons'));
    }

    public function searchproduct(Request $request)
    {
        if ($request->search) 
        {
            $searchproduct = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            
            return view('frontend.pages.search',compact('searchproduct')); 

        }
        else {
             return redirect()->back()->with('message','Empty Search ');
        }   
    }

    public function newArrivals()
    {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalsProducts'));

    }

    public function featuredproduct()
    {
        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-product', compact('featuredProducts'));
    }
    
    public function categories()
    {
        $categories = category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
    }

    public function electronics_collections()
    {
        $electronics_categories = category::where('electronics','1')->where('status','0')->get();
        return view('frontend.collections.category.electronics',compact('electronics_categories'));
    }

    public function sports_collections()
    {
        $sports_categories = category::where('sports','1')->where('status','0')->get();
        return view('frontend.collections.category.sports',compact('sports_categories'));
    }



    public function products($category_slug)
    {
        $category = category::where('slug',$category_slug)->first();
        if ($category) {
            return view('frontend.collections.products.index',compact('category'));
        } else {
            return redirect()->back();
        }
    }
    public function productsview(string $category_slug, string $product_slug)
    {

        $category = category::where('slug',$category_slug)->first();
        if ($category) {

            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collections.products.view',compact('product','category'));
            }
            else{
                return redirect()->back();
            }

        } else {
            return redirect()->back();
        }
    }
    public function thankyou(){
        
        return view('frontend.thank-you');
    }

  

    public function about(){
        
        return view('frontend.about.index');
    }

    public function contact(){
        
        return view('frontend.contac.index');
    }
    
    public function contactusUpdate(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'email' => 'required|email|max:200',
            'message' => 'required|string',
        ]);
    
        // Save the data in the database
        ContectUsDetail::create($validatedData);
    
        // Redirect back with success message
        return redirect()->back()->with("message", "Data sent successfully");
    }


    


}
