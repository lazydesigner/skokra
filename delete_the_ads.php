<?php  
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/connection.php';
}

// Assuming $pdo is your PDO connection object Apr. 26, 2024 - 11:08 pm
$currentDate = date('Y-m-d');

$database = new DatabaseConnection();
$con = $database->getConnection();

$sql = "SELECT * FROM profiles_ad WHERE STR_TO_DATE(REPLACE(top_ad_expiry_date, '.', ''), '%b %e, %Y - %l:%i %p') < :currentDate OR n_d_a_s_c < 1";
$stmt = $con->prepare($sql);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();



if($stmt->rowCount() > 0){
    while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        foreach( $row as $key => $val ) {
            $update_q = $con->prepare("UPDATE profiles_ad SET top_ad = 0, supertop_ad = 0, n_t_a_s_c_f = 0, n_d_a_s_c = 0 WHERE post_id = ?");
            $update_q->execute([$row[$key]['post_id']]);
        }
    }
}else{
    echo 'No Result';
}

// =============================================================================================|

$sql2 = "SELECT * FROM profiles_ad WHERE STR_TO_DATE(ad_expiry_date, '%b %e, %Y') < :currentDate";
$stmt2 = $con->prepare($sql2);
$stmt2->bindParam(':currentDate', $currentDate);
$stmt2->execute();

if($stmt2->rowCount() > 0){
    while($row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC)){
        foreach( $row2 as $key2 => $val2 ) {
            $update_q2 = $con->prepare("UPDATE profiles_ad SET suspend = 1 WHERE post_id = ?");
            $update_q2->execute([$row2[$key2]['post_id']]);
        }
    }
}else{
    echo 'Not Found';
}

// =============================================================================================|

// $sql3 = "SELECT * FROM profiles_ad WHERE n_d_a_s_c < 1";
// $stmt3 = $con->prepare($sql3);
// $stmt3->bindParam(':currentDate', $currentDate);
// $stmt3->execute();

// if($stmt3->rowCount() > 0){
//     while($row3 = $stmt3->fetchAll(PDO::FETCH_ASSOC)){
//         foreach( $row3 as $key3 => $val3 ) {
//             $update_q3 = $con->prepare("UPDATE profiles_ad SET top_ad = 0, supertop_ad = 0, n_t_a_s_c_f = 0, n_d_a_s_c = 0 WHERE post_id = ?");
//             $update_q3->execute([$row3[$key3]['post_id']]);
//         }
//     }
// }else{
//     echo 'Not Found';
// }



?>