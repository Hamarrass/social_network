<?php

namespace App\Models;

use App\Models\Comment;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['title','content','user_id'];

     public function comments()
        {
            //dernier c 'est une method declared in  function boot in class Comment
            return $this->hasMany(Comment::class)->dernier();
        }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function boot(){
        parent::boot();

        static::addGlobalScope(new LatestScope);

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
