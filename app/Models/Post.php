<?php

namespace Stack\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function comments()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function positiveLikes()
    {
        return $this->likes()->positive();
    }

    public function negativeLikes()
    {
        return $this->likes()->negative();
    }

    public function scopeOnlyPosts($query)
    {
        return $query->whereNull('parent_id');
    }
}
