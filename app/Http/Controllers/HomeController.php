<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Mail;
use Hash;
use Socialize;
use DB;
use App\Comment;
use App\ErrorComment;

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
				}
			}
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


	public function getFacebook(){
		
	     return Socialize::with('facebook')->redirect();
	
	}

	public function getCallback(){

	    $user = Socialize::with('facebook')->user();

	    if($this->checkExists($user->email)){
			$this->updateUser($user->token, $user->email);
		}else{
			$this->addUser($user->token, $user->email);
		}


	    $creds = ['email'    => $user->email,
	    		  'password' => $user->token
	    		  ];

	    if(Auth::attempt($creds)){
			return Redirect::intended('/');
		}else{
			return 'not logged in';
		}
	}


	public function checkExists($email){
		$user = User::where('email', '=' ,$email )->first();
		if($user === null){
			return false;
		}else{
			return true;
		}
	}

	public function addUser($password, $email){
		User::create(array(
            'password' => Hash::make($password),
            'email' => $email,
            'type' => 'user'
        ));
	}

	public function updateUser($password,$email){
		$user = User::where('email', '=' ,$email )->first();
		$user->password = Hash::make($password);
		$user->save();
	}


	 public function postAll(){
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 1)
        // ->where('comments.text_id', '=', 1)
        ->orderBy('comments.created_at', 'asc')
        ->get();

         header("Content-Type: application/json");
          echo  json_encode($pom);
    }

    public function getAll(){
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 1)
        ->first();
        
header("Content-Type: application/json");
          echo  json_encode($pom);
     	
    }

    public function getComments(){
    	$comments =  Comment::all();
    	return json_encode(array('value'=>$comments));
    }

    public function putComments(){
    	$comments =  Comment::find(Input::get('id'));
    	$comments->active = (int) Input::get('active');
    	$comments->save();
		header("Content-Type: application/json");
    	echo json_encode($comments);
    }

    public function deleteComments(){
    	$comments =  Comment::find(Input::get('id'));
    	$comments->delete();
    	return json_encode('ok');
    }


    public function getErrcomments(){
    	$errcomments= ErrorComment::all();
    	return json_encode(array('value'=>$errcomments));
    }

     public function putErrcomments(){
    	$comments =  Comment::find(Input::get('id'));
    	$comments->active = (int) Input::get('active');
    	$comments->save();
		header("Content-Type: application/json");
    	echo json_encode($comments);
    }

    public function deleteErrcomments(){
    	$comments =  Comment::find(Input::get('id'));
    	$comments->delete();
    	return json_encode('ok');
    }
}
