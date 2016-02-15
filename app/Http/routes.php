<?php

use App\User;
use App\Text;
use Illuminate\Support\Facades\Mail;








Route::group(['middleware' => ['web']], function () {

	 Route::auth();
   
    Route::resource('text','TextController');

    Route::resource('users','UsersController');

    Route::get('text/{text}/comments/plus', 'CommentsController@plus');

    Route::get('text/{text}/comments/minus', 'CommentsController@minus');

    Route::resource('text.comments','CommentsController');

	Route::controller('home','HomeController');
	
	Route::get('/', function () {
	$texts = Text::all();
    return view('welcome')-> with('texts', $texts);
	});

	Route::get('/us', function () {
		$user = Auth::user();
	   	 return $user;
	});

});


