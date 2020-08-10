<?php
session_start();
$username = "";
$email    = "";
$deviceid = "";
$devicename   = "";
$report = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'airpad');

if (isset($_POST['new_device'])) {
    $username = $_SESSION['username'];
    $deviceid = mysqli_real_escape_string($db, $_POST['deviceid']);
    $devicename = mysqli_real_escape_string($db, $_POST['devicename']);
    $namelen = validIdLen($devicename);
    $idlen = validIdLen($deviceid);
    if (empty($deviceid)){ 
        array_push($errors, "Device ID is required");
    }else if (!ctype_alnum($deviceid)){ 
        array_push($errors, "Device IDs must be alphanumeric"); 
    }else if($idlen){
        array_push($errors, "Device ID must contain 10 or fewer characters"); 
    }
    if (empty($devicename)){ 
        array_push($errors, "Device name is required"); 
    } else if ($namelen){ 
        array_push($errors, "Device name must contain 10 or fewer characters"); 
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
    $stmt->bind_param("ss", $username, $devicename);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev){
            array_push($errors, "You already have a device with that name");
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE deviceid=? LIMIT 1");
    $stmt->bind_param("s", $deviceid);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev && ($devicename !== '') ){
            array_push($errors, "Device already registered");
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("INSERT INTO `devices` (`deviceid`, `devicename`, `username`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $deviceid, $devicename, $username);
        $stmt->execute();
        $stmt->close();
        if ($stmt->error){
            header('Location:deviceadd.php?error=1');
        } else {
           header('Location:deviceadd.php?success=1');
        }
        $stmt->close();
    }
}

if (isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $useLen = (validStrLen($username));
    $passLen = (validStrLen($password1));
    if (empty($username)) { 
        array_push($errors, "Username is required"); 
    }else if ($useLen){ 
        array_push($errors, "Username length must be 8-16 characters"); 
    }else if (!ctype_alnum($username)){ 
        array_push($errors, "Username must be alphanumeric"); 
    }
    if (empty($email)){ 
        array_push($errors, "Email is required"); 
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        array_push($errors, "Email address is invalid"); 
    }
    if (empty($password1)){ 
        array_push($errors, "Password is required"); 
    }else if ($passLen){ 
        array_push($errors, "Password length must be 8-16 characters"); 
    }
    if (empty($password2)){ 
        array_push($errors, "Password confirmation is required"); 
    }
    if ($password1 != $password2){ 
        array_push($errors, "The two passwords do not match"); 
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
        }
        if ($existacc['email'] === $email){
        array_push($errors, "Email already exists");
        }
    }
    if (count($errors) == 0){ 
        $hash = password_hash($password1, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hash);
        $stmt->execute();
        $stmt->close();
        $_SESSION['username'] = $username;
        $_SESSION['success'];
        header('location: index.php');
    }
}

if (isset($_POST['signin_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)){
        array_push($errors, "Username is required");
    }
    if (empty($password)){
        array_push($errors, "Password is required");
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
                $_SESSION['success'];
                header('location: index.php');
            }else{
                array_push($errors, "Incorrect username/password");
            }
        }else{
            array_push($errors, "Incorrect username/password");
        }
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