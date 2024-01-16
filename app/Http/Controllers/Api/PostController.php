<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::with(['user', 'category', 'tags', 'comments'])->get();
        $posts=$posts->map(function($post){
            return [
                "post"=>[

                 "id"=>$post->id,
                 "title"=>$post->title,
                 "description"=>$post->description,
                 "image"=>$post->getImageUrlAttribute(),
                 "created_at"=>$post->created_at,
                 "updates_at"=>$post->updated_at,
                 "publisher_id"=>$post->user->id,
                 "publisher_name"=>$post->user->name,
                 "category_id"=>$post->category->id,
                 "category_name"=>$post->category->name,
                 "tags"=>$post->tags->map(function($tag){
                    return [
                        "id"=>$tag->id,
                        "name"=>$tag->name
                    ];
                 }),
                 "comments"=>$post->comments->map(function($comment){
                    return [
                        "comment_id"=>$comment->id,
                        "Commenter"=>$comment->user->name,
                        "comment_content"=>$comment->content
                    ];
                 }),
                ]

            ];
       });
        return response()->json(['data' => $posts]);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->input('select');
        $post->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/posts_images');
            $post->image = $imagePath;
        }

        $user = User::find($post->user_id);
        $user->posts()->save($post);

        $tags = $request->input('tags');
        $post->tags()->attach($tags);

        $response= [
            "post"=>[

             "id"=>$post->id,
             "title"=>$post->title,
             "description"=>$post->description,
             "image"=>$post->getImageUrlAttribute(),
             "created_at"=>$post->created_at,
             "updates_at"=>$post->updated_at,
             "publisher_id"=>$post->user->id,
             "publisher_name"=>$post->user->name,
             "category_id"=>$post->category->id,
             "category_name"=>$post->category->name,
             "tags"=>$post->tags->map(function($tag){
                return [
                    "id"=>$tag->id,
                    "name"=>$tag->name
                ];
             }),
             "comments"=>$post->comments->map(function($comment){
                return [
                    "comment_id"=>$comment->id,
                    "Commenter"=>$comment->user->name,
                    "comment_content"=>$comment->content
                ];
             }),
            ]

        ];

    return response()->json(['message' => 'Post added successfully','post' => $response]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('viewAny', Post::class);
        $post = Post::find($id);
        $response= [
                "post"=>[

                 "id"=>$post->id,
                 "title"=>$post->title,
                 "description"=>$post->description,
                 "image"=>$post->getImageUrlAttribute(),
                 "created_at"=>$post->created_at,
                 "updates_at"=>$post->updated_at,
                 "publisher_id"=>$post->user->id,
                 "publisher_name"=>$post->user->name,
                 "category_id"=>$post->category->id,
                 "category_name"=>$post->category->name,
                 "tags"=>$post->tags->map(function($tag){
                    return [
                        "id"=>$tag->id,
                        "name"=>$tag->name
                    ];
                 }),
                 "comments"=>$post->comments->map(function($comment){
                    return [
                        "comment_id"=>$comment->id,
                        "Commenter"=>$comment->user->name,
                        "comment_content"=>$comment->content
                    ];
                 }),
                ]

            ];

        return response()->json(['data' => $response]);
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
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'select' => 'required',

    ]);


    $post->title = $request->input('title');
    $post->user_id = Auth::user()->id;
    $post->category_id = $request->input('select');
    $post->description = $request->input('description');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('public/posts_images');
        $post->image = $imagePath;
    }

    $user = User::find($post->user_id);
    $user->posts()->save($post);



    // Sync tags if they are provided in the request
    if ($request->has('tags')) {
        $post->tags()->sync($request->input('tags'));
    }

    $response = [
        "post" => [
            "id" => $post->id,
            "title" => $post->title,
            "description" => $post->description,
            "image" => $post->getImageUrlAttribute(),
            "created_at" => $post->created_at,
            "updated_at" => $post->updated_at,
            "publisher_id" => $post->user->id,
            "publisher_name" => $post->user->name,
            "category_id" => $post->category->id,
            "category_name" => $post->category->name,
            "tags" => $post->tags->map(function ($tag) {
                return [
                    "id" => $tag->id,
                    "name" => $tag->name,
                ];
            }),
            "comments" => $post->comments->map(function ($comment) {
                return [
                    "comment_id" => $comment->id,
                    "commenter" => $comment->user->name,
                    "comment_content" => $comment->content,
                ];
            }),
        ],
    ];

    return response()->json([ 'message' => 'Post updated successfully','post' => $response,]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
