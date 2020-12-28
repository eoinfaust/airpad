<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

session_start();
$username = "";
$email    = "";
$deviceid = "";
$devicename   = "";
$report = "";
$db = mysqli_connect('localhost', 'root', '', 'eirpad');
$errors = array();

if (isset($_POST['contact'])){
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $message = mysqli_real_escape_string($db, $_POST['message']);
    $contacterrors = array_fill(0, 6, false);
    if (empty($name)) { 
        array_push($errors, "Username");
        $contacterrors[0] = true;
    } else if(strlen($name)>100){
        array_push($errors, "Username Length");
        $contacterrors[5] = true;
    }
    if (empty($email)){ 
        array_push($errors, "Email");
        $contacterrors[1] = true;
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        array_push($errors, "Email invalid"); 
        $contacterrors[2] = true;
    }
    if (empty($message)){ 
        array_push($errors, "Message"); 
        $contacterrors[3] = true;
    }
    if (strlen($message)>500){ 
        array_push($errors, "Messag Length"); 
        $contacterrors[4] = true;
    }
    if (count($errors) == 0){
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'eirpadcs@gmail.com';                   // SMTP username
            $mail->Password   = 'eirCSPADWORD';                         // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('eirpadcs@gmail.com', 'eirpad Support');
            $mail->addAddress('eirpadcs@gmail.com');                                  // Add a recipient
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'New Contact | eirpad';
            $body = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Verify Email</title>
                <style>
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                        Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                    }
                </style>
            </head>
            <body>
                <div style="display:inline-block;">
                    <p align=left>
                        <h1>A new query has been received.</h1><br>
                        Message from '.$name.' at '.$email.'.
                    </p><br>
                    <p>'.$message.'</p>
                </div>
            </body>
            </html>';
            $mail->Body = $body; 
            $mail->AltBody = strip_tags($body);
            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "mailfail";
        }
    }else{
        echo json_encode($contacterrors);
    }
}

if (isset($_POST['change_device'])){
    $username = $_SESSION['username'];
    $devicename = mysqli_real_escape_string($db, $_POST['newname']);
    $oldname = mysqli_real_escape_string($db, $_POST['oldname']);
    $namelen = validIdLen($devicename);
    $devicechangeerrors = array_fill(0, 3, false);
    $mode='off';
    if (isset($_POST['turn_on'])){
        if (isset($_POST['notifications'])){
            if(isset($_POST['security_mode'])){
                $mode='notsec';
            }else{
                $mode='not';
            }
        }else{
            if(isset($_POST['security_mode'])){
                $mode='sec';
            }else{
                $mode='none';
            }
        }
    }
    if (!empty($devicename)){ 
        if($namelen){ 
            array_push($errors, "Device name must contain 10 or fewer characters"); 
            $devicechangeerrors[0] = true;
        }
        $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
        $stmt->bind_param("ss", $username, $devicename);
        $stmt->execute();
        $result = $stmt -> get_result();
        $existdev = $result->fetch_assoc();
        $stmt->close();
        if ($existdev){
            array_push($errors, "You already have a device with that name");
            $devicechangeerrors[1] = true;
        }
        $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
        $stmt->bind_param("ss", $username, $oldname);
        $stmt->execute();
        $result = $stmt -> get_result();
        $existdev = $result->fetch_assoc();
        $stmt->close();
        if (!$existdev){
            array_push($errors, "Device doesn't exist");
            $devicechangeerrors[2] = true;
        }
        if (count($errors) == 0){
            $stmt = $db->prepare("UPDATE `devices` SET devicename=?, setting=? WHERE deviceid=?");
            $stmt->bind_param("sss", $devicename, $mode, $existdev['deviceid']);
            $stmt->execute();
            $stmt->close();
            echo 'successren';
        }else{
            echo json_encode($devicechangeerrors);
        }
    }else{
        if (count($errors) == 0){
            $stmt = $db->prepare("SELECT * FROM devices WHERE username=? AND devicename=? LIMIT 1");
            $stmt->bind_param("ss", $username, $oldname);
            $stmt->execute();
            $result = $stmt -> get_result();
            $existdev = $result->fetch_assoc();
            $stmt->close();
            $stmt = $db->prepare("UPDATE `devices` SET setting=? WHERE deviceid=?");
            $stmt->bind_param("ss", $mode, $existdev['deviceid']);
            $stmt->execute();
            $stmt->close();
            echo 'success';
        }else{
            echo json_encode($devicechangeerrors);
        }
    }
}

if (isset($_POST['delete_device'])){
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
    }
    if (count($errors) == 0){
        $stmt = $db->prepare("UPDATE `devices` SET devicename='', username='', setting='' WHERE deviceid=?");
        $stmt->bind_param("s", $existdev['deviceid']);
        $stmt->execute();
        $stmt->close();
        echo 'success';
    }else{
        echo 'failure';
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
        $stmt = $db->prepare("UPDATE `devices` SET devicename=?, username=?, setting='not' WHERE deviceid=?");
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
        $token = bin2hex(random_bytes(50));
        $hash = password_hash($password1, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO `users` (`username`, `email`, `password`, `token`, `verified`) VALUES (?, ?, ?, ?, false)");
        $stmt->bind_param("ssss", $username, $email, $hash, $token);
        $stmt->execute();
        $stmt->close();
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'eirpadcs@gmail.com';                   // SMTP username
            $mail->Password   = 'Manor123!';                            // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setFrom('eirpadcs@gmail.com', 'eirpad Support');
            $mail->addAddress($email);                                  // Add a recipient
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Verify your email | eirpad';
            $body = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Verify Email</title>
                <style>
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                        Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                    }
                    .button {
                        cursor: pointer;
                        text-decoration: none;
                        color: #1593eb;
                        background: transparent;
                        border: 2px solid #1593eb;
                        border-radius: 3px;
                        padding-left: 1.5em;
                        padding-right: 1.5em;
                        padding-bottom: 0.5em;
                        padding-top: 0.5em;
                        font-size: 18px;
                        font-weight: 400;
                        box-shadow: 0px 12px 20px 2px rgba(0, 0, 0, 0.12);
                        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
                        transition: 0.2s;
                        width: auto;
                        margin-left:150px;
                        margin-top:50px;margin-bottom:50px;
                    }
                </style>
            </head>
            <body>
                <div style="display:inline-block;">
                    <p align=left>
                        <h1>Thank you for registering with eirpad.</h1><br>
                        Please click the link below to verify your email and be redirected to our site.
                    </p><br>
                    <p><a class = "button" align=center href="http://localhost/index.php?veremail='.$email.'&vertoken='.$token.'">Verify</a></p><br>
                    <p align=left>
                        Along with your device, this will allow your account to access all site functionalities.<br>
                        If you did not register an account with eirpad recently, you can safely ignore this email.
                    </p>
                    <p align=left>
                        Sent by the eirpad team.
                    </p>
                </div>
            </body>
            </html>';
            $mail->Body = $body; 
            $mail->AltBody = strip_tags($body);
            $mail->send();
            $_SESSION['verified'] = false;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            echo 'success';
        } catch (Exception $e) {
            echo "mailfail";
        }
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
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt -> get_result();
        $existacc = $result->fetch_assoc();
        $stmt->close();
        if (mysqli_num_rows($result) == 1){
            $resultstring = $existacc['password'];
            if(password_verify($password, $resultstring)){
                $_SESSION['username'] = $existacc['username'];
                $_SESSION['email'] = $existacc['email'];
                $_SESSION['verified'] = $existacc['verified'];
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