<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showRegisterForm(){
        return view('auth.register');
    }
    public function showLoginForm(){
        return view('auth.login');
    }
    public function index()
{
    $data=User::all();
    return view('auth.index',compact('data'));
}
    public function login(Request $request){

        $inputeddata=$request->validate([
           'email'=>'required|email',
           'password'=>'required',
        ]);
        if(Auth::attempt($inputeddata)){
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect()->back();
    }



    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'=>'required|string|min:8|confirmed'

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
        Auth::login($user);
        return redirect('/')->with('success', 'Data saved successfully');
    }

    public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
    }
}
