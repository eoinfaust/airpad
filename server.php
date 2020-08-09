<?php
session_start();
$username = "";
$email    = "";
$deviceid = "";
$devicename   = "";
$report = "";
$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'users');

if (isset($_POST['new_device'])) {
    $username = $_SESSION['username'];
    $deviceid = mysqli_real_escape_string($db, $_POST['deviceid']);
    $devicename = mysqli_real_escape_string($db, $_POST['devicename']);
    $namelen = validNameLen($devicename);
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
        array_push($errors, "Device name must contain 16 or fewer characters"); 
    }else if (!ctype_alnum($devicename)){ 
        array_push($errors, "Device name must be alphanumeric"); 
    }
    $id_check_query = "SELECT * FROM users WHERE device0='$deviceid' OR device1='$deviceid' OR device2='$deviceid' OR device3='$deviceid' OR device4='$deviceid' LIMIT 1";
    $result = mysqli_query($db, $id_check_query);
    $id = mysqli_fetch_assoc($result);
    if ($id && ($devicename !== '') ){
            array_push($errors, "Device already registered");
    }else{
        $sql ="SELECT * FROM users WHERE (username ='$username' AND device0 IS NULL OR device0 = '') OR (username ='$username' AND device1 IS NULL OR device1 = '') OR (username ='$username' AND device2 IS NULL OR device2 = '') OR (username ='$username' AND device3 IS NULL OR device3 = '') OR (username ='$username' AND device4 IS NULL OR device4 = '')";
        $result = mysqli_query($db, $sql);
        $exists = mysqli_fetch_assoc($result);
        if(!$exists){
            array_push($errors, "You have already registered 5 devices");
        }
    }
    if (count($errors) == 0){ 
        $sql = "SELECT * FROM users WHERE (username='$username' AND device0 IS NULL OR device0 = '')";
        $result = mysqli_query($db, $sql);
        $isfree = mysqli_fetch_assoc($result);
        if($isfree){
            $sqlup = "UPDATE users SET device0=?, dname0=? WHERE username=?";
            $stmt = $db->prepare($sqlup);
            $stmt->bind_param('sss', $deviceid, $devicename, $username);
            $stmt->execute();
            if ($stmt->error){
                header('Location:deviceadd.php?error=1');
            } else {
               header('Location:deviceadd.php?success=1');
            }
            $stmt->close();
        }else{
            $sql = "SELECT * FROM users WHERE (username='$username' AND device1 IS NULL OR device1 = '')";
            $result = mysqli_query($db, $sql);
            $exists = mysqli_fetch_assoc($result);
            if($exists){
                $sqlup = "UPDATE users SET device1=?, dname1=? WHERE username=?";
                $stmt = $db->prepare($sqlup);
                $stmt->bind_param('sss', $deviceid, $devicename, $username);
                $stmt->execute();
                if ($stmt->error){
                    header('Location:deviceadd.php?error=1');
                } else {
                   header('Location:deviceadd.php?success=1');
                }
                $stmt->close();
            }else{
                $sql = "SELECT * FROM users WHERE (username='$username' AND device2 IS NULL OR device2 = '')";
                $result = mysqli_query($db, $sql);
                $exists = mysqli_fetch_assoc($result);
                if($exists){
                    $sqlup = "UPDATE users SET device2=?, dname2=? WHERE username=?";
                    $stmt = $db->prepare($sqlup);
                    $stmt->bind_param('sss', $deviceid, $devicename, $username);
                    $stmt->execute();
                    if ($stmt->error){
                        header('Location:deviceadd.php?error=1');
                    } else {
                       header('Location:deviceadd.php?success=1');
                    }
                    $stmt->close();
                }else{
                    $sql = "SELECT * FROM users WHERE (username='$username' AND device3 IS NULL OR device3 = '')";
                    $result = mysqli_query($db, $sql);
                    $exists = mysqli_fetch_assoc($result);
                    if($exists){
                        $sqlup = "UPDATE users SET device3=?, dname3=? WHERE username=?";
                        $stmt = $db->prepare($sqlup);
                        $stmt->bind_param('sss', $deviceid, $devicename, $username);
                        $stmt->execute();
                        if ($stmt->error){
                            header('Location:deviceadd.php?error=1');
                        } else {
                           header('Location:deviceadd.php?success=1');
                        }
                        $stmt->close();
                    }else{
                        $sqlup = "UPDATE users SET device4=?, dname4=? WHERE username=?";
                        $stmt = $db->prepare($sqlup);
                        $stmt->bind_param('sss', $deviceid, $devicename, $username);
                        $stmt->execute();
                        if ($stmt->error){
                            header('Location:deviceadd.php?error=1');
                        } else {
                           header('Location:deviceadd.php?success=1');
                        }
                        $stmt->close();
                    }
                }
            }
        }
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
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user){
        if ($user['username'] === $username){
        array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email){
        array_push($errors, "Email already exists");
        }
    }
    if (count($errors) == 0){ 
    $hash = password_hash($password1, PASSWORD_BCRYPT);
  	$sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `device0`, `device1`, `device2`, `device3`, `device4`, `dname0`, `dname1`, `dname2`, `dname3`, `dname4`) 
            VALUES (NULL, '".$username."', '".$email."','".$hash."', '', '', '', '', '', '', '', '', '', '')";
    mysqli_query($db, $sql);
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
        $sql = "SELECT `password` FROM users WHERE `username`='".$username."'";
        $query = mysqli_query($db, $sql);
        if (mysqli_num_rows($query) == 1){
            $result = mysqli_fetch_assoc($query);
            $resultstring = $result['password'];
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
function validNameLen($str){
    $len = strlen($str);
    if($len <= 16){
        return FALSE;
    }else{
        return TRUE;
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