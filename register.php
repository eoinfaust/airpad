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
    <title>airpad | Register</title>
    <link rel="stylesheet" href="main.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="airpad.png" alt="airpad"></div>
        <form method="post" action="register.php">
          <?php include('errors.php'); ?>
          <input class="formfill" type="text" align="center" name="username" placeholder="username" value="<?php echo $username; ?>">
          <input class="formfill" type="text" align="center" name="email" placeholder="email" value="<?php echo $email; ?>">
          <input class="formfill" type="password" align="center" name="password1" placeholder="password">
          <input class="formfill" type="password" align="center" name="password2" placeholder="confirm password">
          <button class="button" name="reg_user" align="center">Register</button>
        </form>
        <p class = "footer" align="center" >
        <a>Already have an account?&ensp;</a>
        <a class="link" href="signin.php" style="text-decoration: none;" >Sign in <i class="fa fa-chevron-right"></i></a></p>
        <p class = "footer" align="center" >
        <a class="small link" href="about.php" style="text-decoration: none;" >about&ensp;</a>
        <a class="small link" href="support.php" style="text-decoration: none;" >support</a>
        <a class="small" >&ensp;&ensp; &copy; 2020 airpad</a></p>
    </div>
  </body>
</html>