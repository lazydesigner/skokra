<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

class Get_User_Details
{

    public static function Get_Customer_Code()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query_customer_code = $con->prepare("SELECT `customer_code` FROM users WHERE email = ?");

        if ($query_customer_code->execute([$_SESSION['email']])) {
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
            $_SESSION['customer_code'] = $res['customer_code'];
        } else {
            $_SESSION['customer_code'] =  "XXXXXXXXXX";
        }
    }

    public static function verifyPhoneNumber($number)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $phone = $con->prepare('SELECT * FROM phone_verification WHERE  phone_number = :number');
        $phone->bindParam(':number', $number);
        if ($phone->execute()) {
            $phone_row = $phone->fetch(PDO::FETCH_ASSOC);
            if ($phone_row) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function Recaptcha()
    {
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public static function OTP_Generator(){
        if(isset($_SESSION['OTP_V'])){
            unset($_SESSION['OTP_V']);
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
        }else{
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
        }
        return $OTP;
    }

}
