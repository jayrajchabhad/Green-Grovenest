<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view("admin.user.index", compact("users"));
    }
    public function create()
    {
        return view("admin.user.create");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,

        ]);

        return redirect('/admin/users')->with('message','User Created Successfully');
    }
    public function edit(string $userId)
    {
        $user = User::findOrFail($userId);
        return view("admin.user.edit", compact('user'));
    }
    
    // public function update(Request $request ,int $userId)
    // {
    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'password' => ['required', 'string', 'min:8'],
    //         'role_as' => ['required', 'integer'],
    //     ]);

    //     User::findOrFail($userId)->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role_as' => $request->role_as,

    //     ]);

    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password);
    //     }

    //     return redirect('/admin/users')->with('message','User Updated Successfully');
    // }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role_as' => 'required|in:0,1',
            'password' => 'nullable|min:6'  // Password is optional but must be at least 6 characters if changed
        ]);

        $user->name = $request->name;
        $user->role_as = $request->role_as;

        // Only update the password if a new one is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/users')->with('message', 'User updated successfully!');
    }


    public function destroy(string $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/admin/users')->with('message','User Deleted  Successfully');
    }

} 
