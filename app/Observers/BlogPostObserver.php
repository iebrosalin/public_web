<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Перед созданием поста
     *
     * @param BlogPost $blogPost
     */
    public function creating(BlogPost $blogPost)
    {

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Перед обновлением поста
     *
     * @param BlogPost $blogPost
     */

    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
    }


    protected function  setPublishedAt(BlogPost $blogPost)
    {
        $flagSetPublishAt = empty($blogPost->published_at) && $blogPost->is_published;

        if($flagSetPublishAt){
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function  setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    protected function  setHtml(BlogPost $blogPost)
    {
        if(empty($blogPost->isDirty('content_raw'))){
            // TODO: Генерация markdown
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function  setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id()?? BlogPost::UNKNOWN_USER;
    }
}
