<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugActiveToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
           $table->dropColumn(['slug','active']);

        });
    }
}
/*if you  want to modify a table so you can use two commandes and you can choose between them
in my opinion  you can use the second one
*/
/* 1) php artisan make:migration add_slug_active_to_posts_table*/
/* 2) php artisan make:migration add_slug_active --table=posts*/
