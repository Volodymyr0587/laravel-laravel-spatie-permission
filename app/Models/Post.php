<?php

namespace App\Models;


use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Spatie\Tags\HasTags;

#[ObservedBy([PostObserver::class])]
class Post extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'body',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
