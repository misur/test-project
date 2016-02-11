<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Text;
use App\Comment;
use Redirect;
class TextController extends Controller
{



	public function index($id){
		return $id;
	}

	public function show($id){
		$text = Text::whereId($id)->first();
		if(count($text) > 0){

			$comments = Text::find($id)->comments;
			return  view('text')->with('comments',$comments)->with('text', $text);
		}else{
			
			  return Redirect::to('/');
        }
    }

}