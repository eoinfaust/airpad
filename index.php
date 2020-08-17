<?php
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | Home</title>
    <link rel="stylesheet" href="eirpad.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">
    <link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script>
       function onSubmit(token) {
         document.getElementById("registerform").submit();
       }
     </script>
  </head>
  <body>
  <div class="head">
			<div class="clearfix">
				<a href="index.php" ><img class="img" src="icon/eirpadtext.svg" alt="eirpad"></a>
				<div class="headertext">
					<?php  if (isset($_SESSION['username'])) : ?>
						<a><?=$_SESSION['username']?></a>
						<a class="link" href="account.php">my account</a>
						<a class="link" href="support.php">support</a>
						<a class="linkbad" href="account.php?logout='1'">logout</a>
					<?php endif ?>
					<?php  if (!isset($_SESSION['username'])) : ?>
						<a class="link" id="signinmodBtn">sign in</a>
						<a class="link" id="registermodBtn">register</a>
						<a class="link" href="support.php">support</a>
					<?php endif ?>
				</div>
			</div>
    </div>
    <div id="signinModal" class="modal">
      <div class="popup">
        <span class="close"><i class="fa fa-times"></i></span>
        <div class="logo"><a href="index.php" ><img src="icon/eirpadtext.svg" alt="eirpad"></a></div>
        <form method="post" id="signinform" align="center">
          <p id=error1 class="reportb">Incorrect username/password</p>
          <p id=error2 class="reportb">Username required</p>
          <p id=error4 class="reportb">Username and password required</p>
          <div class="input-field">
            <input class="formfill" type="text" name="username" id="username" required>
            <label for="username">Username</label>
          </div>
          <p id=error3 class="reportb">Password required</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password" id="password" required>
            <label for="password">Password</label>
          </div>
          <input type="submit" class="button" name="signin_user" id="signin_user" value="Sign in" style="float:left;">
          <br>
          <a class="forgotlink" id="#" align=left>Forgot password?</a>
          <div class="clearfix"></div>
        </form>
        <p class = "footer" align="center" >
        <a>Need an account?&ensp;</a>
        <a class="link" id="registermodBtn1">Register now <i class="fa fa-chevron-right"></i></a></p>
      </div>
    </div>
    <div id="registerModal" class="modal">
      <div class="popup">
        <span class="close"><i class="fa fa-times"></i></span>
        <div class="logo"><a href="index.php" ><img src="icon/eirpadtext.svg" alt="eirpad"></a></div>
        <form method="post" id="registerform" align="center">
          <p id=error10 class="reportb">Username already exists</p>
          <p id=error19 class="reportb">Username is required</p>
          <p id=error29 class="reportb">Username length must be 8-16 characters</p>
          <p id=error39 class="reportb">Username must be alphanumeric</p>
          <div class="input-field">
            <input class="formfill" type="text" name="username1" id="username1" required>
            <label for="username1">Username</label>
          </div>
          <p id=error49 class="reportb">Email is required</p>
          <p id=error5 class="reportb">Email address is invalid</p>
          <p id=error11 class="reportb">Email already exists</p>
          <div class="input-field">
            <input class="formfill" type="text" name="email" id="email" required>
            <label for="email">Email</label>
          </div>
          <p id=error6 class="reportb">Password is required</p>
          <p id=error7 class="reportb">Password length must be 8-16 characters</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password1" id="password1" required>
            <label for="password1">Password</label>
          </div>
          <p id=error8 class="reportb">Password confirmation is required</p>
          <p id=error9 class="reportb">The two passwords do not match</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password2" id="password2" required>
            <label for="password2">Confirm password</label>
          </div>
          <input type="submit" class="button" name="reg_user" id="reg_user" value="Register" style="float:left;">
          <div class="clearfix"></div>
          <a class="tos" style="text-align:left;">By clicking "Register, you agree to our </a><a class="tos" href="terms">terms of service</a>
          <a class="tos"> and </a><a class="tos" href="privacy">privacy policy</a><a>.</a>
        </form>
        <p class = "footer" align="center" >
        <a>Already have an account?&ensp;</a>
        <a class="link" id="signinmodBtn1">Sign in <i class="fa fa-chevron-right"></i></a></p>
      </div>
    </div>
    <div class="mainpage";>
      <div class="clearfix">
        <p class="textright"><img class="imgleft" src="https://via.placeholder.com/400" alt="eirpad">
          <br><br>The eirpad is a privacy-oriented home monitoring device, for short-term rental hosts and property managers.</p>
          <p class="textright">The eirpad's plug-and-play design contains temperature, humidity, and noise sensors, for your peace of mind.</p>
          <p class="textright">Its privacy-oriented design records noise levels, with no intrusive microphones to pick up conversations.</p>
      </div>
      <div class="clearfix">
        <p class="textleft"><br><br><img class="imgright" src="https://via.placeholder.com/400" alt="eirpad">
          <br><br>Register with our web app for real time updates through the cloud, and view 7 days of data for all of your registered eirpad devices.</p>
          <p class="textleft">Receive notifications at high humidity levels, upon tampering, or when sustained noise levels exceed a desired threshold.</p>
          <p class="textleft">A comprehensive solution for noise and environmental monitoring, and antisocial behaviour prevention, for privacy-conscious hosts.</p>
      </div>
      <p class = "footer" align="center" >
      <a><br>Available for purchase online.&ensp;</a>
      <a class="link" href="https://www.amazon.com/" style="text-decoration: none;" >Buy <i class="fa fa-chevron-right" style="font-size:20px"></i></a>
      <br><br><a>Have a question or problem we can help you with?&ensp;</a>
      <a class="link" href="support.php" style="text-decoration: none";>Get in touch <i class="fa fa-chevron-right" style="font-size:20px"></i></a></p>
      <p class = "footer" align="center" >
      <?php  if (isset($_SESSION['username'])) : ?>
        <a class="small linkbad" href="index.php?logout='1'"><i class="fa fa-sign-out"></i> logout&ensp;</a>
      <?php endif ?>
      <?php  if (!isset($_SESSION['username'])) : ?>
        <a class="small link" href="signin.php"><i class="fa fa-sign-in"></i> sign in</a>
        <a>&nbsp;|&nbsp;</a>
        <a class="small link" href="register.php"><i class="fa fa-user-plus"></i> register&ensp;</a>
      <?php endif ?>
      <a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
      <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
    <script src="js/signin.js"></script>
    <script src="js/register.js"></script>
    <script src="js/modals.js"></script>
  </body>
</html>