<?php
require_once 'vendor/autoload.php';
require_once 'config/constants.php';

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, ssl))
    -> setUsername(SERVER_EMAIL)
    -> setPassword(SERVER_PASS);

$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($email, $token){
    global $mailer;
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
                .button:hover {
                filter: brightness(1.3);
                box-shadow: 0px 12px 30px 2px rgba(0, 0, 0, 0.25);
                transition: 0.2s;
            }
        </style>
    </head>
    <body>
        <div style="display:inline-block;">
            <p><img style="height: 60px; margin-left: 150px;" src="icon/eirpadtext.svg" align=center></img></p>
            <p align=left>
                <h1>Thank you for registering with eirpad.</h1><br>
                Please click the link below to verify your email and be redirected to our site.
            </p><br>
            <p><a class = "button" align=center href="http://localhost/index.php/token=' . $token . '">Verify</a></p><br>
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
    $message = (new Swift_Message('Verify your email address | eirpad'))
        ->setFrom(EMAIL)
        ->setTo($email)
        -setBody($body, 'text/html');
}
function sendPassword(Type $var = null){
    #code
}

?>