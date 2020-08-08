<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'users');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  $useLen = (validStrLen($username));
  $passLen = (validStrLen($password1));
    if (empty($username)) { 
        array_push($errors, "Username is required"); 
    }else if ($useLen){ 
        array_push($errors, "Username length must be 8-16 characters"); 
    }else if (!ctype_alnum($username)){ 
        array_push($errors, "Username must only contain letters and numbers"); 
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

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) { 
    $hash = password_hash($password1, PASSWORD_BCRYPT);
  	$sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `device0`, `device1`, `device2`, `device3`) 
            VALUES (NULL, '".$username."', '".$email."','".$hash."', '', '', '', '')";
    mysqli_query($db, $sql);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['signin_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $sql = "SELECT `password` FROM users WHERE `username`='".$username."'";
        $query = mysqli_query($db, $sql);
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);
            $resultstring = $result['password'];
            if(password_verify($password, $resultstring)){
                $_SESSION['username'] = $username;
                $_SESSION['success'];
                header('location: index.php');
            }else{
                array_push($errors, "Wrong username/password combination");
            }
        }else{
            array_push($errors, "Wrong username/password combination");
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
?>