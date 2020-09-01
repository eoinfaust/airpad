<?php
session_start();
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  unset($_SESSION['verified']);
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | Support</title>
    <link rel="stylesheet" href="css/main.css?version=1">
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
            <a href="index.php" ><img class="img" src="icon/eirpad.svg" alt="eirpad"></a>
        </div>
        <div class="nav-logo-m">
            <a href="index.php" ><img class="img" src="icon/eirpad.svg" alt="eirpad"></a>
        </div>
        <a>Support</a>
    </nav>
    <div class='popup'style='overflow-x: hidden;padding-top:50px;padding-bottom:30px;'>
        <form method="post" id="contactform" align="center">
            <p id=error1 class="reportb">Name required</p>
            <p id=error6 class="reportb">100 characters max</p>
            <div class="input-field">
                <input class="formfill" type="text" name="name" id="name" value='<?php if(isset($_SESSION['username'])){echo ''.$_SESSION['username'].'';}?>' required oninvalid="this.setCustomValidity('All fields must be filled')" oninput="this.setCustomValidity('')">
                <label for="name">Name</label>
            </div>
            <p id=error2 class="reportb">Email required</p>
            <p id=error3 class="reportb">Email is invalid</p>
            <div class="input-field">
                <input class="formfill" type="text" name="email" id="email" value='<?php if(isset($_SESSION['username'])){echo ''.$_SESSION['email'].'';}?>' required oninvalid="this.setCustomValidity('All fields must be filled')" oninput="this.setCustomValidity('')">
                <label for="email">Email</label>
            </div>
            <p id=error4 class="reportb">Message required</p>
            <p id=error5 class="reportb">500 characters max</p>
            <div class="input-field">
                <textarea rows=10 class="formfill" name="message" id="message" required oninvalid="this.setCustomValidity('All fields must be filled')" oninput="this.setCustomValidity('')"></textarea>
                <label for="message">Your query</label>
            </div>
            <div class="tooltip">Help
                <span class="tooltiptext">Please use this support form to get in touch with any questions or issues related to eirpad devices and services.</span>
            </div>
            <div class="clearfix"></div>
            <input type="submit" class="button" name="contact" id="contact" value="Submit">
        </form>
        <a align=center id="success" class="success">Message submitted</a>
        <div align=center id="loading" class="loading"><img src="icon/ajax-loader.gif"></img></div>
    </div> 
    <div class="footer" align="center">
        <a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
        <a class="small">&ensp;&copy; 2020 eirpad</a></p>
    </div>
    <script src="js/contact.js"></script>
  </body>
</html>