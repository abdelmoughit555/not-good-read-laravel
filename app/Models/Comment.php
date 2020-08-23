<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'text'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
