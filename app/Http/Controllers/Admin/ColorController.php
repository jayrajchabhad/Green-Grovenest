<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;


class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view("admin.colors.index", compact("colors"));
    }
    public function create()
    { 
        return view("admin.colors.create ");
    }
    public function store(ColorFormRequest $request)
    {
         $validetedData = $request->validated();
         $validetedData['status'] = $request->status == true ? '1':'0';
         Color::create($validetedData);
         return redirect("admin/colors")->with("message","Color Added Successfuly");
    }
    public function edit(Color $color)
    {
        
        return view("admin.colors.edit", compact("color"));
    }
    public function update(ColorFormRequest $request, $color_id)
    {
        $validetedData = $request ->validated();
        $validetedData['status'] = $request->status == true ? '1':'0';
        Color::find($color_id)->update($validetedData);
        return redirect("admin/colors")->with("message","Color Updated Successfuly");
    }
    public function destroy($color_id)
    {
        $color = Color::findOrFail ($color_id);
        $color->delete();
        return redirect("admin/colors")->with("message","Color Deleted Successfuly");

    }
}

