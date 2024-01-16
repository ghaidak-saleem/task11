<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        $comments=$comments->map(function($comment){
            return [
                "comment"=>[
                    "id"=>$comment->id,
                    "content"=>$comment->content,
                    "commenter"=>$comment->user->name,
                    "on post"=>$comment->post->title
                ]
            ];
        });
        return response()->json(['comments' => $comments,"status"=>202]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment([
            'user_id' => auth()->user()->id,
            'post_id'=>$post->id,
            'content' => $request->input('content'),
        ]);

        $post->comments()->save($comment);
        $response=[
            "comment"=>[
                "id"=>$comment->id,
                "content"=>$comment->content,
                "on post"=>$comment->post_id,
                "commenter"=>$comment->user_id
            ]
        ];
        return response()->json(['message' => 'Comment created successfully', 'response' => $response]);
    }

    /**
     * Display the specified resource.
     */
    public function show( $comment)
    {
        $this->authorize('view',Comment::class);
        $comment=Comment::find($comment);
        $response=[
                "comment"=>[
                    "id"=>$comment->id,
                    "content"=>$comment->content,
                    "commenter"=>$comment->user->name,
                    "on post"=>$comment->post->title
                ]
                ];

        return response()->json(['comment' => $response,"status"=>202]);

      }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post, $comment)
    {
        $comment = Comment::find($comment);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->content;
        $comment->save();

        $response = [
            "comment" => [
                "id" => $comment->id,
                "content" => $comment->content,
                "on post" => $comment->post_id,
                "commenter" => $comment->user_id
            ]
        ];

        return response()->json(['message' => 'Comment updated successfully', 'response' => $response]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comment)
    {
        $comment = Comment::find($comment);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(["message" => "Comment deleted successfully"]);
    }

}
