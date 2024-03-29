<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::all();
        return view('category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $this->authorize('create', Category::class);
        return view('category.create');
    }

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
        $category->name =$request->input('name');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/categories_images');
            $category->image=$imagePath;
        }

        $category->save();
        return redirect()->route('category.index')->with('success', 'Data saved successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return view('category.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);
        $request->validate([
            'name' => 'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        $category->name =$request->input('name');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/categories_images');
            $category->image=$imagePath;
        }

        $category->save();
        return redirect()->route('category.index')->with('success', 'Data saved successfully');

    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Category $category)
    {
     $this->authorize('delete', $category);

      $category->delete();
      return redirect()->route('category.index');
    }
}


