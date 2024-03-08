<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/skokra.com/backend/connection.php';

class Get_User_Details{

    public static function Get_Customer_Code()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        
        $query_customer_code = $con->prepare("SELECT `customer_code` FROM users WHERE email = ?");
       
        if($query_customer_code->execute([$_SESSION['email']])){
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
            $_SESSION['customer_code'] = $res['customer_code'];
        }else{
            $_SESSION['customer_code'] =  "XXXXXXXXX";
        } 
    }

}




?>