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
    <link rel="stylesheet" href="airpad.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="airpad.png" alt="airpad"></div>
      <form method="post" action="signin.php" align="center">
        <?php include('errors.php'); ?>
        <input class="formfill" type="text" name="username" placeholder="username">
        <input class="formfill" type="password" name="password" placeholder="password">
        <button class="button" align="center" name="signin_user">Sign in</button>
      </form>
      <p class = "footer" align="center" >
      <a>Need an account?&ensp;</a>
      <a class="link" href="register.php">Register now <i class="fa fa-chevron-right"></i></a></p>
      <p class = "footer" align="center">
      <a class="small link" href="about.php"><i class="fa fa-book"></i> about&ensp;</a>
      <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 airpad</a></p>
    </div>
  </body>
</html>