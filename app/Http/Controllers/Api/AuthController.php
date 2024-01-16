<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=>'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user =new User();
        $user->name =$request->input('name');
        $user->email = $request->input('email');
        $user->password=Hash::make($request->input('password'));
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/users_images');
            $user->image=$imagePath;

        }
        $user->save();
        $token=$user->createToken($request->input('email'))->plainTextToken;
        $response=[
            'status'=>'success',
            'message'=>'user created successfully',
            'data'=>[
                'token'=>$token,
                'user'=>[
                    "name"=> $user->name,
                    "email"=> $user->email,
                    "image"=> $user->getImageUrlAttribute(),
                    "updated_at"=> $user->updated_at,
                    "created_at"=> $user->created_at,
                    "id"=> $user->id
                ],
            ],
        ];

       return response()->json($response,201);


    }


   /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([
        'email'=>'required|string|email',
        'password'=>'required|string|min:8'
        ]);

        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'status'=>'failed',
                'message'=>'invailed user informations'
            ]);
        }
        $token=$user->createToken('token_name')->plainTextToken;
        $response=[
            'status'=>'success',
            'message'=>'user logged in successfully',
            'data'=>[
                'token'=>$token,
                'user'=>[
                    "name"=> $user->name,
                    "email"=> $user->email,
                    "image"=> $user->getImageUrlAttribute(),
                    "updated_at"=> $user->updated_at,
                    "created_at"=> $user->created_at,
                    "id"=> $user->id
                ],
            ],
        ];
        return response()->json($response,201);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
         $request->user()->tokens()->delete();
            return response()->json([
            'status'=>'success',
            'message'=>'user logged out successfully',
        ]);
    }
}
