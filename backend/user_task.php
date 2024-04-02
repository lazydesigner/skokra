<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

class Get_User_Details
{

    public static function Get_Customer_Code()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query_customer_code = $con->prepare("SELECT `user_id`,`customer_code` FROM users WHERE email = ?");

        if ($query_customer_code->execute([$_SESSION['email']])) {
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
            $_SESSION['customer_code'] = $res['customer_code'];
            $_SESSION['user_identification'] = $res['user_id'];
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

    public static function addPhoneNumber($number)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $insertphonenumber = $con->prepare("INSERT INTO `phone_verification`(`phone_number`,`verification`) VALUE(?, ?)");
        if ($insertphonenumber->execute([$number, 1])) {
            if ($insertphonenumber->rowCount() > 0) {
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

    public static function OTP_Generator()
    {
        if (isset($_SESSION['OTP_V'])) {
            unset($_SESSION['OTP_V']);
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
        } else {
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
        }
        return $OTP;
    }

    public static function AdInsert($category, $city, $address, $area, $age, $title, $description, $african_ethnicity, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service, $price, $payment_method, $contact, $email, $ad_phone_number, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        //checking the user is already registered

        $query = "INSERT INTO profiles_ad(adid,category,city,address,area,age,title,description,african_ethnicity,nationality,boobs,hair,body_type,services,attention_to,place_of_service,price, payment_method,contact,email,ad_phone_number,whatsapp_enable,terms_and_condition,orgination_enable,website_name,orgination_name,website_url,user_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $adid = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $code = '';
        $length = 25;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        $adid = $_SESSION['customer_code'] . '_in' . $code;
        $_SESSION['temprary_post_id'] = $code;

        $insertad = $con->prepare($query);
        $insertad->execute([$adid, $category, $city, $address, $area, $age, $title, $description, $african_ethnicity, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service, $price, $payment_method, $contact, $email, $ad_phone_number, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url, $_SESSION['user_identification']]);

        if ($insertad->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Get_ad_detail($post_id)
    {

        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT `category`, `city`, `age`, `title`, `description`  FROM profiles_ad WHERE adid = ?");
        $query->execute([$_SESSION['customer_code'].'_in'.$post_id]);
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }else{
            header('Location:'.get_url().'u/account/dashboard/');
        }
        // if()
    }


}
