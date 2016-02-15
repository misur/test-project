<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('sex')->nullable();
            $table->string('date')->nullable();
            $table->string('country')->nullable();
            $table->string('education')->nullable();
            $table->string('department')->nullable();
            $table->string('profession')->nullable();
            $table->string('mob')->nullable();
            $table->string('remember_token', 100) -> nullable();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('users');
    }
}
