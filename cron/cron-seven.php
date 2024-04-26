<?php

$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';

$s = '00:00:00';
$e = '9:00:00';

if(Get_User_Details::Scheduled_Ad_Time($s, $e)){
    echo 'Done';
}else{
    echo 'Not Done';
}
?>