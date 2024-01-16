<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::all();
        return view('tag.index', compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);

         $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $tag =new Tag();
        $tag->name =$request->input('name');

        $tag->save();
        return redirect()->route('tag.index')->with('success', 'Data saved successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        return view('tag.show', compact('tag'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $request->validate([
            'name' => 'required|string|max:255',


        ]);
        $tag->name =$request->input('name');

        $tag->save();
        return redirect()->route('tag.index')->with('success', 'Data saved successfully');

    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Tag $tag)
    {
      $this->authorize('delete', $tag);
      $tag->delete();
      return redirect()->route('tag.index')->with('success', 'Data deleted successfully');
    }
}
