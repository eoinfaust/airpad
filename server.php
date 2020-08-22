<?php
session_start();
$username = "";
$email    = "";
$deviceid = "";
$devicename   = "";
$report = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'eirpad');

if (isset($_POST['delete_device'])) {
    $username = $_SESSION['username'];
    $devicename = mysqli_real_escape_string($db, $_POST['devicefordeletion']);
    $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
    $stmt->bind_param("ss", $username, $devicename);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if (!$existdev){
        array_push($errors, "Device doesn't exist");
        echo 'failure';
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("UPDATE `devices` SET devicename=?, username=?, setting=? WHERE deviceid=?");
        $stmt->bind_param("ssss", '', '', '', $existdev['deviceid']);
        $stmt->execute();
        $stmt->close();
        echo 'success';
    }
}

if (isset($_POST['add_device'])) {
    $username = $_SESSION['username'];
    $deviceid = mysqli_real_escape_string($db, $_POST['deviceid']);
    $devicename = mysqli_real_escape_string($db, $_POST['devicename']);
    $namelen = validIdLen($devicename);
    $idlen = validIdLen($deviceid);
    $deviceadderrors = array_fill(0, 6, false);
    if (empty($deviceid)){ 
        array_push($errors, "Device ID is required");
        $deviceadderrors[0] = true;
    }
    if (empty($devicename)){ 
        array_push($errors, "Device name is required");
        $deviceadderrors[1] = true;
    }else if($namelen){ 
        array_push($errors, "Device name must contain 10 or fewer characters"); 
        $deviceadderrors[2] = true;
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
    $stmt->bind_param("ss", $username, $devicename);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev){
        array_push($errors, "You already have a device with that name");
        $deviceadderrors[3] = true;
    }
    $stmt = $db->prepare("SELECT * FROM devices WHERE deviceid=? LIMIT 1");
    $stmt->bind_param("s", $deviceid);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existdev = $result->fetch_assoc();
    $stmt->close();
    if ($existdev && ($existdev['username'] !== '')){
        array_push($errors, "Device already registered");
        $deviceadderrors[4] = true;
    }
    if (!$existdev){
        array_push($errors, "Device ID doesn't exist");
        $deviceadderrors[5] = true;
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("UPDATE `devices` SET devicename=?, username=? WHERE deviceid=?");
        $stmt->bind_param("sss", $devicename, $username, $deviceid);
        $stmt->execute();
        $stmt->close();
        echo 'success';
    }else{
        echo json_encode($deviceadderrors);
    }
}

if (isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username1']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $useLen = (validStrLen($username));
    $passLen = (validStrLen($password1));
    $regerrors = array_fill(0, 11, false);
    if (empty($username)) { 
        array_push($errors, "Username");
        $regerrors[0] = true;
    }else if ($useLen){ 
        array_push($errors, "Username length");
        $regerrors[1] = true;
    }else if (!ctype_alnum($username)){ 
        array_push($errors, "Username alphanumeric");
        $regerrors[2] = true;
    }
    if (empty($email)){ 
        array_push($errors, "Email");
        $regerrors[3] = true;
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        array_push($errors, "Email invalid"); 
        $regerrors[4] = true;
    }
    if (empty($password1)){ 
        array_push($errors, "Password"); 
        $regerrors[5] = true;
    }else if ($passLen){ 
        array_push($errors, "Password length");
        $regerrors[6] = true;
    }
    if (empty($password2)){ 
        array_push($errors, "Password confirmation"); 
        $regerrors[7] = true;
    }
    if ($password1 != $password2){ 
        array_push($errors, "Password match"); 
        $regerrors[8] = true;
    }
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt -> get_result();
    $existacc = $result->fetch_assoc();
    $stmt->close();
    if ($existacc){
        if ($existacc['username'] === $username){
        array_push($errors, "Username exists");
        $regerrors[9] = true;
        }
        if ($existacc['email'] === $email){
        array_push($errors, "Email exists");
        $regerrors[10] = true;
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
        echo json_encode($regerrors);
    }
}

if (isset($_POST['signin_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $loginerrors = array_fill(0, 3, false);
    if (empty($username)){
        array_push($errors, "Username");
        $loginerrors[0] = true;
    }
    if (empty($password)){
        array_push($errors, "Password");
        $passempty=true;
        $loginerrors[1] = true;
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
                $loginerrors[2] = true;
                echo json_encode($loginerrors);
            }
        }else{
            $loginerrors[2] = true;
            echo json_encode($loginerrors);
        }
    }else{
        echo json_encode($loginerrors);
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