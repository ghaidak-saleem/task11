<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Post $post)
    {
        $this->authorize('create', Comment::class);
        return view('comments.create',compact('post'));
    }

    public function store(Request $request,Post $post)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'content'=>'required|string'
        ]);
        $comment=new Comment();
        $comment->user_id = auth()->user()->id;
        $post_id=$post;
        $comment->content=$request->input('content');
        $comment->post_id=$post_id;
        $post->comments()->save($comment);
        return redirect('posts/'.$post->id);
    }
    public function edit(Post $post,Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit',compact(['post','comment']));
    }
    public function update(Request $request,Post $post,Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content'=>'required|string'
        ]);
        $comment->user_id = auth()->user()->id;
        $post_id=$post;
        $comment->content=$request->input('content');
        $comment->post_id=$post_id;
        $post->comments()->save($comment);
        return redirect('posts/'.$post->id);
    }

    public function destroy( Post $post,Comment $comment)
    {

        $this->authorize('delete',  $comment);

        $comment->delete();
        return redirect('posts/'.$post->id);
    }
}
