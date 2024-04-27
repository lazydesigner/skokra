<?php  
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/connection.php';
}
echo 'a';

// Assuming $pdo is your PDO connection object Apr. 26, 2024 - 11:08 pm
$currentDate = date('M. d, Y');

$database = new DatabaseConnection();
$con = $database->getConnection();

$sql = "SELECT * FROM profiles_ad WHERE DATE_FORMAT(top_ad_expiry_date, '%b. %e, %Y') < :currentDate";
$stmt = $con->prepare($sql);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();

if($stmt->rowCount() > 0){
    while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        print_r($row);
    }
}else{
    echo 'No Result';
}


?>