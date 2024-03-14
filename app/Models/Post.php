<?php

namespace App\Models;


use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

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

    public function estimateReadingTime($wpm = 200)
    {
        $totalWords = str_word_count($this->body);
        $minutes = floor($totalWords / $wpm);
        // $seconds = floor($totalWords % $wpm / ($wpm / 60));

        return  ($minutes > 0) ? "$minutes " . Str::plural('minute', $minutes) . " to read" : "less than a minute to read";
    }
}
