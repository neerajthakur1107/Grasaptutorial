<?php
session_start();
// print_r($_SESSION['userdata']['id']);
if(isset($_SESSION['user']) && $_SESSION['user']==true){
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Chat App</title>
</head>


<body class="bg-primary">
    
    <div class="container position-absolute top-50 start-50 translate-middle">
        <!-- register form -->
        <div class="card col-lg-6 col-sm-12 mx-auto mt-2 signup shadow" style="height:500px">
            <div class="card-body">
                <h5 class="card-title">Signup</h5>
                <hr>
                <p id="error" class="alert alert-danger text-center shadow-sm" style="display:none"></p>
                <form id="register_form">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
<div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="#" id="gotologin" style="text-decoration:none">Already Have An Account !</a>
                    </div>
                </form>
            </div>
        </div>
         <!-- form end -->
         <!-- login start -->
        <div class="card col-lg-6 col-sm-12 mx-auto mt-2 login shadow" style="height:500px;display: none;">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <hr>
                <p id="error" class="alert alert-danger text-center shadow-sm" style="display:none"></p>
                <form id="login_form">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="#" id="gotosignup" style="text-decoration:none">Create New Account !</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- login end -->
        <!-- chat start -->
        <div class="card col-lg-10 col-sm-12 mx-auto mt-2 chat shadow" style="display: none;">
            <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Group Chat</h5>
                <a href="php/logout.php" class="btn btn-sm btn-danger">Logout</a>
                </div>
                <hr>
                <div class="m-2 p-2" id="messages" class="" style="height:400px;overflow-y: scroll;">
            </div>
                
                <div class="mb-2 p-2 text-danger ts" ></div>

                <div class="input-group mb-3" >

                    <input type="text" id="msg" class="form-control" placeholder="Message..." aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary sendmsg" type="button" id="button-addon2">Send</button>
                </div>
            </div>
        </div>
        <!-- chat end -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    var mget = false;
$(document).ready(function(){
var user = <?= isset($_SESSION['user'])?$_SESSION['user']:0 ?>;
if(user){
$('.signup').remove();
$('.login').remove();
$('.chat').show();
getMessages();
mgetf();

}
});

function mgetf(){
    if(!mget){
    setInterval(getMessages, 1000);
    setInterval(typingoff, 700);
    setInterval(typing_status, 500);
    mget=true;
}
}
// register ajax
    $('#register_form').submit(function(e){
        e.preventDefault();
        var url = 'php/work.php?register=true';
        var data = $(this).serialize();
        $.ajax({
  method: "POST",
  url: url,
  data:data,
  dataType:'json'
})
  .done(function( data ) {
      if(data.status){
        $(".signup #error").hide('10');
        $('#register_form').trigger('reset');
        $(".signup").hide('fast',function(){
            $('.signup').remove();
            $('.login').show('fast');
        
        });
 
        

      }else{
          $(".signup #error").show('10');
$(".signup #error").text(data.message);

      }
   
  });
    });
        


//login ajax
$('#login_form').submit(function(e){
        e.preventDefault();
        var url = 'php/work.php?login=true';
        var data = $(this).serialize();
        $.ajax({
  method: "POST",
  url: url,
  data:data,
  dataType:'json'
})
  .done(function( data ) {
      console.log(data);
      if(data.status){
        $(".login #error").hide('10');
        $('#login_form').trigger('reset');
        $(".login").hide('fast',function(){
            $('.login').remove();
            $('.chat').show('fast');
            getMessages();
            mgetf();
        
        });
 
        

      }else{
          $(".login #error").show('10');
$(".login #error").text(data.message);

      }
   
  });
    });

    $("#gotologin").click(function(){
$('.signup').hide('fast');
$('.login').show('fast');
    });

    $("#gotosignup").click(function(){
$('.login').hide('fast');
$('.signup').show('fast');
    });

    var prev;
function getMessages(){

    var url = 'php/work.php?getmessages=true';

    $.ajax({
  method: "POST",
  url: url,
})
  .done(function( data ) {
    $('#messages').html(data);
    if(prev!==data){
        $('#messages').scrollTop(1E10);

    }
      prev=data;
 
});
}

$('.sendmsg').click(function(){
    var url = 'php/work.php?sendmessage=true';
var msg = $('#msg').val();
    $.ajax({
  method: "POST",
  data:{message:msg},
  url: url,
})
  .done(function( data ) {
    $('#msg').val('');
    

 
});
});

function typingoff(){
    var url = 'php/work.php?typing=true';
    $.ajax({
  method: "POST",
  data:{typing:false},
  url: url,
})
  .done(function( data ) {
    
});
}

function typing_status(){
    var url = 'php/work.php?typingstatus=true';
    $.ajax({
  method: "POST",
  url: url,
})
  .done(function( data ) {
      $('.ts').text(data);
    console.log(data);
});
}

$('#msg').keydown(function(){
    var url = 'php/work.php?typing=true';
    $.ajax({
  method: "POST",
  data:{typing:true},
  url: url,
})
  .done(function( data ) {
    console.log(data);
});
});

    </script>
</body>

</html>