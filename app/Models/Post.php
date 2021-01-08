<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['title','content','slug','active'];

     public function comments()
        {
            return $this->hasMany(Comment::class);
        }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function boot(){
        parent::boot();
        static::deleting(function(Post $post){
            $post->comments()->delete();
        });

        static::restoring(function(Post $post){
           $post->comments()->restore();
        });
        static::forceDeleted(function(Post $post){
           $post->comments()->forceDelete();
        });
    }

}
