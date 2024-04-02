<?php 
if(isset($terms_and_condition)){
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
// Important are above
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
$area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_SPECIAL_CHARS);

// Important are below
$age = (int)$_POST['age'];
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
// Important are above

$african_ethnicity = filter_input(INPUT_POST, 'african', FILTER_SANITIZE_SPECIAL_CHARS);;
$nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_SPECIAL_CHARS);;
$boobs = htmlspecialchars($_POST['boobs']);
$hair = htmlspecialchars($_POST['hair']);
$body_type = htmlspecialchars($_POST['body-type']);
$services = filter_input(INPUT_POST, 'services', FILTER_SANITIZE_SPECIAL_CHARS);
$attention_to = filter_input(INPUT_POST, 'attention_to', FILTER_SANITIZE_SPECIAL_CHARS);
$place_of_service = filter_input(INPUT_POST, 'place_of_service', FILTER_SANITIZE_SPECIAL_CHARS);
$price = htmlspecialchars($_POST['price']);
$payment_method = filter_input(INPUT_POST, 'payment-method', FILTER_SANITIZE_SPECIAL_CHARS);;
$contact = $_POST['contact'];
$email = $_SESSION['email'];
$ad_phone_number = $_POST['ad-phone-numbera'];
$whatsapp_enable = $_POST['whatsapp-enable'];
$terms_and_condition = $_POST['terms-and-condition'];

$orgination_enable = $_POST['orgination_enable'];
$website_name = $_POST['website_name'];
$orgination_name = $_POST['orgination_name'];
$website_url = $_POST['website_url'];




    if(!empty($category) && !empty($city) && !empty($age) && !empty($title) && !empty($description)){
    
    if(Get_User_Details::AdInsert($category, $city, $address, $area, $age, $title, $description, $african, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service,  $price, $payment_method, $contact, $_SESSION['email'], $ad_phone_numbera, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url)){}
    
}else{
    ?> <script>alert('All Fields Are Rewuired')</script> <?php
}
}



?>