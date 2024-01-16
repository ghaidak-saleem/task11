<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Post;


class PostPolicy
{
    public function viewAny(User $user)
    {
        return !$user->blocked;
    }

    public function view(User $user,Post $post)
    {
        return !$user->blocked;
    }

    public function create(User $user)
    {
        return !$user->blocked;
    }

    public function update(User $user,Post $post)
    {
        return $user->id === $post->user_id && !$user->blocked;
    }

    public function delete(User $user,Post $post)
    {
        return ($user->id === $post->user_id && !$user->blocked) || $user->is_admin;
    }

    public function __construct()
    {
        //
    }
}
