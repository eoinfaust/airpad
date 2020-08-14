<?php
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | About</title>
    <link rel="stylesheet" href="eirpad.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">
    <link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
  </head>
  <body>
    <div class="head">
      <div class="clearfix">
        <img class="img3" src="eirpadtext.svg" alt="eirpad">
        <div class="dropdown" style="float:right;">
          <button class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
          <div class="dropdown-content">
            <?php  if (isset($_SESSION['username'])) : ?>
            <a class="small" style="text-decoration: none; color:darkgrey;" ><?=$_SESSION['username']?></a>
            <a class="small linkbad" href="index.php?logout='1'" style="text-decoration: none;" >logout</a>
            <a class="small link" href="index.php" style="text-decoration: none;" >dashboard</a>
            <?php endif ?>
            <?php  if (!isset($_SESSION['username'])) : ?>
            <a class="small link" href="signin.php" style="text-decoration: none;" >sign in</a>
            <a class="small link" href="register.php" style="text-decoration: none;" >register</a>
            <?php endif ?>
            <a class="small link" href="about.php" style="text-decoration: none;" >about</a>
            <a class="small link" href="support.php" style="text-decoration: none;" >support</a>
          </div>
        </div>
      </div>
    </div>
    <div class="mainpage";>
      <div class="clearfix">
        <p class="textright"><img class="imgleft" src="https://via.placeholder.com/400" alt="eirpad">
          <br><br>The eirpad is a privacy-oriented home monitoring device,<br> for short-term rental hosts and property managers.</p>
          <p class="textright">The eirpad's plug-and-play design contains temperature, humidity,<br> and noise sensors, for your peace of mind.</p>
          <p class="textright">Its privacy-oriented design records noise levels,<br> with no intrusive microphones to pick up conversations.</p>
      </div>
      <div class="clearfix">
        <p class="textleft"><br><br><img class="imgright" src="https://via.placeholder.com/400" alt="eirpad">
          <br><br>Register with our web app for real time updates through the cloud,<br> and view 7 days of data for all of your registered eirpad devices.</p>
          <p class="textleft">Receive notifications at high humiditiy levels, upon tampering,<br>or when sustained noise levels exceed a desired threshold.</p>
          <p class="textleft">A comprehensive solution for noise and environmental monitoring,<br>and antisocial behaviour prevention, for privacy-conscious hosts.</p>
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
      <a class="small link" href="about.php"><i class="fa fa-book"></i> about&ensp;</a>
      <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
      <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
  </body>
</html>