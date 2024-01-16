<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user();
        $users = User::where('id', '!=', $currentUser->id)->get();
        return view('admin.users', compact('users'));
    }



    public function addUser(){
        return view('admin.addUser');
    }

    public function saveUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'=>'required|string|min:8'

        ]);
        $user=new User();
        $user->name =$request->input('name');
        $user->email =$request->input('email');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/users_images');
            $user->image=$imagePath;
        }
        $user->password=$request->input('password');
        $user->save();
        return redirect('/admin')->with('success', 'user added successfully');
    }

    public function blockUser(User $user)
    {
        $user->update(['blocked' => true]);
        return redirect()->back()->with('success', 'User blocked successfully.');
    }

    public function unblockUser(User $user)
    {

        $user->update(['blocked' => false]);
        return redirect()->back()->with('success', 'User unblocked successfully.');
    }
}


