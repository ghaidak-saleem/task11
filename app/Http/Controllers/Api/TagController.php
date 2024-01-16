<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag =new Tag();
        $tag->name =$request->input('name');

        $tag->save();
        return response()->json(['message' => 'tag saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $tag=Tag::find($id);
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $tag=Tag::find($id);
        if(!empty($tag)){
            $tag->name =$request->input('name');
            $tag->save();
            return response()->json(["message"=>"tag updated successfully"]);
        }
        return response()->json(["message"=>"tag not found"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag=Tag::find($id);
        if(!empty($tag)){
          $tag->delete();
          return response()->json(["message"=>"tag deleted successfully"]);
        }
        return response()->json(["message"=>"tag not found"]);
    }




}
