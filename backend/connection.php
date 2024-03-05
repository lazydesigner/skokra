<?php
session_start();

// if(!isset($_SESSION['email'])){
//     header('Location: https://dash.ctchicks.com/auth-login/');
// }

function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a random token
    }

    return $_SESSION['csrf_token'];
}

function localConnection() {
    // Define an array of common localhost hostnames or IP addresses
    $localhosts = array('localhost', '127.0.0.1');

    // Get the server's hostname
    $serverHostname = $_SERVER['SERVER_NAME'];

    // Check if the server's hostname is in the array of localhost values
    return in_array($serverHostname, $localhosts);
}

if(localConnection()){
    // $con = mysqli_connect('localhost','root','','skokra');    
    // if(!$con){
    //     die('Not Connected');
    // }
try{
    $con = new PDO("mysql:host=localhost;dbname=skokra",'root','');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

    echo 'CONNECTION IS MADE SECURELY';
}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
}



}else{
    $con = mysqli_connect('localhost','u231955561_ctchicks','@Ctchicks1','u231955561_ct');
    if(!$con){
        die('Not Connected');
    }
}

?>