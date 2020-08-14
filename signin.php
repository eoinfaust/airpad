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
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="icon/eirpadtext.svg" alt="eirpad"></div>
      <form method="post" action="signin.php" align="center">
        <input class="formfill" type="text" name="username" placeholder="username">
        <input class="formfill" type="password" name="password" placeholder="password">
        <button class="button" align="center" name="signin_user">Sign in</button>
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
  </body>
</html>