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
    <title>airpad | Sign in</title>
    <link rel="stylesheet" href="main.css?version=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="airpad.png" alt="airpad"></div>
      <form method="post" action="signin.php">
        <?php include('errors.php'); ?>
        <input class="formfill" type="text" align="center" name="username" placeholder="username">
        <input class="formfill" type="password" align="center" name="password" placeholder="password">
        <button class="button" align="center" name="signin_user">Sign in</button>
      </form>
      <p class = "footer" align="center" >
      <a>Need an account?&ensp;</a>
      <a class="link" href="register.php" style="text-decoration: none;" >Register now <i class="fa fa-chevron-right"></i></a></p>
      <p class = "footer" align="center" >
      <a class="small link" href="about.php" style="text-decoration: none;" >about&ensp;</a>
      <a class="small link" href="support.php" style="text-decoration: none;" >support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 airpad</a></p>
    </div>
  </body>
</html>