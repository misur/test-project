 	$(document).ready(function() {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + "/comments",
 	        type: "get",
 	        data: {
 	            'id': $("input[name=text_id]").val()
 	        },
 	        success: function(data) {
 	            readComments(data);
 	            // alert(data.messages[1].text);
 	        }
 	    });
 	    // $('#myModal').on('shown.bs.modal', function () {
 	    //  		$('#myInput').focus()
 	    // });
 	    $.ajaxSetup({
 	        headers: {
 	            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
 	        }
 	    });
 	    document.getElementById('text-div').style.display = "none";
 	    document.getElementById('login').style.display = "none";
 	    $("#text").focus(function() {
 	        document.getElementById('text-div').style.display = 'block';
 	    });
 	    $('#show-login').click(function() {
 	        document.getElementById('login').style.display = 'block';
 	    });
 	    $('button.send').click(function() {
 	        var url = window.location.pathname;
 	        var text = $("#text").val();
 	        var potpis = $("#potpis").val();
 	        if (text.length > 1 && text.length < 255) {
 	            $.ajax({
 	                url: url + '/comments',
 	                type: "post",
 	                data: {
 	                    'text_id': $("input[name=text_id]").val(),
 	                    'potpis': $("input[name=potpis]").val(),
 	                    'text': $("#text").val()
 	                },
 	                success: function(data) {
 	                    if (data.success) {
 	                        document.getElementById('text').value = null;
 	                        if (typeof potpis !== 'undefined') {
 	                            document.getElementById('potpis').value = "";
 	                        }
 	                        readComments(data);
 	                    } else {
 	                        document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \">" + data.messages + "</p>";
 	                    }
 	                }
 	            });
 	        } else {
 	            document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \"> Komentar mora biti velicine izmedju 1 i 255 karaktera</p>";
 	        }
 	    });
 	    $('button.modal_send').click(function(event) {
 	        $("#modal_errors").empty();
 	        var id = $("#comments_id").val();
 	        var text = $("#modal_text").val();
 	        var text_id = $("input[name=text_id]").val();
 	        var potpis = $("#modal_potpis").val();
 	        var user_id = $("#modal_user_id").val();
 	        if (text.length > 1 && text.length < 255) {
 	            if (typeof user_id === 'undefined' || user_id === null) {
 	                if (potpis.length === 0) {
 	                    document.getElementById('modal_errors').innerHTML = "<p class=\"alert alert-danger \"> Morate se prijaviti ili  potpisati!</p>";
 	                    return false;
 	                } else {
 	                    if (typeof potpis !== 'undefined') {
 	                        document.getElementById('modal_potpis').value = "";
 	                    }
 	                    document.getElementById('modal_text').value = "";
 	                    postRecomments(id, potpis, text, text_id);
 	                    // alert('ok - '+potpis+' - '+text+' - '+id + ' - '+text_id);
 	                }
 	            } else {
 	                if (typeof potpis !== 'undefined') {
 	                    document.getElementById('modal_potpis').value = "";
 	                }
 	                document.getElementById('modal_text').value = "";
 	                postRecomments(id, null, text, text_id);
 	                // alert('ok - '+user_id+' - '+text+' - '+id + ' - '+text_id);
 	            }
 	        } else {
 	            document.getElementById('modal_errors').innerHTML = "<p class=\"alert alert-danger \"> Komentar mora biti velicine izmedju 1 i 255 karaktera!</p>";
 	            return false;
 	        }
 	    });
 	    $('button.modal_report').click(function(event) {
 	        var comments_id = $("#modal_error_comments_id").val();
 	        var pom = document.getElementById("modal_error_select");
 	        var reason = pom[pom.selectedIndex].value;
 	        var text = $("#modal_error_text").val();
 	        var potpis = $("#modal_error_potpis").val();
 	        var user_id = $("#modal_user_id").val();
 	        if (checkErrorComments(comments_id) === false) {
 	            document.getElementById('modal_error_errors').innerHTML = "<p class=\"alert alert-danger \"> Ovaj komnetar je vec prijavljen 2 puta!</p>";
 	            return false;
 	        }
 	        if (reason === '0') {
 	            document.getElementById('modal_error_errors').innerHTML = "<p class=\"alert alert-danger \"> Izaberi razlog!</p>";
 	            return false;
 	        }
 	        if (text === '') {
 	            document.getElementById('modal_error_errors').innerHTML = "<p class=\"alert alert-danger \"> Komentar mora biti velicine izmedju 1 i 255 karaktera!</p>";
 	            return false;
 	        }
 	        if (typeof user_id === 'undefined' || user_id === null) {
 	            if (typeof potpis === 'undefined' || potpis === "") {
 	                document.getElementById('modal_error_errors').innerHTML = "<p class=\"alert alert-danger \"> Morate se prijaviti ili  potpisati!</p>";
 	                return false;
 	            } else {
 	                postErrorComments(comments_id, reason, text, potpis);
 	                return true;
 	            }
 	        }
 	        postErrorComments(comments_id, reason, text, null);
 	        document.getElementById('modal_error_select').value = "";
 	        return true;
 	    });
 	    $('button.modal_cancle').click(function(event) {
 	        return true;
 	    });
 	});

 	function checkErrorComments(comments_id) {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + '/comments/checkErrorComments',
 	        type: "get",
 	        data: {
 	            'comments_id': comments_id
 	        },
 	        success: function(data) {
 	            if (data.success === 'false') {
 	                return false;
 	            } else {
 	                return true;
 	            }
 	        }
 	    });
 	}

 	function postErrorComments(comments_id, reason, text, potpis) {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + '/comments/errorComments',
 	        type: "post",
 	        data: {
 	            'comments_id': comments_id,
 	            'potpis': potpis,
 	            'text': text,
 	            'reason': reason
 	        },
 	        success: function(data) {
 	            return false;
 	        }
 	    });
 	}

 	function postRecomments(id, potpis, text, text_id) {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + '/comments/recomments',
 	        type: "post",
 	        data: {
 	            'id': id,
 	            'potpis': potpis,
 	            'text': text,
 	            'text_id': text_id
 	        },
 	        success: function(data) {
 	            if (data.success) {
 	                readComments(data);
 	            } else {
 	                document.getElementById('errors').innerHTML = "<p class=\"alert alert-danger \">" + data.messages + "</p>";
 	            }
 	        }
 	    });
 	}

 	function sendID(id) {
 	    $("#modal_errors").empty();
 	    document.getElementById('modal_comments').innerHTML = "<input type=\"hidden\" id=\"comments_id\" value=" + id + ">"
 	}

 	function readComments(data) {
 	    document.getElementById('count_comm').innerHTML = 'Komentari (' + data.messages.length + ')';
 	    for (var i = 0; i < data.messages.length; i++) {
 	        var div = document.createElement('div');
 	        div.id = data.messages[i].id;
 	        div.className = '';
 	        if (data.messages[i].username !== null) {
 	            div.innerHTML = "<p><label class='text-danger' > ~" + data.messages[i].username + ":</label> " + data.messages[i].text + "</P> <br> <small>" + data.messages[i].created_at + " |minus <label id='" + data.messages[i].id + "_minus'> " + data.messages[i].minus + " </label>" + " |plus <label id='" + data.messages[i].id + "_plus'> " + data.messages[i].plus + " </label>" + "</small> <button type='button' id='" + data.messages[i].id + "'onclick='up(this.id)' class='up'><span class='glyphicon glyphicon-thumbs-up'></span> </button>" + " <button type='button' id='" + data.messages[i].id + "'onclick='down(id)' class='down'><span class='glyphicon glyphicon-thumbs-down'></span></button> " + " <button type='button'  onclick='sendID(id)' id='" + data.messages[i].id + "' data-toggle='modal' data-target='#myModal'>Komentar</button>" + " <button type='button'  data-toggle='modal' data-target='#reportModal' onclick='reportError(id,\" " + data.messages[i].text + " \")' id='" + data.messages[i].id + "'>Prijavi</button>" + "<hr>";
 	        } else {
 	            div.innerHTML = "<p><label class='text-danger' > ~" + data.messages[i].email + ":</label> " + data.messages[i].text + "</P> <br> <small>" + data.messages[i].created_at + " |minus <label id='" + data.messages[i].id + "_minus'> " + data.messages[i].minus + " </label>" + " |plus <label id='" + data.messages[i].id + "_plus'> " + data.messages[i].plus + " </label>" + "</small> <button type='button' id='" + data.messages[i].id + "'onclick='up(this.id)' class='up'><span class='glyphicon glyphicon-thumbs-up'></span> </button>" + " <button type='button' id='" + data.messages[i].id + "'onclick='down(id)' class='down'><span class='glyphicon glyphicon-thumbs-down'></span></button> " + " <button type='button'  onclick='sendID(id)' id='" + data.messages[i].id + "' data-toggle='modal' data-target='#myModal'>Komentar</button>" + " <button type='button'  data-toggle='modal' data-target='#reportModal' onclick='reportError(id,\" " + data.messages[i].text + " \")' id='" + data.messages[i].id + "'>Prijavi</button>" + "<hr>";
 	        }
 	        document.getElementById('comm').appendChild(div);
 	    }
 	}

 	function reportError(id, text) {
 	    $("#modal_error_errors").empty();
 	    if (typeof potpis !== 'undefined') {
 	        document.getElementById('modal_error_potpis').value = "";
 	    }
 	    document.getElementById('modal_error_text').value = "";
 	    document.getElementById('modal_error_comments_text').innerHTML = text;
 	    document.getElementById('modal_error_comments').innerHTML = "<input type=\"hidden\" id=\"modal_error_comments_id\" value=" + id + ">";
 	}

 	function up(id) {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + '/comments/plus',
 	        type: "get",
 	        data: {
 	            'id': id
 	        },
 	        success: function(data) {
 	            document.getElementById(id + '_plus').innerHTML = data;
 	        }
 	    });
 	}

 	function down(id) {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + '/comments/minus',
 	        type: "get",
 	        data: {
 	            'id': id
 	        },
 	        success: function(data) {
 	            document.getElementById(id + '_minus').innerHTML = data;
 	        }
 	    });
 	}

 	function sortLatest() {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + "/comments/sortbyCreate",
 	        type: "get",
 	        data: {
 	            'id': $("input[name=text_id]").val()
 	        },
 	        success: function(data) {
 	            $("#comm").empty();
 	            readComments(data);
 	        }
 	    });
 	}

 	function sortPlus() {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + "/comments/sortbyPlus",
 	        type: "get",
 	        data: {
 	            'id': $("input[name=text_id]").val()
 	        },
 	        success: function(data) {
 	            $("#comm").empty();
 	            readComments(data);
 	        }
 	    });
 	}

 	function sortMinus() {
 	    var url = window.location.pathname;
 	    $.ajax({
 	        url: url + "/comments/sortbyMinus",
 	        type: "get",
 	        data: {
 	            'id': $("input[name=text_id]").val()
 	        },
 	        success: function(data) {
 	            $("#comm").empty();
 	            readComments(data);
 	        }
 	    });
 	}