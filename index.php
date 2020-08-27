<?php
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | Home</title>
    <link rel="stylesheet" href="css/main.css?version=1">
    <link rel="stylesheet" href="css/dropdowns.css?version=1">
    <link rel="stylesheet" href="css/buttons.css?version=1">
    <link rel="stylesheet" href="css/input.css?version=1">
    <link rel="stylesheet" href="css/navbar.css?version=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">
    <link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.cookie ="activedevice=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    </script>
  </head>
  <body>
    <nav>
      <div class="nav-logo">
        <a href="index.php" ><img class="img" src="icon/eirpadtext.svg" alt="eirpad"></a>
      </div>
      <div class="nav-logo-m">
        <a href="index.php" >
        <?php  if (isset($_SESSION['username'])) : ?>
          <img class="img" src="icon/eirpad.svg" alt="eirpad">
        <?php endif ?>
        <?php  if (!isset($_SESSION['username'])) : ?>
          <img class="img" src="icon/eirpadtext.svg" alt="eirpad">
        <?php endif ?>
        </a>
      </div>
        <?php  if (isset($_SESSION['username'])) : ?>
        <ul class="nav-links-lin">
          <li><a><?=$_SESSION['username']?>&ensp;</a></li>
          <li><a class="link" id="alertstBtn"><i class="fa fa-bell"></i>&nbsp;alerts&ensp;</a></li>
          <li><a class="link" href="settings.php"><i class="fa fa-cog"></i>&nbsp;settings&ensp;</a></li>
          <li><a class="link" href="account.php"><i class="fas fa-laptop-house"></i>&nbsp;account&ensp;</a></li>
          <li><a class="linkbad" href="account.php?logout='1'"><i class="fa fa-sign-out-alt"></i>&nbsp;sign out</a></li>
        </ul>
        <?php endif ?>
        <?php  if (!isset($_SESSION['username'])) : ?>
        <ul class="nav-links-lout">
          <li><button class="button" id="signinmodBtn">Sign in</button></li>
          <li><button class="button" id="registermodBtn">Register</button></li>
        </ul>
        <?php endif ?>
      <ul class="nav-links-m">
        <?php  if (isset($_SESSION['username'])) : ?>
          <li><a class="icon-button" id="alertsBtn1"><i class="fa fa-bell"></i></a></li>
          <li><a class="icon-button" href="settings.php"><i class="fa fa-cog"></i></a></li>
          <li><a class="icon-button" href="account.php"><i class="fas fa-laptop-house"></i></a></li>
          <li><a class="icon-button linkbad" href="account.php?logout='1'"><i class="fa fa-sign-out-alt"></i></a></li>
        <?php endif ?>
        <?php  if (!isset($_SESSION['username'])) : ?>
          <li><a class="icon-button" id="signinmodBtn2"><i class="fa fa-sign-in-alt"></i></a></li>
          <li><a class="icon-button" id="registermodBtn2"><i class="fa fa-user-plus"></i></a></li>
        <?php endif ?>
      </ul>
    </nav>
    <div id="signinModal" class="modal">
      <div class="popup">
        <span class="close">&times;</i></span><br>
        <div class="logo"><img src="icon/eirpadtext.svg" alt="eirpad"></div>
        <form method="post" id="signinform" align="center">
          <p id=error12 class="reportb">Wrong username/password</p>
          <p id=error13 class="reportb">Username required</p>
          <div class="input-field">
            <input class="formfill" type="text" name="username" id="username" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="username">Username</label>
          </div>
          <p id=error14 class="reportb">Password required</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password" id="password" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="password">Password</label>
          </div>
          <span class= forgotlink id='#'>Forgot Password?</span>
          <div class="clearfix"></div>
          <input type="submit" class="button" name="signin_user" id="signin_user" value="Sign in">
        </form>
        <p align="center" >
        <a>No account?&ensp;</a>
        <a class="link" id="registermodBtn1">Register now <i class="fa fa-chevron-right"></i></a></p>
      </div>
    </div>
    <div id="registerModal" class="modal">
      <div class="popup">
        <span class="close">&times;</i></span><br>
        <div class="logo"><a href="index.php" ><img src="icon/eirpadtext.svg" alt="eirpad"></a></div>
        <form method="post" id="registerform" align="center">
          <p id=error1 class="reportb">Username required</p>
          <p id=error2 class="reportb">Must be 8-16 characters</p>
          <p id=error3 class="reportb">Must be alphanumeric</p>
          <p id=error10 class="reportb">Username in use</p>
          <div class="input-field">
            <input class="formfill" type="text" name="username1" id="username1" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="username1">Username</label>
          </div>
          <p id=error4 class="reportb">Email required</p>
          <p id=error5 class="reportb">Email is invalid</p>
          <p id=error11 class="reportb">Email in use</p>
          <div class="input-field">
            <input class="formfill" type="text" name="email" id="email" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="email">Email</label>
          </div>
          <p id=error6 class="reportb">Password required</p>
          <p id=error7 class="reportb">Must be 8-16 characters</p>
          <p id=error9 class="reportb">Passwords don't match</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password1" id="password1" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="password1">Password</label>
          </div>
          <p id=error8 class="reportb">Confirmation required</p>
          <div class="input-field">
          <input class="formfill" type="password" name="password2" id="password2" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
            <label for="password2">Confirm password</label>
          </div>
          <a class= forgotlink href="support.php"><i class="fa fa-question"></i> Get help</a>
          <div class="clearfix"></div>
          <input type="submit" class="button" name="reg_user" id="reg_user" value="Register">
        </form>
        <p align=center>
          <a class="tos" style="text-align:left;">By clicking "Register, you agree to our </a><a class="tos" href="terms">privacy policy</a><br>
          <a class="tos"> and </a><a class="tos" href="privacy">terms of service</a><a class="tos">.</a>
        </p>
        <p align="center" >
        <a>Have an account?&ensp;</a>
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
      <p align="center" >
      <a><br>Available for purchase online.&ensp;</a>
      <a class="link" href="https://www.amazon.com/" style="text-decoration: none;" >Buy <i class="fa fa-chevron-right" style="font-size:20px"></i></a>
      <br><br><a>Have a question or problem we can help you with?&ensp;</a>
      <a class="link" href="support.php" style="text-decoration: none";>Get in touch <i class="fa fa-chevron-right" style="font-size:20px"></i></a></p>
      <br>
    </div><br>
		<div class="footer" align="center">
			<a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
			<a class="small link" href="support.php"><i class="fa fa-question"></i> support&ensp;</a>
			<a class="small">&ensp;&copy; 2020 eirpad</a></p>
		</div>
    <script src="jsindex/modalsindex.js"></script>
    <script src="jsindex/signin.js"></script>
    <script src="jsindex/register.js"></script>
    <script src="js/navbar.js"></script>
  </body>
</html>