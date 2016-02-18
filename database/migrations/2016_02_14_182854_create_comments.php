<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('comments', function($table){

            $table->increments('id');
             $table->text('text');
            $table->integer('recomments')->nullable();
            $table->integer('plus')->default('0');
            $table->integer('minus')->default('0');
            $table->integer('active')->default('0');
            $table->unsignedInteger('user_id');
           $table->unsignedInteger('text_id');

            $table->timestamps();

        
        });

        Schema::table('comments', function($table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('text_id')->references('id')->on('texts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
