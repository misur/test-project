 @extends('layout.master')


 @section('title')
 Text
@stop


 @section('header')
  <div class="container">
      <div class="page-header">
        <h1>Text</h1>
      </div>
@stop

@section('content')
          {{-- {!!Form::open(array('url' => Request::url().'/comments'))!!} --}}
           <input type="hidden" name="text_id" value="{{$text->id}}">
  <h2> {{$text->text}}</h2>
    <hr>
         @if (count($errors) > 0)  
          <div class="alert alert-danger">
            
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div id="errors">
            

          </div>


        <div class="well" >
          <textarea class="form-control" name="text" id="text" rows="3" placeholder="Napisi vas komentar..."></textarea>
        </div>
        <div name="text-div" id="text-div"  >
          <div class="well ">
            <p>Dodaj: <a href="#">Putanja</a> | <a href="#">Video</a> | <a href="#">Fotografija</a></p>
         
              {{-- 
            <form class="form-inline" > --}}
             @if(!Auth::check())
              <div class="form-group">
                <input type="text" class="form-control" id="potpis"  name="potpis" placeholder="Potpis">
                
              </div>
             
               <label>
               <p id="show-login">Ili prijavi se</p> 
              </label>
              <a href="#">FB</a> - <a href="#">L</a>
              @endif
              <button  class="btn btn-default send">Posalji</button>
              {{-- </form> --}}
              
           {{-- {!!Form::close()!!} --}}


           </div>
        </div>
        <div id="login" class="well">
          <ul class="list-unstyled">
            <li> 
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                  Anonimni
                </label>
              </div>
            </li>
            <li>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
                  Login <a href="#">Prijavi se</a>
                </label>
              </div>
            </li>
            <li>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" >
                  Facebook <a href="#">Prijavi se</a>
                </label>
              </div>

            </li>
          </ul>
        </div>

<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Odgovor</h4>
      </div>
      <div class="modal-body">
        <div id="modal_comments"></div>
          <textarea class="form-control" name="text" id="modal_text" rows="3" placeholder="Napisi vas komentar..."></textarea>
      </div>
      <div class="modal-footer">
      @if(!Auth::check())
              <div class="form-group">
                <input type="text" class="form-control" id="modal_potpis"  name="potpis" placeholder="Potpis">
                
              </div>
             
               <label>
               <p id="show-login">Ili prijavi se</p> 
              </label>
              <a href="#">FB</a> - <a href="#">L</a>
              @else
               <input type="hidden" id="modal_user_id" value="{!!Auth::user()->id!!}">
              @endif

        <button type="button" class="btn btn-default modal_send" data-dismiss="modal">Posalji</button>
      </div>
    </div>

  </div>
</div>



    
    <hr>
    <div>
    Komentari ({{count($comments)}}) 
        <button onclick="sortPlus()">Popularno</button><button onclick="sortLatest()">Najnovije</button><button onclick="sortMinus()">Najlosije</button>
        <hr>
    </div>
     <div id="comm">
    
    </div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! Html::script('js/text.js')!!}

@stop