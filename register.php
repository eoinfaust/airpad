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
    <title>eirpad | Register</title>
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
      <form method="post" id="registerform" align="center">
        <p id=error1 class="reportb">Username is required</p>
        <p id=error2 class="reportb">Username length must be 8-16 characters</p>
        <p id=error3 class="reportb">Username must be alphanumeric</p>
        <p id=error4 class="reportb">Email is required</p>
        <p id=error5 class="reportb">Email address is invalid</p>
        <p id=error6 class="reportb">Password is required</p>
        <p id=error7 class="reportb">Password length must be 8-16 characters</p>
        <p id=error8 class="reportb">Password confirmation is required</p>
        <p id=error9 class="reportb">The two passwords do not match</p>
        <p id=error10 class="reportb">Username already exists</p>
        <p id=error11 class="reportb">Email already exists</p>
        <input class="formfill" type="text" name="username" id="username" placeholder="username">
        <input class="formfill" type="text" name="email" id="email" placeholder="email">
        <input class="formfill" type="password" name="password1" id="password1" placeholder="password">
        <input class="formfill" type="password" name="password2" id="password2" placeholder="confirm password">
        <input type="submit" class="button" align="center" name="reg_user" id="reg_user" value="Register">
      </form>
      <p class = "footer" align="center" >
      <a>Already have an account?&ensp;</a>
      <a class="link" href="signin.php">Sign in <i class="fa fa-chevron-right"></i></a></p>
      <p class = "footer" align="center" >
      <a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
      <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
    <script src="js/register.js"></script>
  </body>
</html>