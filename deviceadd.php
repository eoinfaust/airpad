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
    <title>airpad | Add device</title>
    <link rel="stylesheet" href="airpad.css?version=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div class="popup">
        <div class="logo"><a>Add a device to your account</a></div>
        <form method="post" action="deviceadd.php">
            <?php include('errors.php'); ?>
            <input class="formfill" type="text" align="center" name="deviceid" placeholder="device ID" value="<?php echo $deviceid; ?>">
            <input class="formfill" type="text" align="center" name="devicename" placeholder="your device name" value="<?php echo $devicename; ?>">
            <button class="button" name="new_device" align="center">Submit</button>
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
            <a class="small linkbad" href="index.php?logout='1'" style="text-decoration: none;" >logout&ensp;</a>
        <?php endif ?>
        <a class="small link" href="about.php" style="text-decoration: none;" >about&ensp;</a>
        <a class="small link" href="support.php" style="text-decoration: none;" >support</a>
        <a class="small" >&ensp;&ensp; &copy; 2020 airpad</a></p>
    </div>
  </body>
</html>