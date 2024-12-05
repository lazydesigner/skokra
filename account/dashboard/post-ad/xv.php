<?php

session_start();
$path =  $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/routes.php';

if (file_exists($path)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/routes.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/routes.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/backend/user_task.php';
}


$fields = [];

if (isset($_POST['update_post_ad'])) {



    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
    $state = Get_User_Details::getStateByCity($city);
    // Important are above
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_SPECIAL_CHARS);

    // Important are below
    $age = (int)$_POST['age'];
    $title = $_POST['title'];
    $title = preg_replace('/\.(com|in|org|net|gov|info|co)\b/', '', $title);

    // Remove prefixes (http:// and https://)
    $title = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $title);
    $pattern = '/(?:\d{10}|\d{5}\s?\d{5}|\d{3}\s?\d{3}\s?\d{4})/';

    // Replace phone numbers with an empty string
    // $title = preg_replace($pattern, '', strip_tags($title, '<a><script>'));
    $title = strip_tags($title, '<a><script>');

    $description = $_POST['description'];
    $description = preg_replace('/\.(com|in|org|net|gov|info|co)\b/', '', $description);

    // Remove prefixes (http:// and https://)
    $description = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $description);
    $description = preg_replace($pattern, '', strip_tags($description, '<a><script>'));
    // Important are above

    $african_ethnicity = filter_input(INPUT_POST, 'african', FILTER_SANITIZE_SPECIAL_CHARS);;
    $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_SPECIAL_CHARS);;
    $boobs = htmlspecialchars($_POST['boobs']);
    $hair = htmlspecialchars($_POST['hair']);
    $body_type = htmlspecialchars($_POST['body-type']);


    if (isset($_POST['services'])) {
        $services = json_encode(array_map('htmlspecialchars', $_POST['services']));
    } else {
        $services = null;
    }
    if (isset($_POST['attention_to'])) {
        $attention_to = json_encode(array_map('htmlspecialchars', $_POST['attention_to']));
    } else {
        $attention_to = null;
    }
    if (isset($_POST['place_of_service'])) {
        $place_of_service = json_encode(array_map('htmlspecialchars', $_POST['place_of_service']));
    } else {
        $place_of_service = null;
    }
    if (isset($_POST['payment-method'])) {
        $payment_method = json_encode(array_map('htmlspecialchars', $_POST['payment-method']));
    } else {
        $payment_method = null;
    }

    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);
    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_POST['whatsapp-enable'])) {
        $whatsapp_enable = 1;
    } else {
        $whatsapp_enable = 0;
    }
    $terms_and_condition = 1;

    // Fields according to database $fiels['database_column_name'] = 'value'

    $fields['category'] = $category;
    $fields['state'] = $state;
    $fields['city'] = $city;
    $fields['address'] = $address;
    $fields['area'] = $area;
    $fields['age'] = $age;
    $fields['title'] = $title;
    $fields['description'] = $description;
    $fields['african_ethnicity'] = $african_ethnicity;
    $fields['nationality'] = $nationality;
    $fields['boobs'] = $boobs;
    $fields['hair'] = $hair;
    $fields['body_type'] = $body_type;
    $fields['services'] = $services;
    $fields['attention_to'] = $attention_to;
    $fields['place_of_service'] = $place_of_service;
    $fields['price'] = $price;
    $fields['payment_method'] = $payment_method;
    $fields['contact'] = $contact;
    $fields['whatsapp_enable'] = $whatsapp_enable;

    $post_id = $_SESSION['customer_code'] . '_in' . $_POST['post_id'];

    // Fields Ends


    if (!empty($category) && !empty($city) && !empty($age) && !empty($title) && !empty($description)) {

        if (Get_User_Details::Update_Post_Ad_After_Editing($fields, 'profiles_ad', $post_id)) {

            header('Location: ' . get_url() . 'u/post-finish/' . $_POST['post_id'] . '');
        }
    } else {
?> <script>
            alert('All Fields Are Required')
        </script> <?php
                }
            } else {
                header('Location: ' . get_url() . 'u/post-promote/' . $_POST['post_id'] . '');
            }



                    ?>