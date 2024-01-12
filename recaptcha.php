<?php 
session_start();

$captcha = $_POST['captcha'];

if($captcha == $_SESSION['captcha']){
    echo json_encode(['status' => 'ok','notauthenticated'=>'https://in.skokra.com/register']);
    unset($_SESSION['captcha']);
}else{
    echo json_encode(['status'=>404]);
}


?>