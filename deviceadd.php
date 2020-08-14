<?php 
    include('server.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: signin.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: signin.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>eirpad | Add device</title>
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
        <div class="logo"><a>Add a device to your account</a></div>
        <form method="post" action="deviceadd.php" align="center">
            <?php include('errors.php'); ?>
            <input class="formfill" type="text" align="center" name="deviceid" placeholder="device ID" value="<?php echo $deviceid; ?>">
            <input class="formfill" type="text" align="center" name="devicename" placeholder="your device name" value="<?php echo $devicename; ?>">
            <button class="button" name="new_device">Submit</button>
        </form>
          <?php if (!empty($_REQUEST['success'])) { ?>
            <p class="reportg" align="center">Device successfully registered</p>
          <?php } else if (!empty($_REQUEST['error'])) {?>
            <p class="reportb">Unidentified error, please contact support</p>
          <?php } ?>
        <p class = "footer" align="center" >
        <a class="linkbad" href="index.php" style="text-decoration: none;" >return to dashboard <i class="fa fa-chevron-right"></i></a></p>
        <p class = "footer" align="center" >
        <?php  if (isset($_SESSION['username'])) : ?>
          <a class="small linkbad" href="account.php?logout='1'"><i class="fa fa-sign-out"></i> logout&ensp;</a>
        <?php endif ?>
        <a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
        <a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
        <a class="small" >&ensp;&ensp; &copy; 2020 eirpad</a></p>
    </div>
  </body>
</html>