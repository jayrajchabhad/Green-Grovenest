<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;

class CouponsOfferController extends Controller
{
    public function index(){
        $coupons = Coupons::all();
        return view('admin.coupons.index',compact('coupons'));
    }
    public function create(){
        return view('admin.coupons.create');
    }

    public function edit(Coupons $coupons){
        return view('admin.coupons.edit',compact('coupons'));
    }
  
    public function store(Request $request)
    {
        $validetedData = $request->validate([
            'code' => 'required|unique:coupons|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'upto_price' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'is_active' => 'nullable',
        ]);

        $validetedData['is_active'] = $request->is_active == true ? '1':'0';

        
        Coupons::create($validetedData);

        return redirect('admin/coupons')->with('message', 'Coupon created successfully!');
    }

    public function update(Request $request,$id)
    {
        $coupons = Coupons::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|unique:coupons,code,' . $id . '|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'upto_price' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'is_active' => 'nullable',
        ]);
        
    
        $validatedData['is_active'] = $request->has('is_active') ? '1' : '0';
    
        $coupons->update($validatedData);

        

        return redirect('admin/coupons')->with('message','coupons Updated Successfully');
    }

    public function destroy($id)
    {
        $coupon = Coupons::find($id);
    
        if ($coupon) {
            $coupon->delete();
            return redirect('admin/coupons')->with('message', 'coupons deleted successfully.');
        } else {
            return redirect('admin/coupons')->withErrors(['message' => 'coupons not found']);
        }
    
    }
    
}
