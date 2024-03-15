<?php

namespace App\Listeners;

use App\Models\Post;
use Spatie\Tags\Tag;
use App\Events\PostDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveUnusedTags
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostDeleted $event): void
    {
        $post = $event->post;
        // Отримати всі теги, пов'язані з цим постом
        $tags = $post->tags;
        // Перебрати теги
        foreach ($tags as $tag) {
            // Отримати кількість постів, які використовують цей тег
            $count = $post->withAllTags([$tag])->count();
            // Якщо тег використовується лише одним постом (цим), видалити його
            if ($count === 1) {
                $tag->delete();
            }
        }
    }
}
