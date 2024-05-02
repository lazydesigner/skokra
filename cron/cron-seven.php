<?php

$login_page = 'yes';
include '../routes.php';
include '../backend/user_task.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/src/Exception.php';
require '../phpMailer/src/PHPMailer.php';
require '../phpMailer/src/SMTP.php';
$s = '00:00:00';
$e = '9:00:00';

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
    
    $mail->send();

?>