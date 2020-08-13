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
<html>
	<head>
		<title>airpad | My Dashboard</title>
		<link rel="stylesheet" href="airpad.css?version=7">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
		<div class="mainpage">
			<form method="post" class="custom-select">
				<?php
				$db = mysqli_connect('localhost', 'root', '', 'airpad');
				$stmt = $db->prepare("SELECT devicename FROM devices WHERE username=? ORDER BY devicename");
				$stmt->bind_param("s", $_SESSION['username']);
				$stmt->execute();
				$result = $stmt -> get_result();
				$stmt->close();
				$init = '0';
				$defaultselect = 'my devices';
				echo "<select id='devicechosen' onselect='getdevname()'>";
				echo "<option value='".$init."'> ".$defaultselect." </option>"; 
				while ($row = mysqli_fetch_array($result)) {
					echo "<option value='" .$row['devicename']."'> ".$row['devicename'] . "&nbsp;</option>"; 
				}
				echo "</select>";
				?>
			</form>
			<a href="deviceadd.php" class="deviceadd" style="text-decoration:none;">add device&ensp;<i class="fa fa-plus"></i></a>
			<div id="status" class="deviceinfo">
				<a class="devicechange">&ensp;settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i>&ensp;</a>
				<a class="devicechange">rename&nbsp;<i class="fa fa-edit" aria-hidden="true"></i>&ensp;</a>
				<a class="devicedelete">delete&nbsp;<i class="fa fa-ban" aria-hidden="true"></i></a>
			</div>
			<div>
				<p class = "footer" align="center" >
				<?php  if (isset($_SESSION['username'])) : ?>
					<a class="small linkbad" href="index.php?logout='1'"><i class="fa fa-sign-out"></i> logout&ensp;</a>
				<?php endif ?>
				<?php  if (!isset($_SESSION['username'])) : ?>
					<a class="small link" href="signin.php"><i class="fa fa-sign-in"></i> sign in</a>
					<a>&nbsp;|&nbsp;</a>
					<a class="small link" href="register.php"><i class="fa fa-file-signature"></i> register&ensp;</a>
				<?php endif ?>
				<a class="small link" href="about.php"><i class="fa fa-book"></i> about&ensp;</a>
       			<a class="small link" href="support.php"><i class="fa fa-question"></i> support</a>
        		<a class="small" >&ensp;&ensp; &copy; 2020 airpad</a></p>
			</div>
		</div>
		<script>
		$('#status').hide();
		var x, i, j, l, ll, selElmnt, a, b, c;
		x = document.getElementsByClassName("custom-select");
		l = x.length;
		for (i = 0; i < l; i++){
			selElmnt = x[i].getElementsByTagName("select")[0];
			ll = selElmnt.length;
			a = document.createElement("DIV");
			a.setAttribute("class", "select-selected");
			a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
			x[i].appendChild(a);
			b = document.createElement("DIV");
			b.setAttribute("class", "select-items select-hide");
			for (j = 1; j < ll; j++) {
				c = document.createElement("DIV");
				c.innerHTML = selElmnt.options[j].innerHTML;
				c.addEventListener("click", function(e) {
					var y, i, k, s, h, sl, yl;
					s = this.parentNode.parentNode.getElementsByTagName("select")[0];
					sl = s.length;
					h = this.parentNode.previousSibling;
					for (i = 0; i < sl; i++) {
						if (s.options[i].innerHTML == this.innerHTML) {
							s.selectedIndex = i;
							h.innerHTML = this.innerHTML;
							y = this.parentNode.getElementsByClassName("same-as-selected");
							yl = y.length;
							for (k = 0; k < yl; k++) {
								y[k].removeAttribute("class");
								}
								this.setAttribute("class", "same-as-selected");
								break;
							}
							//$("#status").load(window.location.href + " #status" );
							$('#status').show();
						}
						h.click();
					});
				b.appendChild(c);
			}
			x[i].appendChild(b);
			a.addEventListener("click", function(e){
				e.stopPropagation();
				closeAllSelect(this);
				this.nextSibling.classList.toggle("select-hide");
				this.classList.toggle("select-arrow-active");
				});
		}
		function closeAllSelect(elmnt){
			var x, y, i, xl, yl, arrNo = [];
			x = document.getElementsByClassName("select-items");
			y = document.getElementsByClassName("select-selected");
			xl = x.length;
			yl = y.length;
			for (i = 0; i < yl; i++){
				if (elmnt == y[i]){
					arrNo.push(i)
				}else{
					y[i].classList.remove("select-arrow-active");
				}
			}
			for (i = 0; i < xl; i++){
				if (arrNo.indexOf(i)){
					x[i].classList.add("select-hide");
				}
			}
		}
		document.addEventListener("click", closeAllSelect);
		function up(){
			if (document.getElementById("devicechosen").value != "0"){
				var dop = document.getElementById("srt").value;
			}
			alert(dop);
		}
		function myNewFunction(element){
			var text = element.options[element.selectedIndex].text;
			document.getElementById("test").innerHTML = text;
		}
		function getdevname() {
			var x = document.getElementById("devicechosen").value;
			document.getElementById("demo").innerHTML = x;
			//<button onclick="getdevname()">Try it</button>
		}
		</script>
	</body>
</html>