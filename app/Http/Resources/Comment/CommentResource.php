<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResourceComment;
use App\Http\Resources\Reply\ReplyCommentResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'user' => new UserResourceComment($this->whenLoaded('user')),
            'replies_count' => $this->replies_count,
            'likes_count' => $this->likes_count,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
