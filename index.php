<?php 
  session_start(); 
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
    <title>My Account</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>
	<body>
		<div class="header">
			<h2>Home Page</h2>
		</div>
		<div class="content">
			<!-- notification message -->
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

			<!-- logged in user information -->
			<?php  if (isset($_SESSION['username'])) : ?>
				<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
				<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
			<?php endif ?>
		</div>		
	</body>
</html>