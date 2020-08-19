<?php
session_start();
$username = "";
$email    = "";
$deviceid = "";
$devicename   = "";
$report = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'eirpad');

if (isset($_POST['add_device'])) {
    $username = $_SESSION['username'];
    $deviceid = mysqli_real_escape_string($db, $_POST['deviceid']);
    $devicename = mysqli_real_escape_string($db, $_POST['devicename']);
    $namelen = validIdLen($devicename);
    $idlen = validIdLen($deviceid);
    $didreq=$dnamereq=$dnamelen=$dnamex=$dalreg=$nodidex=false;
    if (empty($deviceid)){ 
        array_push($errors, "Device ID is required");
        $didreq=true;
    }
    if (empty($devicename)){ 
        array_push($errors, "Device name is required");
        $dnamerq=true;
    }else if($namelen){ 
        array_push($errors, "Device name must contain 10 or fewer characters"); 
        $dnamelen=true;
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
    $stmt->bind_param("ss", $username, $devicename);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev){
        array_push($errors, "You already have a device with that name");
        $dnamex=true;
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE deviceid=? LIMIT 1");
    $stmt->bind_param("s", $deviceid);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev && ($devicename !== '') ){
        array_push($errors, "Device already registered");
        $dalreg=true;
    }
    $stmt = $db->prepare("SELECT * FROM deviceids WHERE deviceid=? LIMIT 1");
    $stmt->bind_param("s", $deviceid);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if (!$existdev){
        array_push($errors, "Device ID doesn't exist");
        $nodidex=true;
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("INSERT INTO `devices` (`deviceid`, `devicename`, `username`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $deviceid, $devicename, $username);
        $stmt->execute();
        $stmt->close();
        echo 'successdev';
    }else{
        $errs4js[0] = $didreq;
        $errs4js[1] = $dnamereq;
        $errs4js[2] = $dnamelen;
        $errs4js[3] = $dnamex;
        $errs4js[4] = $dalreg;
        $errs4js[5] = $nodidex;
        echo json_encode($errs4js);
    }
}

if (isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username1']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $useLen = (validStrLen($username));
    $passLen = (validStrLen($password1));
    $nouser=$ulenbad=$userbad=$noemail=$bademail=$nopass=$pbleng=$nop2=$nomatch=$exuser=$exemail=false;
    if (empty($username)) { 
        array_push($errors, "Username is required");
        $nouser=true;
    }else if ($useLen){ 
        array_push($errors, "Username length must be 8-16 characters");
        $ulenbad=true;
    }else if (!ctype_alnum($username)){ 
        array_push($errors, "Username must be alphanumeric");
        $userbad=true;
    }
    if (empty($email)){ 
        array_push($errors, "Email is required");
        $noemail=true;
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        array_push($errors, "Email address is invalid"); 
        $bademail=true;
    }
    if (empty($password1)){ 
        array_push($errors, "Password is required"); 
        $nopass=true;
    }else if ($passLen){ 
        array_push($errors, "Password length must be 8-16 characters");
        $pbleng=true;
    }
    if (empty($password2)){ 
        array_push($errors, "Password confirmation is required"); 
        $nop2=true;
    }
    if ($password1 != $password2){ 
        array_push($errors, "The two passwords do not match"); 
        $nomatch=true;
    }
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existacc = $result->fetch_assoc();
    $stmt->close();
    if ($existacc){
        if ($existacc['username'] === $username){
        array_push($errors, "Username already exists");
        $exuser=true;
        }
        if ($existacc['email'] === $email){
        array_push($errors, "Email already exists");
        $exemail=true;
        }
    }
    if (count($errors) == 0){ 
        $hash = password_hash($password1, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hash);
        $stmt->execute();
        $stmt->close();
        $_SESSION['username'] = $username;
        echo ('success');
    }else{
        $errs4js[0] = $nouser;
        $errs4js[1] = $ulenbad;
        $errs4js[2] = $userbad;
        $errs4js[3] = $noemail;
        $errs4js[4] = $bademail;
        $errs4js[5] = $nopass;
        $errs4js[6] = $pbleng;
        $errs4js[7] = $nop2;
        $errs4js[8] = $nomatch;
        $errs4js[9] = $exuser;
        $errs4js[10] = $exemail;
        echo json_encode($errs4js);
    }
}

if (isset($_POST['signin_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $userempty=$passempty=$badcombo=false;
    if (empty($username)){
        array_push($errors, "Username is required");
        $userempty=true;
    }
    if (empty($password)){
        array_push($errors, "Password is required");
        $passempty=true;
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt -> get_result();
        $existacc = $result->fetch_assoc();
        $stmt->close();
        if (mysqli_num_rows($result) == 1){
            $resultstring = $existacc['password'];
            if(password_verify($password, $resultstring)){
                $_SESSION['username'] = $username;
                echo ('success');
            }else{
                array_push($errors, "Incorrect username/password");
                $errs4js[0] = $userempty;
                $errs4js[1] = $passempty;
                $errs4js[2] = true;
                echo json_encode($errs4js);
            }
        }else{
            array_push($errors, "Incorrect username/password");
            $errs4js[0] = $userempty;
            $errs4js[1] = $passempty;
            $errs4js[2] = true;
            echo json_encode($errs4js);
        }
    }else{
        $errs4js[0] = $userempty;
        $errs4js[1] = $passempty;
        $errs4js[2] = $badcombo;
        echo json_encode($errs4js);
    }
}
function validStrLen($str){
    $len = strlen($str);
    if($len < 8){
        return TRUE;
    }
    elseif($len > 16){
        return TRUE;
    }else{
        return FALSE;
    }
}
function validIdLen($str){
    $len = strlen($str);
    if($len <= 10){
        return FALSE;
    }else{
        return TRUE;
    }
}
?>