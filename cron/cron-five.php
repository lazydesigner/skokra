<?php

$login_page = 'yes';
include '../routes.php';
include '../backend/user_task.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Cron JOb Time 02:29 pm
// wget -O /dev/null https://in.skokra.com/cron/cron-five.php


require '../phpMailer/src/Exception.php';
require '../phpMailer/src/PHPMailer.php';
require '../phpMailer/src/SMTP.php';


$s = '20:00:00';
$e = '22:00:00';

if(Get_User_Details::Scheduled_Ad_Time($s, $e)){
    echo 'Done';
}else{
    echo 'Not Done';
}


$mail = new PHPMailer(true);
    
    $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'no_reply@skokra.com';
    $mail->Password = '$skokrA2024';
    $mail->SMTPSecure = 'ssl';
    $mail->Port= 465;
    
    $mail->setFrom('no_reply@skokra.com', 'Skokra.in');
    
    $mail->addAddress('deepakbaradwaj933@gmail.com');
    
    $mail->isHTML(true);
    
    $mail->Subject = 'Activate Your Account';
    
    $mail->Body = "starting: $s Ending: $e ";
    
    // $mail->send();



?>