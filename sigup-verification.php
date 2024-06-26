<?php session_start();
if (isset($_SESSION['captcha'])) {
    unset($_SESSION['captcha']);
}
$login_page = 'yes';
include './routes.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpMailer/src/Exception.php';
require './phpMailer/src/PHPMailer.php';
require './phpMailer/src/SMTP.php';

if(isset($_SESSION['email'])){
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
    
    $mail->addAddress($_SESSION['email']);
    
    $mail->isHTML(true);
    
    $mail->Subject = 'Activate Your Account';
    
    $mail->Body = "
    <html>
    <head>
    <title>OTP Verification</title>
    </head>
    <body>
    <table>
    <tr>
    <img src='https://in.skokra.com/assets/images/SKOKRA+LOGO+NEW+(2).webp.png' width='100%' height='100%' alt=''>
    </tr>

    <tr>
    <p>Hi <b>".$_SESSION['email']."<b></p>
    <p>Clink On the Button To Activte Your Account</p>
    <a href='".get_url()."u/account/dashboard'><button style='border:0;background-color:dodgerblue;color:white;cursor:pointer;width:auto;height:40px;padding:1% 10px;border-radius:5px'>Activate Account</button></a>
    </tr>
    </table>
     </body>
    </html>
    ";
    
    $mail->send();
}else{
    die('Server Error...');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Signup - skokra</title>
    <style>
        *{
    box-sizing: border-box;
}
a{text-decoration: none;}
html, body{
    width: 100%;
    height: auto;
    padding: 0;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}
:root{
    /* Color */
    --primary-color: #0060B0;
    --header-color:  #DC006C;
    --light-white: #F1F1F1;
    --header-color-rgb: #dc006ae8;
    /* Font Size */
    --p: 1.2rem;
    --h1:3rem;
    --heading-color:#36454F;

}
.container{
    width: 80%;
    height: auto;
    margin: auto;
    padding-bottom: 5%;
    border-bottom: 1px solid lightgrey;
}
header{
    width: 100%;
    height: 100px;
    border-bottom: 1px solid lightgrey;
    display: flex;
    align-items: center;
}
.verification-box{
    width: 100%;
    height: 100%;
    padding: 5%;
    text-align: center;
    font-size: 1.3rem;
color: var(--heading-color);
}
.verification-box b{
    font-size: 1.5rem;
font-weight: bolder;
}
    </style>
</head>

<body>
    <div class="container">
        <header>
            <a href="<?= get_url() ?>" class="logo"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" alt=""></a>
        </header>
        
        <div class="verification-box">
        

       <p> Welcome to our community!</p>

       <p>To activate your account, simply click on the link we've sent to your email address: <br> <b><?=$_SESSION['email']?></b>.</p>

       <p>Once you've confirmed your email, you'll enjoy these benefits:</p>

       <ul style="list-style: none;">
<li>Publish without the need for confirmation emails</li>
<li>Effortlessly manage your ads</li>
<li>Explore packages and products tailored just for you</li>
</ul>
<p>If you don't find the confirmation email in your inbox within a few minutes of signing up, please take a moment to check your Spam or Junk folder.</p>

<p>We're excited to have you on board!</p>

</div>
    </div>
    <?php include './footer.php' ?>

</body>

</html>