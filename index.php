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
<html>
	<head>
		<title>airpad | My Dashboard</title>
		<link rel="stylesheet" href="main.css?version=3">
		<link rel="stylesheet" href="index.css?version=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/registration.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>
		<div class="head">
			<div class="clearfix">
				<img class="img3" src="airpad.png" alt="airpad" height="60">
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
		<div>
			<?php if (isset($_SESSION['success'])) : ?>
				<div class="error success" >
					<h3>
						<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
						?>
					</h3>
				</div>
			<?php endif ?>
		</div>
		<div class="dashboard">
			<a class="dashheading"><?=$_SESSION['username']?>'s dashboard</a>
			<div class="devicedropdown" >
				<button class="devicedropbtn">select device <i class="fa fa-chevron-down"></i></button>
				<div class="devicedropdown-content">
				</div>
			</div>
			<a>&nbsp;or&ensp;&ensp;</a>
			<a href="deviceadd.php" class="deviceadd" style="text-decoration: none;">add device <i class="fa fa-plus"></i></button>
			<div>
				<p class = "footer" align="center" >
				<?php  if (isset($_SESSION['username'])) : ?>
				<a class="small linkbad" href="index.php?logout='1'" style="text-decoration: none;" >logout&ensp;</a>
				<?php endif ?>
				<?php  if (!isset($_SESSION['username'])) : ?>
				<a class="small link" href="signin.php" style="text-decoration: none;" >sign in</a>
				<a>&nbsp;|&nbsp;</a>
				<a class="small link" href="register.php" style="text-decoration: none;" >register&ensp;</a>
				<?php endif ?>
				<a class="small link" href="about.php" style="text-decoration: none;" >about&ensp;</a>
				<a class="small link" href="support.php" style="text-decoration: none;" >support</a>
				<a class="small" >&ensp;&ensp;&copy; 2020 airpad</a></p>
			</div>
		</div>
	</body>
</html>