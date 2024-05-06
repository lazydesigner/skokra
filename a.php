<?php
session_start();
include './backend/connection.php';
include './backend/user_task.php';

$database = new DatabaseConnection();
$con = $database->getConnection();

// print_r(Get_User_Details::Get_Full_ad_detail());
// print_r(Get_User_Details::Get_Supertop_ads_detail('12:00:00', '15:00:00'));

// echo '==============================================';

// $a = Get_User_Details::Show_Super_Top_Ads();

// SELECT DISTINCT ad_id
// FROM (
//     SELECT ad_id,
//         CASE
//             WHEN scheduled_time > NOW() THEN 0  -- Future ads
//             ELSE 1  -- Passed ads
//         END AS scheduled_time
//     FROM ads_slot_time
// ) AS subquery
// ORDER BY scheduled_time ASC;

$q = $con->prepare("SELECT DISTINCT ad_id
FROM (
    SELECT ad_id,
        CASE
            WHEN scheduled_time > NOW() THEN 0  -- Future ads
            ELSE 1  -- Passed ads
        END AS scheduled_time
    FROM ads_slot_time
) AS subquery
ORDER BY scheduled_time ASC
");

$q->execute();
$result = $q->fetchAll();

echo '<pre>';
print_r($result);
echo '</pre>';

?>
