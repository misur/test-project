<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Text;
use App\Comment;
use Redirect;
use DB;

class TextController extends Controller
{



	public function index($id){
		return $id;
	}

	public function show($id){
		$text = Text::whereId($id)->first();
		if(count($text) > 0){

			$comments = $this->getComments($id);
			return  view('text')->with('comments',$comments)->with('text', $text);
		}else{
			
			  return Redirect::to('/');
        }
    }


    public function  getComments($id){
    	$pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.text_id', '=', $id)
        ->where('comments.active', '=', 0)
        ->get();

        return $pom;
    }

}
