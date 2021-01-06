<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\Post::all();
         \App\Models\Comment::factory(10)->make()->each(function($comment) use ($posts){
            $comment->post_id= $posts->random()->id ;
            $comment->save();
         });
    }
}
