<?php

namespace App\Models;

use App\Models\Comment;
use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeMostCommented(Builder $query){
       return $query->withCount('comments')->orderBy('comments_count','desc');
    }

    public static function boot(){
        static::addGlobalScope(new AdminShowDeleteScope);
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
