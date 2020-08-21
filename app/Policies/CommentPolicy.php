<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Comment $comment
     * @return Bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user->id;
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Comment $comment
     * @return Bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user->id;
    }
}
