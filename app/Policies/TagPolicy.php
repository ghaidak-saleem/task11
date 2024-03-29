<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;

class TagPolicy
{
    public function viewAny(User $user)
    {
        return $user->is_admin && !$user->blocked;
    }

    public function view(User $user,Tag $tag)
    {
        return $user->is_admin && !$user->blocked ;
    }

    public function create(User $user)
    {
         return $user->is_admin && !$user->blocked;
    }

    public function update(User $user,Tag $tag)
    {
        return $user->is_admin && !$user->blocked;
    }

    public function delete(User $user,Tag $tag)
    {
        return $user->is_admin && !$user->blocked;
    }
}
