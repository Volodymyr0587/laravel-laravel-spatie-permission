<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $originalImagePath = $post->getOriginal('image');
        $newImagePath = $post->image;

        // Check if image path has been updated
        if ($originalImagePath !== $newImagePath) {
            // Delete the old image
            if (Storage::disk('public')->exists('images/posts/' . $originalImagePath)) {
                Storage::disk('public')->delete('images/posts/' . $originalImagePath);
            }
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if (Storage::disk('public')->exists('images/posts/' . $post->image)) {
            Storage::disk('public')->delete('images/posts/' . $post->image);
        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
