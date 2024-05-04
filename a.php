<?php
session_start();
include './backend/connection.php';
include './backend/user_task.php';

$database = new DatabaseConnection();
$con = $database->getConnection();

// print_r(Get_User_Details::Get_Full_ad_detail());
// print_r(Get_User_Details::Get_Supertop_ads_detail('12:00:00', '15:00:00'));

// echo '==============================================';

$a = Get_User_Details::Scheduled_Ad_Time('12:00:00', '15:00:00');

print_r($a);
