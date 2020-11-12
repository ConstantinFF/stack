<?php

namespace Stack\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $table = 'likes';

    protected $fillable = [
        'is_positive',
    ];

    protected $casts = [
        'is_positive' => 'boolean',
    ];

    public function scopePositive($query)
    {
        return $query->where('is_positive', true);
    }

    public function scopeNegative($query)
    {
        return $query->where('is_positive', false);
    }
}
