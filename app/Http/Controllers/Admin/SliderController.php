<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
     {
        $slider = Slider::all();
        return view(" admin.slider.index", compact("slider"));
    }
    public function create()
    {
        return view(" admin.slider.create");
    }
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();
        
        if($request ->hasFile("image"))
        {
            $file = $request -> file("image"); 
            $ext = $file->getClientOriginalExtension();
            $filename = time().".".$ext;
            $file->move("uploads/slider/", $filename);
            $validatedData['image'] = "uploads/slider/".$filename; 

        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image'=> $validatedData['image'],
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/slider')->with('message','Slider Added Successfuly ');

    }
    public function edit(Slider $sliders)
    {
        return view('admin.slider.edit',compact('sliders'));
    }

    public function update(SliderFormRequest $request, Slider $sliders)
    {
       
        $validatedData = $request->validated();
        
        if($request ->hasFile("image"))
        {
            $destination = ($sliders->image);  
            if (File::exists($destination)) {
                File::delete($destination); 
            }
            
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->move(("uploads/slider"), $filename); 
            $validatedData['image'] = "uploads/slider/".$filename;  
            

        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::where('_id',$sliders->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image'=> $validatedData['image'] ?? $sliders->image ,
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/slider')->with('message','Slider Updated  Successfuly ');
 
    }
    
    public function destroy(Slider $slider)
{
    if (!$slider) {
        return redirect('admin/slider')->with('message', 'Slider not found.');
    }

    // Delete Image File if Exists
    if (File::exists(public_path($slider->image))) {
        File::delete(public_path($slider->image));
    }

    $slider->delete();

    return redirect('admin/slider')->with('message', 'Slider Deleted Successfully.');
}

}



