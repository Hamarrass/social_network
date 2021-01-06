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
        if($posts->count() ==  0){
            $this->command->info('please create some posts');
            return ;
        }
        $nbrComments= (int)$this->command->ask("how many of comments you want generate ?" , 100);
         \App\Models\Comment::factory($nbrComments)->make()->each(function($comment) use ($posts){
            $comment->post_id= $posts->random()->id ;
            $comment->save();
         });
    }
}
