<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
 

class LoginController extends Controller
{
    use AuthenticatesUsers;
    

    /**
     * Handle redirection after login based on user role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    // protected function authenticated()
    // {
    //     if(Auth::user()->role_as == '1'){
    //         return redirect('admin/dashboard')->with('message','Welcome to Dashboard');
    //     }
    //     else{
    //         return redirect('/home')->with('status','Loggrd in Successfully ');
    //     }
    // }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (is_null($user->email_verified_at)) {
            return redirect()->back()->with('error', 'Please verify your email before logging in.');
        }

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_as == '1') {
                return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard');
            } else {
                return redirect('/home')->with('status', 'Logged in Successfully');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
