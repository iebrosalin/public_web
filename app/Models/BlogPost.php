<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class BlogPost
 *
 * @package App\Models
 *
 * @property \App\Models\BlockCategory  $category
 * @property \App\Models\User           $user
 * @property string                     $slug
 * @property string                     $title
 * @property string                     $content_html
 * @property string                     $content_raw
 * @property string                     $excerpt
 * @property string                     $published_at
 * @property boolean                    $is_published
 */
class BlogPost extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id',
    ];
}
