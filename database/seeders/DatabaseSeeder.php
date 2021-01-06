<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        /*to do  that excute this command
        php artisan db:seed
        */
        if($this->command->confirm("do you want to refresh the database", true)){
            $this->command->call("migrate:refresh");
            $this->command->info("database was refreshed!");
        }
        $this->call([
                   UsersTableSeeder::class ,
                   PostsTableSeeder::class ,
                   CommentsTableSeeder::class
                   ]);
    }
}
