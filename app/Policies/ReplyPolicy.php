<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Reply $reply
     * @return Bool
     */
    public function update(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Reply $reply
     * @return Bool
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }
}
