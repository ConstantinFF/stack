<?php

namespace Stack\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'email',
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes')
            ->using(Like::class)
            ->withPivot([
                'is_positive',
            ]);
    }

    public function likePost(Post $post, bool $is_positive)
    {
        $updateExisting = $this->likes()
            ->where('post_id', $post->id)
            ->where('is_positive', ! $is_positive)
            ->exists();

        if ($updateExisting) {
            $this->likes()->updateExistingPivot(
                $post->id,
                ['is_positive' => $is_positive]
            );
        } else {
            $this->likes()->toggle(
                [$post->id => ['is_positive' => $is_positive], ]
            );
        }
    }
}
