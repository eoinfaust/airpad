<?php
    if($_POST){
        require 'db_key.php';
        $conn = connect_db();
    if(isset($_POST['register']) ){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        //sanitize your input
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $passwordHashed = mysqli_real_escape_string($conn, $passwordHashed);
        //check for existing record
        $sql = "Select simplycoding_user.username From simplycoding_user Where username = '$username'";
        $sql = $conn->query($sql);
        $sql = $sql->fetch_assoc();
        if($sql){
            header('location: register.php');
            exit();
        }else{
            $sql = "Insert Into simplycoding_user (username, email, password) VALUES ('$username', '$email', '$passwordHashed')";
            $sql = $conn->query($sql);
            if($sql){
                echo "Registration succesful. You may <a href= '/'>login</a> now";
                //header('location: index.php');
            }
            //$sql = $sql->fetch_assoc();
            //echo $username.$email.$password;
        }
    }else if(isset($_POST['login']) ){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "Select * From simplycoding_user Where username = '$username'";
        $sql = $conn->query($sql);
        if($sql){
            $sql = $sql->fetch_assoc();
            if(password_verify($password, $sql['password'])){
                session_start();
                $_SESSION['username'] = $username;
                echo 'You have successfully logged-in';
                header('location: account.php');
            }
        }else{
            header('location: index.php');
            exit();
        }
    }
    }else{
        header('location: index.php');
        exit();
    }
    //header('location: index.php');
?>