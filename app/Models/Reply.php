<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CanLike;

class Reply extends Model
{
    use CanLike;

    protected $fillable = [
        'user_id',
        'comment_id',
        'text'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
