<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['blog_post_id'];
    //blog_post_id
    public function blogPost()
    {
        //return $this->belongsTo(BlogPost::class, 'post_id', 'blog_post_id');
        return $this->belongsTo(BlogPost::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);

    }
}
