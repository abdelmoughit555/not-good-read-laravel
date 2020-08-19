<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "title" => $this->title,
            "original_title" => $this->original_title,
            "edition_language" => $this->edition_language,
            "slug" => $this->slug,
            "description" => $this->description,
            "isbn" => $this->isbn,
        ];
    }
}
