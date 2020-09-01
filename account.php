<?php 
	include('server.php');
  	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.php');
  	}
  	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: index.php");
  	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<html>
	<head>
		<title>eirpad | My Account</title>
		<link rel="stylesheet" href="css/main.css?version=1">
		<link rel="stylesheet" href="css/buttons.css?version=1">
		<link rel="stylesheet" href="css/input.css?version=1">
		<link rel="stylesheet" href="css/navbar.css?version=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
		<link rel="manifest" href="/icon/site.webmanifest">
		<link rel="mask-icon" href="/icon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
				<li><button class="icon-button" id="alertsBtn1"><i class="fa fa-bell"></i></button></li>
				<li><a class="icon-button" href="settings.php"><i class="fa fa-cog"></i></a></li>
				<li><a class="icon-button" href="account.php"><i class="fas fa-laptop-house"></i></a></li>
				<li><a class="icon-button linkbad" href="account.php?logout='1'"><i class="fa fa-sign-out-alt"></i></a></li>
				<?php endif ?>
				<?php  if (!isset($_SESSION['username'])) : ?>
				<li><button class="icon-button" id="signinmodBtn2"><i class="fa fa-sign-in"></i></button></li>
				<li><button class="icon-button" id="registermodBtn2"><i class="fa fa-user-plus"></i></button></li>
				<?php endif ?>
			</ul>
		</nav>
		<div id="deviceaddModal" class="modal">
			<div class="popup">
				<span class="close">&times;</span><br>
				<div class="logo"><a>Add a device to your account</a></div>
				<form method="post" id="deviceaddform" align="center">
					<p id=error1 class="reportb">Device ID required</p>
					<p id=error5 class="reportb">Device in use</p>
					<p id=error6 class="reportb">Device ID doesn't exist</p>
					<div class="input-field">
						<input class="formfill" type="text" name="deviceid" id="deviceid" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
						<label for="deviceid">Device ID</label>
					</div>
					<p id=error2 class="reportb">Name required</p>
					<p id=error3 class="reportb">10 characters max</p>
					<p id=error4 class="reportb">Name already exists</p>
					<div class="input-field">
						<input class="formfill" type="text" name="devicename" id="devicename" required oninvalid="this.setCustomValidity('You must fill in all fields before submission')" oninput="this.setCustomValidity('')">
						<label for="devicename">Device name</label>
					</div>
					<div class="tooltip" ontouchstart>Help
						<span class="tooltiptext">Device IDs are found on the underside of each device. Device IDs are 10 characters long, and are all alphanumeric.<br><br>
						Choose a 10-character name to help you identify this device. This can be changed later.<br><br>
						<b>Need further assistance?</b> Please use a support form to get in touch.</span>
					</div>
          			<div class="clearfix"></div>
					<input type="submit" class="button" name="add_device" id="add_device" value="Add">
				</form>
			</div>
		</div>
		<div id="devicedeleteModal" class="modal">
			<div class="popup">
				<span class="close">&times;</i></span>
				<div class="logo"><br><a>Are you sure you want to delete<br><a style="color:#1593eb;" id="dnamedel"></a><a><br>from your account?</a></div>
				<form method="post" id="devicedelete" align="center">
					<input type="submit" class="button linkbad" name="delete_device" id="delete_device" value="Delete">
					<div class="clearfix"></div>
				</form>
				<p align=center>
					<a class="tos" style="text-align:left;">Removing this device will delete its associated data.<br>
					You can add this device again later.</a>
				</p>
			</div>
		</div>
		<div id="devicechangeModal" class="modal">
			<div class="popup">
				<span class="close">&times;</i></span>
				<div class="logo"><br><a>Change the settings for<br><a style="color:#1593eb;" id="dchange"></a></div>
				<form method="post" id="devicechange" align="center">
					<ul class="settings-list-text" align="left">
						<li><a>Turn on/off</a></li>
						<li id='notswitch1'><a>Notifications</a></li>
						<li id='secswitch1'><a>Security mode</a></li>
					</ul>
					<ul class="settings-list">
						<?php
						if(isset($_COOKIE['activedevice'])) {
							$device = $_COOKIE['activedevice'];
							$db = mysqli_connect('localhost', 'root', '', 'eirpad');
							$stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=?");
							$stmt->bind_param("ss", $_SESSION['username'], $device);
							$stmt->execute();
							$result = $stmt -> get_result();
							$existdev = $result->fetch_assoc();
							$stmt->close();
							if($existdev['setting']==='none'){
								echo "
								<li><label class='switch'>
									<input type='checkbox' id='turn-on' name='turn_on' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='notswitch'><label class='switch'>
									<input type='checkbox' id='notifications' name='notifications' value='true'>
									<span class='slider'></span>
								</label></li>
								<li id='secswitch'><label class='switch'>
									<input type='checkbox' id='security-mode' name='security_mode' value='true'>
									<span class='slider'></span>
								</label></li>";
							}else if($existdev['setting']==='not'){
								echo "
								<li><label class='switch'>
									<input type='checkbox' id='turn-on' name='turn_on' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='notswitch'><label class='switch'>
									<input type='checkbox' id='notifications' name='notifications' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='secswitch'><label class='switch'>
									<input type='checkbox' id='security-mode' name='security_mode' value='true'>
									<span class='slider'></span>
								</label></li>";
							}else if($existdev['setting']==='notsec'){
								echo "
								<li><label class='switch'>
									<input type='checkbox' id='turn-on' name='turn_on' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='notswitch'><label class='switch'>
									<input type='checkbox' id='notifications' name='notifications' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='secswitch'><label class='switch'>
									<input type='checkbox' id='security-mode' name='security_mode' value='true' checked>
									<span class='slider'></span>
								</label></li>";
							}else if ($existdev['setting']==='sec'){
								echo "
								<li><label class='switch'>
									<input type='checkbox' id='turn-on' name='turn_on' value='true' checked>
									<span class='slider'></span>
								</label></li>
								<li id='notswitch'><label class='switch'>
									<input type='checkbox' id='notifications' name='notifications' value='true'>
									<span class='slider'></span>
								</label></li>
								<li id='secswitch'><label class='switch'>
									<input type='checkbox' id='security-mode' name='security_mode' value='true' checked>
									<span class='slider'></span>
								</label></li>";
							}else{
								echo "
								<li><label class='switch'>
									<input type='checkbox' id='turn-on' name='turn_on' value='true'>
									<span class='slider'></span>
								</label></li>
								<li id='notswitch'><label class='switch'>
									<input type='checkbox' id='notifications' name='notifications' value='true'>
									<span class='slider'></span>
								</label></li>
								<li id='secswitch'><label class='switch'>
									<input type='checkbox' id='security-mode' name='security_mode' value='true'>
									<span class='slider'></span>
								</label></li>";
							}
						}
						?>
					</ul><br><br>
					<p id=error7 class="reportb">10 characters max</p>
					<p id=error8 class="reportb">Name already exists</p>
					<div class="input-field">
						<input class="formfill" type="text" name="newname" id="newname" required>
						<label for="newname">Rename Device</label>
					</div>
					<div class="tooltip" ontouchstart>Help
						<span class="tooltiptext">You can rename your device here - name length is limited to 10 characters, and cannot be the same as an existing device registered to your account.<br><br>
						If you turn this device off, you will no longer receive alerts; its data will not be recorded in our servers. <br><br>
						If you enable notifications, you will receive monitoring alerts for this device. If you enable security mode, you will receive security alerts if anomalous sound is detected.<br><br>
						<b>Need further assistance?</b> Please use a support form to get in touch.</span>
					</div>
					<div class="clearfix"></div>
					<input type="submit" class="button" name="change_device" id="change_device" value="Save changes">
				</form>
			</div>
		</div>
		<div>
			<ul class="deviceinfo0">
				<form method="post" class="custom-select">
					<?php
					$db = mysqli_connect('localhost', 'root', '', 'eirpad');
					$stmt = $db->prepare("SELECT devicename FROM devices WHERE username=? ORDER BY devicename");
					$stmt->bind_param("s", $_SESSION['username']);
					$stmt->execute();
					$result = $stmt -> get_result();
					$stmt->close();
					$defaultselect = "my devices";
					if(isset($_COOKIE['activedevice'])) {
						$defaultselect = $_COOKIE['activedevice'];
					}
					echo "<select id='devicechosen'>";
					echo "<option value='".$defaultselect."'> ".$defaultselect." </option>"; 
					while ($row = mysqli_fetch_array($result)) {
						if($row['devicename'] != $_COOKIE['activedevice']){
							echo "<option value='" .$row['devicename']."'> ".$row['devicename'] . "</option>"; 
						}
					}
					echo "</select>";
					?>
				</form>
				<div class="deviceinfo1">
					<a id="deviceaddBtn" class="icon-button"><i class="fa fa-plus"></i></a>
					<li><a id="devicechangeBtn" class="icon-button"><i class="fa fa-edit"></i></a></li>
					<li><a id="devicedeleteBtn" class="icon-button linkbad"><i class="fa fa-ban"></i></a></li>
				</div>
			</ul>
		</div>
		<br>
		<div class="footer" align="center">
			<a class="small link" href="index.php"><i class="fa fa-home"></i> home&ensp;</a>
			<a class="small link" href="support.php"><i class="fa fa-question"></i> support&ensp;</a>
			<a class="small">&ensp;&copy; 2020 eirpad</a></p>
		</div>
		<script src="jsaccount/dropdown.js"></script>
		<script src="jsaccount/modalsaccount.js"></script>
		<script src="jsaccount/deviceadd.js"></script>
		<script src="jsaccount/devicedelete.js"></script>
		<script src="jsaccount/devicechange.js"></script>
		<script src="js/navbar.js"></script>
	</body>
</html>