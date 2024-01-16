<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user)
    {
        return  !$user->blocked;
    }

    public function view(User $user)
    {
        return  !$user->blocked;
    }

    public function create(User $user)
    {
        return !$user->blocked;
    }

    public function update(User $user,Comment $comment)
    {
        return $user->id === $comment->user_id && !$user->blocked;
    }

    public function delete(User $user,Comment $comment)
    {
        return ($user->id === $comment->user_id || $user->id === $comment->post->user_id)&& !$user->blocked;
    }
    public function __construct()
    {
        //
    }
}
