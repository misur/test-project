<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use App\User;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = Input::all();
         $rules = array(
                'password' => 'required|min:6',
                'repassword' => 'required|same:password',
                'g-recaptcha-response' => 'required',
                'email' => 'required|email',
                'agreement' => 'required',
                'condition' => 'required'

            );
         $validator =Validator::make(Input::all(), $rules);
          $recaptcha = new \ReCaptcha\ReCaptcha('6LdgVRcTAAAAAA7pVYUqH63Pq9DU09i3Dtd39070');
        
         $response = $recaptcha->verify($input['g-recaptcha-response']);

         if(!$response->isSuccess()){
            $errors = $response->getErrorCodes();
            // return Redirect::to('users/create')->withErrors($errors);
             // $validator->errors()->add('field', $errors);
         }
           
            if($validator->fails()){
                  return Redirect::to('users/create')->withErrors($validator->messages());
                
            }else{
                   User::create(array(
                 'password' => Hash::make(Input::get('password')),
                 'email' => Input::get('email'),
                 'type' => 'user'
                    ));
                  
            }

        return  redirect('home/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    
}
