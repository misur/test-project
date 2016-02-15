<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Comment;
use Auth;
use App\User;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $pom = DB::table('users')
       //  ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
       //  ->get();

       $pom = DB::table('users')
        ->join('comments', function($join)
        {
            $join->on('users.id', '=', 'comments.user_id')
                 ->where('comments.text_id', '=', 1);
        })
        ->get();

        dd($pom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create view';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->ajax()){           
       

        $logged = null;
        if(Auth::check()){
             $logged = Auth::user()->id;
        }else if(empty($request->input('potpis'))){
            // return Redirect::back()->withInput()->withErrors('Potpisi se ili se prijavi!');
             return response()->json(array('success' => false, 'messages' => 'Potpisi se ili se prijavi'));
        }
            $rules =  array(
                    'text' => 'required|max:255|min:2'
                );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
                 // return Redirect::back()->withErrors($validator->messages());
                 return response()->json(array('success' => false, 'messages' => 'Komentar mora biti velicine izmedju 1 i 255 karaktera'));
            }
       

       if(empty($logged)){
         $name = $request->input('potpis');
            $user=  User::create(array(
                  'username' => $name,
                 'password' => 'password',
                 'email' => 'email',
                 'type' => 'user'
                    ));
            $logged = $user->id;
       }

       Comment::create(array(
                    'text' => $request->input('text'),
                    'user_id' => $logged,
                    'text_id' =>  $request->input('text_id'),
                ));
       // return Redirect::back();
        return response()->json(array('success' => true));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show by ids';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit by id view';
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
        return 'update  by id';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'delete from db by id';
    }



    public function plus(Request $request){
        if($request->ajax()){
            return $this->plusVote($request->input('id'));
        }
    }

 
    public function plusVote($id){
        $comments = Comment::find((int)$id);
        $comments->plus = $comments->plus + 1;
        $comments->save();
        return $comments->plus;
    }

    public function minus(Request $request){
        if($request->ajax()){
            return $this->minusVote($request->input('id'));
        }
    }

 
    public function minusVote($id){
        $comments = Comment::find((int)$id);
        $comments->minus = $comments->minus + 1;
        $comments->save();
        return $comments->minus;
    }
}
