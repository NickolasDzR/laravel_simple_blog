<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = ['author', 'title', 'body', 'user_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user = null): bool
    {
        if (!$user) {
            return false; // Гость не может лайкнуть
        }

        // Проверяем, есть ли лайк от этого пользователя
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
