<?php

namespace App\Http\Resources\Quote;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Author\AuthorResource;

class QuoteResource extends JsonResource
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
            'quote' => $this->quote,
            'author' => new AuthorResource($this->whenLoaded('author')),
        ];
    }
}
