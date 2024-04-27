<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$login_page = 'yes';
include '../routes.php';
include '../backend/user_task.php';

$s = '9:00:00';
$e = '12:00:00';

if(Get_User_Details::Scheduled_Ad_Time($s, $e)){
    echo 'Done';
}else{
    echo 'Not Done';
}

?>