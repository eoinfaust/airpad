<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'eirpad');
define('SERVER_EMAIL', '');
define('SERVER_PASS', '');
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($db->connect_error){
    die('Database error');
}
$errors = array();
?>