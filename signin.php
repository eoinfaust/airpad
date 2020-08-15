<?php 
  include('server.php');
  if (isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You are logged in";
  	header('location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | Sign in</title>
    <link rel="stylesheet" href="eirpad.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">
    <link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="icon/eirpadtext.svg" alt="eirpad"></div>
      <form method="post" id="signinform" align="center">
        <input class="formfill" type="text" name="username" id="username" placeholder="username">
        <input class="formfill" type="password" name="password" id="password" placeholder="password">
        <input type="submit" class="button" align="center" name="signin_user" id="signin_user" value="Sign in">
      </form>
      <?php include('errors.php'); ?>
      <p class = "footer" align="center" >
      <a>Need an account?&ensp;</a>
      <a class="link" href="register.php">Register now <i class="fa fa-chevron-right"></i></a></p>
      <p class = "footer" align="center">
      <a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
      <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
    <script>
      $(document).ready(function(){
        $('#signinform').submit(function(e){
          e.preventDefault();
          var data = $('#signinform').serializeArray();
          data.push({name: 'signin_user', value: '1'});
          var promise = $.ajax({
            type: "POST",
            url: 'server.php',
            data: data,
            cache: false
          });
          promise.then(function(data){
            if(data === 'fail'){
              alert('Invalid Credentials');
            }
            else{
              window.location.href = 'index.php';
            }
          });
        });
      });
    </script>
  </body>
</html>