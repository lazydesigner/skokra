<?php

$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';

$s = '18:00:00';
$e = '20:00:00';

Get_User_Details::Scheduled_Ad_Time($s, $e);
?>