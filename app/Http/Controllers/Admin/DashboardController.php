<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\category;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count(); 
        $totalCategory = category::count(); 
        $totalBrands = Brand::count(); 

        $totalAllUser = User::count();
        $totalUser = User::where('role_as','0')->count();
        $totalAdmin = User::where('role_as','1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y'); 

        $totalOrder = Order::count();
        $todayOrder = Order::whereDay('created_at',$todayDate)->count();
        $thisMonthOrder   = Order::whereMonth('created_at',$thisMonth)->count();
        $thisYearOrder   = Order::whereYear('created_at',$thisYear)->count();




         return view('admin.dashboard',compact('totalProduct','totalCategory','totalBrands',
                                                            'totalAllUser','totalUser','totalAdmin','totalOrder',  
                                                            'todayOrder','thisMonthOrder','thisYearOrder'));

                                                            
    }
}
