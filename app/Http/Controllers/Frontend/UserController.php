<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view("frontend.user.profile");
    }
    public function edit()
    {
        return view("frontend.user.edit-profile");
    }
    public function updateUserDetail(Request $request)
    {
        $request->validate([
            "username"=> ["required","string","",""],
            "phone"=> ["required","digits:10","",""],
            "pin_code"=> ["required","digits:6","",""],
            "address"=> ["required","string","max:500",""],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username,
        ]);
        $user->userDetail()->updateOrCreate(
[
                'user_id' => $user->id, 
            ],
    [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
            ]
        );

        return redirect('/profile')->with('message','User Profile Updated');

    }

    public function passwordCreate()
    {
        return view('frontend.user.change-password');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
}
