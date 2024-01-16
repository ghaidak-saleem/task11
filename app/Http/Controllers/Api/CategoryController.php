<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::all();
        // $token = $request->user()->createToken('index_categories_token')->plainTextToken;
        $categories=$categories->map(function($category){
             return [
                  "id"=>$category->id,
                  "name"=>$category->name,
                  "image"=>$category->getImageUrlAttribute(),
                  "created_at"=>$category->created_at,
                  "updates_at"=>$category->updated_at
             ];
        });
        return response()->json(["all categories"=>$categories]);


    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

         $request->validate([
            'name' => 'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category =new Category();
        // $token = $request->user()->createToken('show_category_token')->plainTextToken;
        $category->name =$request->input('name');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/categories_images');
            $category->image=$imagePath;
        }
        $category->save();
        $categoryInfo=[
            "id"=>$category->id,
            "name"=>$category->name,
            "image"=>$category->getImageUrlAttribute(),
            "created_at"=>$category->created_at,
            "updates_at"=>$category->updated_at,


  ];
        return response()->json(["message"=>"category added successfully","category"=>$categoryInfo],202);

    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(Request $request,Category $category)
    {
        $this->authorize('view', $category);

        if(!$category){
            return response()->json(["category not found"],404);
        }
        // $token = $request->user()->createToken('show_category_token')->plainTextToken;
        $categoryInfo=[
                  "id"=>$category->id,
                  "name"=>$category->name,
                  "image"=>$category->getImageUrlAttribute(),
                  "created_at"=>$category->created_at,
                  "updates_at"=>$category->updated_at,


        ];
        return response()->json($categoryInfo);

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category->name = $request->input('name');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/categories_images');
            $category->image = $imagePath;
        }

        $category->save();
        $categoryInfo=[
            "id"=>$category->id,
            "name"=>$category->name,
            "image"=>$category->getImageUrlAttribute(),
            "created_at"=>$category->created_at,
            "updates_at"=>$category->updated_at,
  ];
        // Return a JSON response
        return response()->json(["message" => "Category updated successfully","category"=>$categoryInfo]);
    }



    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Category $category)
    {
    $this->authorize('delete', $category);
    $category=Category::where('id',$category->id);
    if(!empty($category)){
       $category->delete();
       return response()->json(["category deleted successfully"]);
    }
      return response()->json(["message"=>"category not found"]);
    }
}
