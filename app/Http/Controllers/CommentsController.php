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
use App\ErrorComment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $comments = $this->getComments(Input::get('id'));
        return response()->json(array('success' => true ,'messages' => $comments));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        dd($this->getComment(35));
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
             return response()->json(array('success' => false, 'messages' => 'Potpisi se ili se prijavi'));
        }
            $rules =  array(
                    'text' => 'required|max:255|min:2'
                );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
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

       $pom =  Comment::create(array(
                    'text' => $request->input('text'),
                    'user_id' => $logged,
                    'text_id' =>  $request->input('text_id'),
                ));

       $comments = $this->getComment($pom->id);
        return response()->json(array('success' => true ,'messages' => $comments));
        }
    }


    public function recomments(Request $request){
        if($request->ajax()){           
       

        $logged = null;
        if(Auth::check()){
             $logged = Auth::user()->id;
        }else if(empty($request->input('potpis'))){
             return response()->json(array('success' => false, 'messages' => 'Potpisi se ili se prijavi'));
        }
            $rules =  array(
                    'text' => 'required|max:255|min:1'
                );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
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

       $pom =  Comment::create(array(
                    'text' => $request->input('text'),
                    'user_id' => $logged,
                    'text_id' =>  $request->input('text_id'),
                    'recomments' => $request->input('id'),
                ));

       $comments = $this->getComment($pom->id);
        return response()->json(array('success' => true ,'messages' => $comments));
        }
    }

    public function checkErrorComments(Request $request){
        if($request->ajax()){
            $commnet_id =(int) $request->input('comments_id');
            $error = ErrorComment::where('comment_id','=', $commnet_id)->count();
            if($error >=2){
                return response()->json(array('success' => false ,'messages' => $error));
            }else{
                 return response()->json(array('success' => true ,'messages' => $error));
            }
        }
    }

    public  function errorComments(Request $request){

        if($request->ajax()){
            $text =$request->input('text');
            $reason = $request->input('reason');
            $comment_id =$request->input('comments_id');
            $logged = null;
          

             
        if(Auth::check()){
             $logged = Auth::user()->id;
        }else if(empty($request->input('potpis'))){
             return response()->json(array('success' => false, 'messages' => 'Potpisi se ili se prijavi'));
        }
            $rules =  array(
                    'text' => 'required|max:255|min:1'
                );

            $validator =Validator::make(Input::all(), $rules);

            if($validator->fails()){
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
       $error = ErrorComment::where('user_id','=', 1)->where('comment_id','=', $request->input('comments_id'))->count();

      if($error >=2){
         return response()->json(array('success' => false ,'messages' => 'Ovaj komnetar je vec prijavljivan 2 puta!'));
      }

      $errorComment = ErrorComment::create(array(
            'text' => $text,
            'reason' => $reason,
            'user_id' =>$logged,
            'comment_id' => $comment_id,
        ));


            return   'text '. $text .' reason '.$reason.' logged id  '.$logged.' comment id '. $comment_id . ' '.$errorComment->id;
            
      //       return response()->json(array('success' => true ,'messages' => 'text ' + $text +' reason '+$reason+' logged id  '+$logged+' comment id '+ $comment_id));
        }
    }


    public function all(){
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 0)
        // ->where('comments.text_id', '=', 1)
        ->orderBy('comments.created_at', 'asc')
        ->get();

         

        return response()->json(array('success' => true ,'messages' => $pom));
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


    public function  getComments($id){
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.text_id', '=', $id)
        ->where('comments.active', '=', 0)
        ->get();

        return $pom;
    }

    public function  getComment($id){
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 0)
        ->where('comments.id', '=', $id)
        ->get();

        return $pom;
    }


    public function sortbyCreate(Request $request){
        $id = $request->input('id');
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 0)
        ->where('comments.text_id', '=', $id)
        ->orderBy('comments.created_at', 'desc')
        ->get();

         

        return response()->json(array('success' => true ,'messages' => $pom));
    }

    public function sortbyPlus(Request $request){
        $id = $request->input('id');
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 0)
        ->where('comments.text_id', '=', $id)
        ->orderBy('comments.plus', 'desc')
        ->get();

         

        return response()->json(array('success' => true ,'messages' => $pom));
    }


    public function sortbyMinus(Request $request){
        $id = $request->input('id');
        $pom =DB::table('users')
        ->leftJoin('comments', 'users.id', '=', 'comments.user_id')
        ->where('comments.active', '=', 0)
        ->where('comments.text_id', '=', $id)
        ->orderBy('comments.minus', 'desc')
        ->get();

         

        return response()->json(array('success' => true ,'messages' => $pom));
    }

}
