<?php

use App\User;
use App\Text;
use Illuminate\Support\Facades\Mail;








Route::group(['middleware' => ['web']], function () {

	 Route::auth();
   
    Route::resource('text','TextController');

    Route::resource('users','UsersController');

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



// Route::controller('/home','HomeController');




// Route::get('sendemail', function () {

//     $data = array(
//         'name' => "Learning Laravel",
//     );

//     Mail::send('emails.welcome', $data, function ($message) {

//         $message->from('misurovic.milos@gmail.com', 'Learning Laravel');

//         $message->to('misurovic_milos@yahoo.com')->subject('Learning Laravel test email');

//     });

//     return "Your email has been sent successfully";

// });











// App::singleton('oauth2', function() {
	
// 	$storage = new OAuth2\Storage\Pdo(array('dsn' => 'mysql:dbname=comments_project;host=localhost', 'username' => 'root', 'password' => ''));
// 	$server = new OAuth2\Server($storage);
	
// 	$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
// 	$server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
	
// 	return $server;
// });

// Route::group(['middleware' => 'web'], function () {
//     Route::auth();

//     Route::get('/home', 'HomeController@index');
// });
