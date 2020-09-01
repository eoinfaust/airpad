<?php
require_once 'vendor/autoload.php';
require_once 'config/constants.php';

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, ssl))
    -> setUsername(SERVER_EMAIL)
    -> setPassword(SERVER_PASS);

$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($email, $token){
    global $mailer;
    $body = '';
    $message = (new Swift_Message('Verify your email address | eirpad'))
        ->setFrom(EMAIL)
        ->setTo($email)
        -setBody($body, 'text/html');
}
function sendPassword(Type $var = null){
    #code
}

?>