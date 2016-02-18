<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('error_comments', function($table){

            $table->increments('id');
            $table->string('text');
            $table->string('reason');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('comment_id');
            $table->timestamps();

        
        });

        Schema::table('error_comments', function($table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('error_comments');
    }
}
