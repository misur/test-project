<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Mail;
use Hash;

class HomeController extends Controller
{
    
    public function index()
    {
        return view('home');
    }

    public function getLogin(){
        return view('login');
    }


    public function getLogout(){
    	Auth::logout();
    	return Redirect::intended('/');
    }


    public function postLogin(){

		$rules = array(
                'email' => 'required|email',
                'password' => 'required|min:6',
               

            );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
                return Redirect::to('home/login')->withInput()->withErrors($validator->messages());
            }else{
		$creds = ['email' => Input::get('email') ,
				  'password' => Input::get('password') ];

		if(Auth::attempt($creds)){
            // Auth::attempt($creds);
			return Redirect::intended('/');
		}else{
			return Redirect::to('home/login')->withInput()->withErrors('Bad username or password');
		}}
	}


	public function getForgotpass(){
		return view('forgotpass');
	}


	public function postSend(){
		$email = Input::get('email');
		$user = User::where('email','=', $email)->first();

		if(count($user)>0){

			$url = 'http://localhost/test-project/public/home/resetpass?r='.$user->password.'&id='.$user->id;
		

			$data = array(
		     	'name' => "Users",
		     	'url'  => $url,
		    );

		    Mail::send('emails.welcome', $data, function ($message) {

		        $message->from('misurovic.milos@gmail.com', 'Learning Laravel');

		        $message->to('misurovic_milos@yahoo.com')->subject('Learning Laravel test email');

		    });

		     return Redirect::to('/');
		}

	    return Redirect::to('home/forgotpass')->withInput()->withErrors('User with email addres dont exist');

	}

	public function getResetpass(){
		$r = Input::get('r');
		$id = Input::get('id');

		$user = User::where('id','=', $id)->first();
		if(count($user)>0){ 
			if($r === $user->password){
				//retur view for reset
				return view('resetpass');
			}
		}
		return Redirect::to('/');
    }

    public function postResetpass(){

    	$rules = array(
                 'password' => 'required|min:6',
                'repassword' => 'required|same:password',
               

            );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
                return Redirect::back()->withErrors($validator->messages());
            }else{
            	$id = Input::get('id');
            	$user = User::find($id);
            	$user->password =  Hash::make(Input::get('password'));
            	$user->save();

            	return Redirect::to('home/login');
            }
   
  
    }
}
