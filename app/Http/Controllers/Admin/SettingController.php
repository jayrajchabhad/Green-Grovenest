<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class  SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index',compact('setting'));
    }
    public function store(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {


            $request->validate([
                'about_img' => 'nullable|max:2048', // Only allow image formats
            ], [
                'about_img.nullable' => 'Please select an image.',
                'about_img.max' => 'The image size should not be more than 2MB.',
            ]);

            // create data
            $setting->update([
                "website_name" => $request->website_name,
                "website_url" => $request->website_url,
                "title" => $request->title,
                "meta_keywords" => $request->meta_keywords,
                "meta_description" => $request->meta_description,
                "address" => $request->address,
                "phone1" => $request->phone1,
                "phone2" => $request->phone2,
                "email1" => $request->email1,
                "email2" => $request->email2,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "instagram" => $request->instagram,
                "youtube" => $request->youtube,
                "about_title"=> $request->about_title,
                "about_description"=> $request->about_description,
                "p_1"=> $request->p_1,
                "p_2"=> $request->p_2,
                "p_3"=> $request->p_3,
                "p_4"=> $request->p_4,
                "about_img"=> $request->about_img ?? $setting->about_img,
                "latitude"=> $request->latitude,
                "longitude"=> $request->longitude,
                "primary"=> $request->primary,
                "button"=> $request->button,
                "header_footer"=> $request->header_footer,
                "line"=> $request->line,
                "home"=> $request->home,
                "font_style"=> $request->font_style,
                "web_logo"=> $request->web_logo ?? $setting->web_logo,



            ]);
            return redirect()->back()->with("message","Setting Saved Successfully");
         
   
        }
        else{
            // update date
            Setting::create([
                "website_name" => $request->website_name,
                "website_url" => $request->website_url,
                "title" => $request->title,
                "meta_keywords" => $request->meta_keywords,
                "meta_description" => $request->meta_description,
                "address" => $request->address,
                "phone1" => $request->phone1,
                "phone2" => $request->phone2,
                "email1" => $request->email1,
                "email2" => $request->email2,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "instagram" => $request->instagram,
                "youtube" => $request->youtube,
                "about_title"=> $request->about_title,
                "about_description"=> $request->about_description,
                "p_1"=> $request->p_1,
                "p_2"=> $request->p_2,
                "p_3"=> $request->p_3,
                "p_4"=> $request->p_4,
                "about_img"=> $request->about_img ?? $setting->about_img,
                "latitude"=> $request->latitude,
                "longitude"=> $request->longitude,
                "primary"=> $request->primary,
                "button"=> $request->button,
                "header_footer"=> $request->header_footer,
                "line"=> $request->line,
                "home"=> $request->home,
                "font_style"=> $request->font_style,
                "web_logo"=> $request->web_logo ?? $setting->web_logo,


            ]);

            return redirect()->back()->with("message","Setting Saved Successfully");
        }    

    }
}
