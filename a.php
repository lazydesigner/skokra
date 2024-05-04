<?php
session_start();
include './backend/connection.php';
include './backend/user_task.php';

$database = new DatabaseConnection();
$con = $database->getConnection();

// print_r(Get_User_Details::Get_Full_ad_detail());
// print_r(Get_User_Details::Get_Supertop_ads_detail('12:00:00', '15:00:00'));

// echo '==============================================';

$a = Get_User_Details::Show_Super_Top_Ads();

foreach ($a as $rows) {
    foreach($rows as $row){
        print_r($row);
    echo '<br>==============================================================================<br>';
    echo $row['post_id'];
    echo '<br>==============================================================================<br>';
}}
