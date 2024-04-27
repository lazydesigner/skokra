<?php  
$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/connection.php';
}

// Assuming $pdo is your PDO connection object Apr. 26, 2024 - 11:08 pm
$currentDate = date('M. d, Y');

$sql = "DELETE FROM profiles_ad WHERE DATE_FORMAT(top_ad_expiry_date, '%b. %e, %Y') < :currentDate";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();


?>