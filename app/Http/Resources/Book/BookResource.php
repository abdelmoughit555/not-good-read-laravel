<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Comment\CommentResource;

class BookResource extends BookResourceIndex
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            "rating" => [
                "avg" => $this->rating(),
                "rating_total" => $this->ratings->count(),
                "review_total" => $this->comments->count()
            ],
            "comments" => CommentResource::collection($this->whenLoaded("comments")),
        ]);
    }
}
