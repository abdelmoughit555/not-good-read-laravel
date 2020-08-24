<?php

namespace App\Traits;

use App\Models\Like;

trait CanLike
{
    public function like($userId)
    {
        $attributes = ['user_id' =>  $userId];

        if (!$this->likes()->where($attributes)->exists()) {
            $this->likes()->create($attributes);
        } else {
            $this->likes()->where($attributes)->delete();
        }
    }

    /**
     * Get all of the comment's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getIsFavoritedAttribute()
    {
        return $this->favorites()->whereUserId(auth()->id())->exists();
    }
}
