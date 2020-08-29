<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Category\CategoryResource;

class BookResourceIndex extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "original_title" => $this->original_title,
            "edition_language" => $this->edition_language,
            "slug" => $this->slug,
            "description" => $this->description,
            "isbn" => $this->isbn,
            "authors" => AuthorResource::collection($this->whenLoaded("authors")),
            "categories" => CategoryResource::collection($this->whenLoaded("categories")),
        ];
    }
}
