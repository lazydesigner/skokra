<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/routes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['items'] == 'phone') {
        $captcha = Get_User_Details::Recaptcha();
        if (isset($_SESSION['captcha'])) {
            unset($_SESSION['captcha']);
            $_SESSION['captcha'] = $captcha;
        } else {
            $_SESSION['captcha'] = $captcha;
        }

        if (!empty($_POST['phone'])) {
            if (Get_User_Details::verifyPhoneNumber($_POST['phone'])) {
                echo json_encode(['status' => 200, 'captcha' => $captcha, 'path' => get_url().'u/post-insert/']);
            } else {
                echo json_encode(['status' => 204, 'captcha' => $captcha]);
            }
        } else {
            echo json_encode(['status' => 404, 'msg' => 'Phone number is required', 'captcha' => $captcha]);
        }
    } elseif ($_POST['items'] == 'OverifyTP') {

        $captcha = Get_User_Details::Recaptcha();
        if (isset($_SESSION['captcha'])) {
            unset($_SESSION['captcha']);
            $_SESSION['captcha'] = $captcha;
        } else {
            $_SESSION['captcha'] = $captcha;
        }


        $phone_number = $_POST['phone'];
        if (!empty($phone_number) && (int)strlen($phone_number) == 10) {
            $otp = Get_User_Details::OTP_Generator();
            echo json_encode(['status' => 200, 'otp' => $otp, 'captcha' => $captcha]);
        } else {
            echo json_encode(['status' => 204, 'captcha' => $captcha, 'a' => strlen($phone_number)]);
        }
    } elseif ($_POST['items'] == 'OTOConfirmed') {
        $otp = $_POST['field1'] . $_POST['field2'] . $_POST['field3'] . $_POST['field4'];
        if ($otp == $_SESSION['OTP_V']) {
            if (Get_User_Details::addPhoneNumber(htmlspecialchars($_POST['phone']))) {
                echo json_encode(["status" => "200", `path`=> get_url().'u/post-insert/']);
            }else{
                echo json_encode(["status" => "198"]);
            }
        } else {
            echo json_encode(["status" => "198"]);
        }
    }
}
