<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    const TYPE = [
        'author',
        'translator',
        'illustrator'
    ];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('type');
    }
}
