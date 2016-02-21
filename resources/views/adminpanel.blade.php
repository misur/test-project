 @extends('layout.admin')

@section('title')
Admin panel
@stop

@section('navbar')
	<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/test-project/public">Home</a></li>
          </ul>
    </div>
@stop


@section('sidebar')
	<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="panel">Comments <span class="sr-only">(current)</span></a></li>
            <li><a href="panelerr">Error comments</a></li>
            
          </ul>
         
          
     </div>
@stop


@section('content')

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">All Comments</h1>

          

          <div class="table-responsive">
               <div id="jsGrid" >aaa</div>
          </div>
        
           


        
    {{-- // <script type="text/javascript" src="js/jsgrid.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){


           $("#jsGrid").jsGrid({
            height: "auto",
            width: "100%",
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
     
            pageSize: 15,
            pageButtonCount: 5,
     
            deleteConfirm: "Do you really want to delete comment?",
            controller: {
                loadData: function() {
                    var d = $.Deferred();
     
                    $.ajax({
                         url: "http://localhost/test-project/public/home/comments",
                        dataType: "json"
                    }).done(function(response) {
                        d.resolve(response.value);
                    });
     
                    return d.promise();
                },

                  updateItem: function (item) {
                    return $.ajax({
                        type: "PUT",
                        url: "http://localhost/test-project/public/home/comments",
                        data: item,
                        dataType: "json"
                    });
                },

                    deleteItem: function(item) {
                        return $.ajax({
                            type: "DELETE",
                            url: "http://localhost/test-project/public/home/comments",
                            data: item,
                            dataType: "json"
                        });
                    },

                  

            },
     
            fields: [
                { name: "id", type: "number" , title: 'ID',editing:false}, 
                { name: "text", type: "textarea" , title: 'Text'},
                 { name: "plus", type: "number" , title: 'Plus',editing:false},
                  { name: "minus", type: "number" , title: 'Minus',editing:false},
                    { name: "created_at", type: "text" , title: 'Created',editing:false},
                    { name: "updated_at", type: "text", title: 'Updated',editing:false},
                     {
                    name: "active", title: "Active", type: "select", width: 100,
                    items: [{name: "Active", id: 1},
                        {name: "Non active", id: 0}], valueField: "id", textField: "name"
                    },
                    {type: "control"},

            ]
        });




    });

    </script>


@stop


   