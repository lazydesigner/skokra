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

$sql = "SELECT * FROM profiles_ad WHERE STR_TO_DATE(REPLACE(top_ad_expiry_date, '.', ''), '%b %e, %Y - %l:%i %p') < :currentDate";
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


?>