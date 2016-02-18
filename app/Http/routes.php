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
    
    Route::get('text/{text}/comments/all', 'CommentsController@all');

    Route::get('text/{text}/comments/sortbyCreate', 'CommentsController@sortbyCreate');

    Route::get('text/{text}/comments/sortbyPlus', 'CommentsController@sortbyPlus');

    Route::get('text/{text}/comments/sortbyMinus', 'CommentsController@sortbyMinus');

    Route::post('text/{text}/comments/recomments', 'CommentsController@recomments');

    Route::post('text/{text}/comments/errorComments', 'CommentsController@errorComments');

     Route::get('text/{text}/comments/checkErrorComments', 'CommentsController@checkErrorComments');

    Route::resource('text.comments','CommentsController');

	Route::controller('home','HomeController');
	
	Route::get('/', function () {
	$texts = Text::all();
    return view('welcome')-> with('texts', $texts);
	});


	//test 

	 Route::get('text/{text}/comments/all', 'CommentsController@all');

});


