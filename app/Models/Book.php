<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AuthorType;
use Illuminate\Database\Eloquent\Builder;
use App\Scoping\Scopes\CategoryScope;
use App\Scoping\Scoper;

class Book extends Model
{
    protected $fillable = [
        "title",
        "original_title",
        "edition_language",
        "slug",
        "description",
        "isbn"
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('type');
    }

    public function scopeWithScopes(Builder $builder)
    {
        return (new Scoper(request()))->apply($builder, $this->scopes());
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    static function createBookWithSync($request)
    {
        return self::createBook($request->validated())
            ->syncAuthor($request->authors)
            ->syncCategory($request->categories);
    }

    public function updateBookWithSync($request)
    {
        $this->updateBook($request->validated())
            ->syncAuthor($request->authors)
            ->syncCategory($request->categories);
    }

    static function createBook($validated)
    {
        return self::create($validated);
    }

    public function updateBook($validated)
    {
        $this->update($validated);

        return $this;
    }

    public function syncAuthor($authors)
    {
        $this->authors()->sync($this->getStorePayload($authors));

        return $this;
    }

    public function syncCategory($categories)
    {
        $this->categories()->sync($categories);

        return $this;
    }

    private function getStorePayload($authors): array
    {
        return collect($authors)->keyBy('id')->map(function ($author) {
            return [
                'type' => AuthorType::getValue($author["type"])
            ];
        })
            ->toArray();
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
