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
  <h2> {{$text->text}}</h2>
    <hr>
        <div class="well" >
          <textarea class="form-control" name="text" id="text" rows="3" placeholder="Napisi vas komentar..."></textarea>
        </div>
        <div name="text-div" id="text-div"  >
          <div class="well ">
            <p>Dodaj: <a href="#">Putanja</a> | <a href="#">Video</a> | <a href="#">Fotografija</a></p>
         

            <form class="form-inline">
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputName2" placeholder="Potpis">
                
              </div>
               <label>
               <p id="show-login">Ili prijavi se</p> 
              </label>
              <a href="#">FB</a> - <a href="#">L</a>
              <button type="submit" class="btn btn-default">Posalji</button>
            </form>
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
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                  Login <a href="#">Prijavi se</a>
                </label>
              </div>
            </li>
            <li>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                  Facebook <a href="#">Prijavi se</a>
                </label>
              </div>

            </li>
          </ul>
        </div>
    
    <hr>
    @if (count($comments) > 0)  
      <div >        
        
          @foreach ($comments as $error)
            {{ $error->text }}
            <br>
            {{ $error->created_at}} |  {{ $error->plus}} | Ocjena: <a href="#" ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true">    </span></a>   <a href="#" ><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></a>| <a href="">Odgovor</a>|<a href="">Prijavi</a>
                


            <hr>
          @endforeach
        
      </div>
    @endif



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{!! Html::script('js/text.js')!!}

@stop