<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'likeable_id',
        'likeable_type',
        'user_id'
    ];

    /**
     * Get the owning likeable model.
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Get the owning likeable model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
