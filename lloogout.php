<?php 
include $_SERVER['DOCUMENT_ROOT'].'/skokra.com/routes.php';

session_start();
session_unset();
session_destroy();
header('Location: ' . get_url() .''); ?>
?>