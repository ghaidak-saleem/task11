<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $data = Post::all();
        return view('post.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $this->authorize('create', Post::class);
        $tags=Tag::all();
        $categories=Category::all();
        return view('post.create',compact(['user','categories','tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

         $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);

        $post =new Post();
        $post->title =$request->input('title');
        $post->user_id = auth()->user()->id;
        $post->category_id=$request->input('select');
        $post->description =$request->input('description');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/posts_images');
            $post->image=$imagePath;
        }

       $user=User::find($post->user_id);
       $user->posts()->save($post);
       $tags=$request->input('tags');
       $post->tags()->attach($tags);
       return redirect()->route('post.index')->with('success', 'post added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $comments=Comment::where('post_id',$post->id)->get();
        return view('post.show', compact(['post','comments']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories=Category::all();
        return view('post.edit', compact(['post','categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'select'=>'required',
        ]);
        $post->title =$request->input('title');
        $post->category_id=$request->input('select');
        $post->user_id = auth()->user()->id;
        $post->description =$request->input('description');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imagePath=$image->store('public/posts_images');
            $post->image=$imagePath;
        }
        $user=User::find($post->user_id);
        $user->posts()->save($post);
        return redirect()->route('post.index')->with('success', 'post updated successfully');


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
      $this->authorize('delete', $post);

      $post->delete();
      return redirect()->route('post.index')->with('success', 'post archived successfully');
    }
}
