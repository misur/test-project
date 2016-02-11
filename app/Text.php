<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Text extends Model
{
   protected $fillable = array('text');

	protected $table = 'texts';


	 // public function comments(){
  //       return $this->hasMany('App\Comment');
  //   }


    public function comments(){
 		return $this->hasMany('App\Comment');
 		
 	}
}

