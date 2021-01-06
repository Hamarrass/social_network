<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = \App\Models\User::all();

        \App\Models\Post::factory(10)->make()->each(function($post) use ($users){
            $post->user_id= $users->random()->id ;
            $post->save();
         });
    }
}
