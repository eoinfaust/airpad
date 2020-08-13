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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div class="popup">
      <div class="logo"><img src="eirpadtext.svg" alt="eirpad"></div>
        <form method="post" action="register.php" align="center">
          <input class="formfill" type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
          <input class="formfill" type="text" name="email" placeholder="email" value="<?php echo $email; ?>">
          <input class="formfill" type="password" name="password1" placeholder="password">
          <input class="formfill" type="password" name="password2" placeholder="confirm password">
          <button class="button" name="reg_user">Register</button>
        </form>
        <?php include('errors.php'); ?>
        <p class = "footer" align="center" >
        <a>Already have an account?&ensp;</a>
        <a class="link" href="signin.php">Sign in <i class="fa fa-chevron-right"></i></a></p>
        <p class = "footer" align="center" >
        <a class="small link" href="about.php"><i class="fa fa-book"></i> about&ensp;</a>
        <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
        <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
  </body>
</html>