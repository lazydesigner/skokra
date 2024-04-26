<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
}else{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/user_task.php';
}
session_start();
if (isset($_SESSION['url'])) {
    unset($_SESSION['url']);
}
if(!isset($_SESSION['user_identification']) || !isset($_SESSION['customer_code'])){
Get_User_Details::Get_Customer_Code();}
$POST_INSERT = 'yes'; //to hide  add post button in this page
include '../../../routes.php';


$close_verification_btn = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" height="14" width="14" id="Delete-1--Streamline-Core"><desc>Delete 1 Streamline Icon: https://streamlinehq.com</desc><g id="Delete-1--Streamline-Core"><path id="Union" fill="#000" fill-rule="evenodd" d="M1.70711 0.292893c-0.39053 -0.3905241 -1.023693 -0.3905241 -1.414217 0 -0.3905241 0.390524 -0.3905241 1.023687 0 1.414217L5.58579 7 0.292893 12.2929c-0.3905241 0.3905 -0.3905241 1.0237 0 1.4142 0.390524 0.3905 1.023687 0.3905 1.414217 0L7 8.41421l5.2929 5.29289c0.3905 0.3905 1.0237 0.3905 1.4142 0 0.3905 -0.3905 0.3905 -1.0237 0 -1.4142L8.41421 7l5.29289 -5.29289c0.3905 -0.39053 0.3905 -1.023693 0 -1.414217 -0.3905 -0.3905241 -1.0237 -0.3905241 -1.4142 0L7 5.58579 1.70711 0.292893Z" clip-rule="evenodd" stroke-width="1"></path></g></svg>';

    if(isset($_POST['terms-and-condition'])){
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
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
        $title = preg_replace($pattern, '', strip_tags($title, '<a><script>'));
        
        $description = $_POST['description'];
        $description = preg_replace('/\.(com|in|org|net|gov|info|co)\b/', '', $description);

        // Remove prefixes (http:// and https://)
        $description = preg_replace('#\b(?:https?://|www\.)\S+\b#', '', $description);
        $description = preg_replace($pattern, '', strip_tags($description, '<a><script>'));
        // Important are above
        
        $african_ethnicity = filter_input(INPUT_POST, 'african', FILTER_SANITIZE_SPECIAL_CHARS);
        $nationality = filter_input(INPUT_POST, 'nationality', FILTER_SANITIZE_SPECIAL_CHARS);
        $boobs = filter_input(INPUT_POST, 'boobs', FILTER_SANITIZE_SPECIAL_CHARS);
        $hair = filter_input(INPUT_POST, 'hair', FILTER_SANITIZE_SPECIAL_CHARS);
        $body_type = filter_input(INPUT_POST, 'body-type', FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($_POST['services'])){$services = json_encode(array_map('htmlspecialchars', $_POST['services']));}else{$services = null ;}
        if(isset($_POST['attention_to'])){$attention_to = json_encode(array_map('htmlspecialchars', $_POST['attention_to']));}else{ $attention_to = null; }
        if(isset($_POST['place_of_service'])){$place_of_service = json_encode(array_map('htmlspecialchars', $_POST['place_of_service']));}else{ $place_of_service = null ;}
        if(isset($_POST['payment-method'])){$payment_method = json_encode(array_map('htmlspecialchars', $_POST['payment-method']));}else{$payment_method = null ;}
        
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);
        $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_SESSION['email'];
        $ad_phone_number = filter_input(INPUT_POST, 'ad-phone-number', FILTER_SANITIZE_SPECIAL_CHARS);
        if(isset($_POST['whatsapp-enable'])){ $whatsapp_enable = 1 ;}else{ $whatsapp_enable = 0 ;}
        $terms_and_condition = 1;
        
        if(isset($_POST['orgination_enable'])){ $orgination_enable = 1 ;}else{ $orgination_enable = 0 ;}
        $website_name = filter_input(INPUT_POST, 'website_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $orgination_name = filter_input(INPUT_POST, 'orgination_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $website_url = filter_input(INPUT_POST, 'website_url', FILTER_VALIDATE_URL);
        
            if(!empty($category) && !empty($city) && !empty($age) && !empty($title) && !empty($description)){
            
            if(Get_User_Details::AdInsert($category, $city, $address, $area, $age, $title, $description, $african_ethnicity, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service,  $price, $payment_method, $contact, $_SESSION['email'], $ad_phone_number, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url)){
                header('Location: '.get_url().'u/post-insert-image/'.$_SESSION['temprary_post_id'].'');
            }else{
                ?> <script>alert('Something went wrong. !please try after some time or contact the executives')</script> <?php
            }
            
        }else{
            ?> <script>alert('* Fields Are Required')</script> <?php
        
        
?> <script>
            alert('* Fields Are Required')
        </script> <?php
                }
            }

                    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/post-insert.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
        }

        .step-three,
        .step-two {
            display: none;
        }

        .phone_number_verification {
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99;
            background-color: rgba(0, 0, 0, .5);
        }

        .phone-verification-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40%;
            height: 60%;
            border-radius: 5px;
            transform: translate(-50%, -50%);
            background-color: white;
        }

        .phone-verification-heading {
            padding: 3% 4%;
            display: flex;
            gap: 1%;
            align-items: center;
            border-bottom: 1px solid lightgrey;
        }

        .close-the-verification-tab {
            position: absolute;
            top: 6%;
            right: 4%;
            font-weight: bold;
            cursor: pointer;
        }

        .phone-verification-heading strong {
            font-size: 1.5rem;
        }

        .phone-verification-body {
            padding: 1% 3%;
        }

        .phone-verification-body p {
            font-size: 1.1rem;
            font-weight: 500;
        }

        .phone-verification-btn {
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            align-self: last baseline;
            padding: 3%;
            text-align: center;
        }

        .phone-verification-btn button {
            width: 100%;
            height: 50px;
            border-radius: 20px;
            margin-bottom: 4%;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            color: grey;
            background-color: transparent;
            border: 2px solid #DC006C;
            opacity: .6;
        }

        .phone-verification-btn a {
            font-weight: 600;
            color: #DC006C;
            opacity: .6;
        }

        .phone-verification-btn a:hover {
            opacity: .9;
        }

        .red-border {
            border: 1px solid red;
        }

        .form-row {
            display: flex;
            gap: 5%;
            align-items: center;
        }

        .captcha {
            width: 200px;
            height: 80px;
            border: 1px solid #36454F;
            position: relative;
            align-self: baseline;
        }

        .captcha img {
            width: 100%;
            height: 100%;
            position: absolute;
            object-fit: cover;
            z-index: -1;
            top: 0;
            left: 0;
        }

        .hide-the-captcha {
            height: 80px;
            line-height: 80px;
            text-align: center;
            font-size: 3rem;
            font-weight: bolder;
        }

        #captcha {
            width: 150px;
            height: 80px;
            font-size: 1.2rem;
            outline: 0;
        }

        /* .otp-input-fields{
            width: 100%;
            height: 45px;
            border: 1px solid lightgrey;
            border-radius: 30px;
            outline: 0;
            padding: 1%;
        } */

        /*  */
        .form-otp {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: space-around;
            width: 100%;
            border-radius: 12px;
            padding: 20px;
        }

        .inputs-otp {
            margin-top: 10px
        }

        .inputs-otp input {
            width: 32px;
            height: 32px;

            text-align: center;
            border: none;
            border-bottom: 1.5px solid #DC006C;
            margin: 0 10px;
        }

        .inputs-otp input:focus {
            border-bottom: 1.5px solid dodgerblue;
            outline: none;
        }
    </style>
</head>

<body>

    <?php include '../dash-nav.php' ?>
    <div class="post-insert-heading">
        <h1>Publish for free in just a few steps!</h1>
    </div>
    <div class="form-progress-bar container">
        <div class="form-progress ">
            <div class="progress-bar active-progress"><i class="ri-user-fill"></i></div>
            <strong>Ad Info</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar"><i class="ri-camera-2-fill"></i></div>
            <strong>Your photos</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar"><i class="ri-thumb-up-fill"></i></div>
            <strong>Visibility</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar"><i class="ri-check-double-line"></i></div>
            <strong>Finish</strong>
        </div>
    </div>
    <form id="form_submit" method="POST">
        <div class="step-one">
            <div class="container">
                <div class="top-form-field">
                    <strong>Your Ad</strong>
                    <small>*Required fields</small>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">*Select category</label>
                        <select name="category" id="category">
                            <option value="call-girls">Call Girls</option>
                            <option value="massage">Massages</option>
                            <option value="male-escorts">Male Escorts</option>
                            <option value="transsexual">Transsexual</option>
                            <option value="adult-meetings">Adult Meetings</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">*Select city</label>
                        <select name="city" id="city">
                        <?php foreach($list_of_cities as $city){ ?>
                                <option value="<?=$city ?>"><?=$city ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group form-flex">
                        <span>
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address">
                        </span>
                        <span>
                            <label for="postal_code">Postal Code</label>
                            <input type="number" name="postal_code" id="postal_code">
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="Area/District/Neighbourhood">Area/District/Neighbourhood</label>
                        <input type="text" name="area" id="Area/District/Neighbourhood">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <strong>Your Data</strong>
                    <small>*Required fields</small>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">*Age</label>
                        <input type="number" maxlength="2" minlength="2" min="18" name="age" id="age">
                    </div>
                    <div class="form-group">
                        <label for="city">*Title</label>
                        <textarea name="title" id="title" cols="30" rows="5" placeholder="Give your ad a good title"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">*Description</label>
                        <textarea name="description" id="description" cols="30" rows="8" placeholder="Use this space to describe yourself, your body, your skills and what you like..."></textarea>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>About You</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Ethnicity</label>
                        <div class="form-flex">
                            <label for="african" class="category">
                                <div>African</div>
                            </label>
                            <input type="radio" name="african" id="african" value="African">

                            <label for="indian" class="category" id="indian">
                                <div>Indian</div>
                            </label>
                            <input type="radio" name="african" id="indian" value="Indian">

                            <label for="asian" class="category" id="asian">
                                <div>Asian</div>
                            </label>
                            <input type="radio" name="african" id="asian" value="Asian">

                            <label for="arab" class="category" id="arab">
                                <div>Arab</div>
                            </label>
                            <input type="radio" name="african" id="arab" value="Arab">

                            <label for="latin" class="category" id="latin">
                                <div>Latin</div>
                            </label>
                            <input type="radio" name="african" id="latin" value="Latin">

                            <label for="caucasian" class="category" id="caucasian">
                                <div>Caucasian</div>
                            </label>
                            <input type="radio" name="african" id="caucasian" value="Caucasian">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Nationality</label>
                        <select name="nationality" id="nationality">
                            <option value="0">Select Nationality</option>
                            <option value="indian">Indian</option>
                            <option value="russian">Russian</option>
                            <option value="australian">Australian</option>
                            <option value="american">American</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Breast</label>
                        <div class="form-flex">
                            <label for="natural-boobs" class="boobs">
                                <div>Natural Boobs</div>
                            </label>
                            <input type="radio" name="boobs" id="natural-boobs" value="Natural Boobs">

                            <label for="busty" class="boobs" id="busty">
                                <div>Busty</div>
                            </label>
                            <input type="radio" name="boobs" id="busty" value="Busty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Hair</label>
                        <div class="form-flex">
                            <label for="blond-hair" class="hair">
                                <div>Blond Hair</div>
                            </label>
                            <input type="radio" name="hair" id="blond-hair" value="Blond Hair">

                            <label for="brown-hair" class="hair">
                                <div>Blond Hair</div>
                            </label>
                            <input type="radio" name="hair" id="brown-hair" value="Brown Hair">
                            <label for="black-hair" class="hair">
                                <div>Black Hair</div>
                            </label>
                            <input type="radio" name="hair" id="black-hair" value="Black Hair">

                            <label for="red-hair" class="hair">
                                <div>Red Hair</div>
                            </label>
                            <input type="radio" name="hair" id="red-hair" value="Red Hair">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Body Type</label>
                        <div class="form-flex">
                            <label for="slim" class="body-type">
                                <div>Slim</div>
                            </label>
                            <input type="radio" name="body-type" id="slim" value="slim">

                            <label for="curvy" class="body-type">
                                <div>Curvy</div>
                            </label>
                            <input type="radio" name="body-type" id="curvy" value="curvy">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Services</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Services</label>
                        <div class="form-flex">
                            <input type="checkbox" name="services[]" id="service1" value="Oral">
                            <label class="service_" for="service1">
                                <div>Oral</div>
                            </label><input type="checkbox" name="services[]" id="service2" value="Anal">
                            <label class="service_" for="service2">
                                <div>Anal</div>
                            </label><input type="checkbox" name="services[]" id="service3" value="BDSM">
                            <label class="service_" for="service3">
                                <div>BDSM</div>
                            </label><input type="checkbox" name="services[]" id="service4" value="GirlFriend Experience">
                            <label class="service_" for="service4">
                                <div>Girlfriend experience</div>
                            </label><input type="checkbox" name="services[]" id="service5" value="Videocall">
                            <label class="service_" for="service5">
                                <div>Videocall</div>
                            </label><input type="checkbox" name="services[]" id="service6" value="Threesome">
                            <label class="service_" for="service6">
                                <div>Threesome</div>
                            </label><input type="checkbox" name="services[]" id="service7" value="Role play">
                            <label class="service_" for="service7">
                                <div>Role play</div>
                            </label><input type="checkbox" name="services[]" id="service8" value="Porn actressess">
                            <label class="service_" for="service8">
                                <div>Porn actresses</div>
                            </label><input type="checkbox" name="services[]" id="service9" value="Erotic massage">
                            <label class="service_" for="service9">
                                <div>Erotic massage</div>
                            </label><input type="checkbox" name="services[]" id="service10" value="French kiss">
                            <label class="service_" for="service10">
                                <div>French kiss</div>
                            </label><input type="checkbox" name="services[]" id="service11" value="Sexting">
                            <label class="service_" for="service11">
                                <div>Sexting</div>
                            </label><input type="checkbox" name="services[]" id="service12" value="Body ejaculation">
                            <label class="service_" for="service12">
                                <div>Body ejaculation</div>
                            </label><input type="checkbox" name="services[]" id="service13" value="Fetish">
                            <label class="service_" for="service13">
                                <div>Fetish</div>
                            </label><input type="checkbox" name="services[]" id="service14" value="Tantric massage">
                            <label class="service_" for="service14">
                                <div>Tantric massage</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Attention to</label>
                        <div class="form-flex">
                            <input type="checkbox" id="attention_men" name="attention_to[]" value="Men">
                            <label class="Attention" for="attention_men">
                                <div>Men</div>
                            </label>
                            <input type="checkbox" id="Attention_women" name="attention_to[]" value="Women">
                            <label class="Attention" for="Attention_women">
                                <div>Women</div>
                            </label>
                            <input type="checkbox" id="Attention_couple" name="attention_to[]" value="Couples">
                            <label class="Attention" for="Attention_couple">
                                <div>Couples</div>
                            </label>
                            <input type="checkbox" id="Attention_disabled" name="attention_to[]" value="disabled">
                            <label class="Attention" for="Attention_disabled">
                                <div>Disabled</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Place of service</label>
                        <div class="form-flex">
                            <input type="checkbox" id="place_of_service_home" name="place_of_service[]" value="At Home" />
                            <label class="place_of_service" for="place_of_service_home">
                                <div>At Home</div>
                            </label>
                            <input type="checkbox" id="place_of_service_party" name="place_of_service[]" value="Event And Parties">
                            <label class="place_of_service" for="place_of_service_party">
                                <div>Event And Parties</div>
                            </label>
                            <input type="checkbox" id="place_of_service_hotel" name="place_of_service[]" value="Hotel / Motel">
                            <label class="place_of_service" for="place_of_service_hotel">
                                <div>Hotel / Motel</div>
                            </label>
                            <input type="checkbox" id="place_of_service_clubs" name="place_of_service[]" value="clubs">
                            <label class="place_of_service" for="place_of_service_clubs">
                                <div>Clubs</div>
                            </label>
                            <input type="checkbox" id="place_of_service_outcall" name="place_of_service[]" value="OutCall">
                            <label class="place_of_service" for="place_of_service_outcall">
                                <div>Outcall</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Pricing</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Price per hour</label>
                        <select name="price" id="price">
                            <option value="0">Select Price</option>
                            <option value="1000">From Rs 1000</option>
                            <option value="2000">From Rs 2000</option>
                            <option value="3000">From Rs 3000</option>
                            <option value="4000">From Rs 4000</option>
                            <option value="5000">From Rs 5000</option>
                            <option value="6000">From Rs 6000</option>
                            <option value="7000">From Rs 7000</option>
                            <option value="8000">From Rs 8000</option>
                            <option value="9000">From Rs 9000</option>
                            <option value="10000">From Rs 10000</option>
                            <option value="11000">From Rs 11000</option>
                            <option value="12000">Rs 12000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Payment methods</label>
                        <div class="form-flex">
                            <input type="checkbox" value="cash" name="payment-method[]" id="cash">
                            <label class="payment" for="cash">
                                <div>Cash</div>
                            </label>
                            <input type="checkbox" value="credit-card" name="payment-method[]" id="credit-card">
                            <label class="payment" for="credit-card">
                                <div>Credit Card</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span class="form-flex"><strong>Orgination</strong>
                        <label class="switch">
                            <input type="checkbox" value="true" name="orgination_enable">
                            <span class="slider"></span>
                        </label><br>
                        <!-- <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small>--></span>
                </div>
                <div class="form-container" id="addasorgination" style="user-select: none;">
                    <div class="form-group">
                        <label for="category">Website Name</label>
                        <input type="text" name="website_name" disabled id="orgination">
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Orgination Name</label>
                        <input type="text" name="orgination_name" disabled id="orgination">
                    </div>
                    <div class="form-group">
                        <label for="payment-method">website Url</label>
                        <input type="text" name="website_url" disabled id="orgination">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Your Contacts</strong></span>
                    <small>*Required fields</small>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">How Would you like to be contacted?</label>
                        <div class="form-flex">
                            <label for="phone" class="contact label">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><span style="color:dodgerblue"><i class="ri-checkbox-circle-fill"></i></span></p> Only phone
                                </div>
                            </label>
                            <input type="radio" name="contact" id="phone" value="phone" checked>
                            <label for="email-phone" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Email and Phone
                                </div>
                            </label>
                            <input type="radio" name="contact" value="email-phone" id="email-phone">
                            <label for="eamil" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Only Email
                                </div>
                            </label>
                            <input type="radio" name="contact" value="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">*Email Address</label>
                        <input type="text" value="<?= $_SESSION['email'] ?>" readonly name="user-email">
                    </div>
                    <div class="form-group">
                        <label for="payment-method">*Phone Number</label>
                        <input type="number" name="ad-phone-number" id="ad-phone-number">
                    </div>
                    <div class="form-group">
                        <div class="form-flex">
                            <label class="switch">
                                <input type="checkbox" value="true" name="whatsapp-enable">
                                <span class="slider"></span>
                            </label>Whatsapp
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="form-group">
                    <div class="form-flex">
                        <label class="switch" style="width:6%">
                            <input type="checkbox" name="terms-and-condition">
                            <span class="slider"></span>
                        </label>
                        <div style="width:90%">
                            <strong><small>*Terms, Conditions and Privacy Policy</small></strong>
                            <small>I have read the Terms and Conditions of use and Privacy Policy and I hereby authorize the processing of my personal data for the purpose of providing this web service.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <small>IT IS NOT ALLOWED:</small>
                <ul>
                    <li><small>Insert Escort ads or similar.</small></li>
                    <li><small>Make references to sexual payment services.</small></li>
                    <li><small>Insert links in the ads (clickable or not clickable).</small></li>
                    <li><small>Insert offensive or vulgar texts or pictures.</small></li>
                    <li><small>User confirms that he is of legal age according to his jurisdiction and he has not been forced in any way to create this profile</small></li>
                    <li><small>User confirms confirm that he will not offer any services that are against the law in his region</small></li>
                </ul>
            </div>
            <div class="container">
                <button class="next-step" id="next-step" name="next-step">GO ON</button>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="need-help">
            <div class="need-help-icon"><i class="ri-customer-service-2-fill"></i></div>
            <div class="need-help-content">
                <div>
                    <strong>Need help?</strong><br>
                    <small>Contact us through one of our channels from Monday to Friday from 2pm to 9pm.</small>
                </div>
                <div class="need-help-button">
                    <a href=""><i class="ri-whatsapp-fill"></i> Whatsapp</a>
                    <a href=""><i class="ri-telegram-fill"></i> Telegram</a>
                </div>
            </div>
        </div>
    </div>
    <div class="phone_number_verification">
        <div class="phone-verification-box">
            <div class="close-the-verification-tab"><?= $close_verification_btn ?></div>
            <div class="phone-verification-heading">
                <div style="width: 50px;"><img src="<?= get_url() ?>assets/images/password_10097992.png" width="100%" height="100%" alt="Skokra otp verification"></div>
                <strong>Verify your phone number</strong>
            </div>
            <div class="phone-verification-body">
                <p>To display a phone number in your ad, please verify it first.</p>
                <div class="form-group form-row" id="otp-input-fields">
                    <div class="captcha">
                        <img src="<?= get_url() ?>assets/images/stripes-pattern-11551057021pkmmog3xef.png" alt="">
                        <div class="hide-the-captcha" style="color: black;font-size:2.5rem"><?php $captcha = Get_User_Details::Recaptcha();
                                                                                            if (isset($_SESSION['captcha'])) {
                                                                                                unset($_SESSION['captcha']);
                                                                                                $_SESSION['captcha'] = $captcha;
                                                                                                echo $captcha;
                                                                                            } else {
                                                                                                $_SESSION['captcha'] = $captcha;
                                                                                                echo $captcha;
                                                                                            } ?></div>
                    </div>
                    <div>
                        <input type="text" name="captcha-txt" maxlength="6" required placeholder="Enter Captcha" id="captcha">
                        <p style="padding: 0;margin:0" id="captcha-error"></p>
                    </div>
                </div>
                <div class="phone-verification-btn">
                    <div id="phone-verification-btns"><button id="verify_phone_number" disabled>RECEIVE CODE NOW</button></div>
                    <a href="">CONTINUE WITHOUT PHONE NUMBER</a>
                </div>
            </div>

        </div>
    </div>
    <div class="container"><?php include '../../../footer.php' ?></div>
    <?php include '../private-area.php' ?>

    <script>
        document.getElementById('next-step').addEventListener("click", function(e) {
            e.preventDefault()
            category = document.getElementById('category');
            city = document.getElementById('city');
            age = document.getElementById('age');
            title = document.getElementById('title');
            description = document.getElementById('description');
            phone = document.getElementById('ad-phone-number');
            terms = document.querySelector('input[name="terms-and-condition"]')

            if (!terms.checked) {
                terms.classList.add('red-border');
                return false
            } else {
                terms.classList.remove('red-border');
            }
            if (category.value == '' && category.value.trim().length == 0) {
                category.classList.add('red-border');
                return false
            } else {
                category.classList.remove('red-border');
            }
            if (city.value == '' && city.value.trim().length == 0) {
                city.classList.add('red-border');
                return false
            } else {
                city.classList.remove('red-border');
            }
            if (age.value == '' && age.value.trim().length == 0 && parseInt(age.value) > 19) {
                age.classList.add('red-border');
                return false
            } else {
                age.classList.remove('red-border');
            }
            if (title.value == '' && title.value.trim().length == 0) {
                title.classList.add('red-border');
                return false
            } else {
                title.classList.remove('red-border');
            }
            if (description.value == '' && description.value.trim().length == 0) {
                description.classList.add('red-border');
                return false
            } else {
                description.classList.remove('red-border');
            }
            if (phone.value == '' && phone.value.trim().length == 0) {
                phone.classList.add('red-border');
                return false
            } else {
                phone.classList.remove('red-border');
            }

            const phoneData = new FormData()
            phoneData.append('phone', phone.value)
            phoneData.append('items', 'phone')
            fetch('<?= get_url() ?>api/user/checkContact', {
                    method: 'POST',
                    body: phoneData
                })
                .then(res => res.json())
                .then(d => {
                    if (d['status'] == 204) {
                        hidethecaptcha = document.querySelector('.hide-the-captcha');
                        if (hidethecaptcha) {
                            document.querySelector('.hide-the-captcha').innerText = d['captcha'];
                        }
                        document.querySelector('.phone_number_verification').style.display = 'block';
                    } else if (d['status'] == 404) {
                        hidethecaptcha = document.querySelector('.hide-the-captcha');
                        if (hidethecaptcha) {
                            document.querySelector('.hide-the-captcha').innerText = d['captcha'];
                        }
                        alert(d['msg']);
                    } else {
                        document.getElementById('form_submit').setAttribute('action', d['path'])
                        document.getElementById('form_submit').submit()
                        hidethecaptcha = document.querySelector('.hide-the-captcha');
                        if (hidethecaptcha) {
                            document.querySelector('.hide-the-captcha').innerText = d['captcha'];
                        }
                    }
                })
        })


        let count = 1

        function handleRadioButtons(radioButtons) {
            radioButtons.forEach((radio) => {
                radio.addEventListener('click', () => {
                    if (!radio.nextElementSibling.checked) {
                        radioButtons.forEach((r) => {
                            r.nextElementSibling.checked = false;
                            r.classList.remove('label');
                        });
                        radio.nextElementSibling.checked = true;
                        radio.classList.add('label');
                    } else {
                        radio.nextElementSibling.checked = false;
                        radio.classList.remove('label');
                    }
                });
            });
        }

        function Multipleselect(checkbutoon) {
            checkbutoon.forEach((check) => {
                check.addEventListener('click', () => {
                    if (!check.previousElementSibling.checked) {
                        check.classList.add('label');
                    } else {
                        check.classList.remove('label');
                    }
                })
            })
        }
        document.addEventListener('DOMContentLoaded', () => {
            const servicecheckbox = document.querySelectorAll('.service_')
            const Attentioncheckbox = document.querySelectorAll('.Attention')
            const place_of_servicecheckbox = document.querySelectorAll('.place_of_service')
            const paymentcheckbox = document.querySelectorAll('.payment')

            Multipleselect(servicecheckbox)
            Multipleselect(Attentioncheckbox)
            Multipleselect(place_of_servicecheckbox)
            Multipleselect(paymentcheckbox)
        })

        document.addEventListener('DOMContentLoaded', () => {
            const categoryRadios = document.querySelectorAll('[class="category"]');
            const boobsRadios = document.querySelectorAll('[class="boobs"]');
            const hairRadios = document.querySelectorAll('[class="hair"]');
            const bodyRadios = document.querySelectorAll('[class="body-type"]');

            handleRadioButtons(categoryRadios);
            handleRadioButtons(boobsRadios);
            handleRadioButtons(hairRadios);
        });

        const contactRadios = document.querySelectorAll('.contact');
        contactRadios.forEach(contact => {
            let ok = contact.querySelector('#confirm-contact')
            contact.addEventListener('click', () => {
                if (!contact.nextElementSibling.checked) {
                    contactRadios.forEach(contact2 => {
                        contact2.classList.remove('label');
                        contact2.querySelector('#confirm-contact').innerHTML = '<span style="color:grey"><i class="ri-checkbox-blank-circle-line"></i></span>'
                    })
                    contact.classList.add('label');
                    ok.innerHTML = '<span style="color:dodgerblue"><i class="ri-checkbox-circle-fill"></i></span>'
                }
            })
        })

        document.getElementById('captcha').addEventListener('keyup', (e) => {
            var captcha_code = e.target.value;
            const data = new FormData();
            data.append('captcha', captcha_code)
            fetch('<?= get_url() ?>google/em/recaptcha/', {
                    method: 'post',
                    body: data
                }).then(res => res.json())
                .then(d => {
                    if (d['status'] == 'ok') {
                        var notAuthenticatedAction = d['notauthenticated'];
                        document.getElementById('captcha').setAttribute('readonly', true);
                        // Enable the 'submit' button by removing the 'disabled' attribute
                        document.getElementById('verify_phone_number').removeAttribute('disabled');
                        document.getElementById('captcha-error').style.color = 'green'
                        document.getElementById('captcha-error').innerHTML = '<i class="ri-checkbox-circle-fill"></i> Captcha Verified'
                    } else {
                        document.getElementById('captcha-error').style.color = 'tomato'
                        document.getElementById('captcha-error').innerHTML = '<i class="ri-close-circle-fill"></i> Captcha does not match';
                        if (captcha_code.length <= 0 || captcha_code == '' || captcha_code == null) {
                            document.getElementById('captcha-error').innerHTML = ''
                        }
                    }
                })

        })

        document.getElementById('verify_phone_number').addEventListener('click', () => {

            const OdaTaP = new FormData()
            OdaTaP.append('items', 'OverifyTP')
            OdaTaP.append('phone', document.getElementById('ad-phone-number').value)
            fetch('<?= get_url() ?>api/user/checkContact', {
                    method: 'POST',
                    body: OdaTaP
                })
                .then(res => res.json())
                .then(d => {
                    if (d['status'] == 200) {
                        document.querySelector('.hide-the-captcha').innerText = d['captcha'];
                        document.getElementById('captcha').removeAttribute('readonly', false);
                        document.querySelector('input[name="captcha-txt"]').value = '';
                        document.getElementById('captcha-error').innerHTML = '';
                        document.getElementById('otp-input-fields').innerHTML = '<form class="form-otp"><div class="inputs-otp"> <input id="input1" class="otp-input" type="text" maxlength="1"> <input id="input2" type="text" class="otp-input" maxlength="1"> <input id="input3" class="otp-input" type="text" maxlength="1"> <input id="input4" class="otp-input" type="text" maxlength="1"> </div> </form>';
                        document.getElementById('phone-verification-btns').innerHTML = '<button id="verify_OTP">VERIFY CODE NOW</button>';
                        setTimeout(() => {
                            get_input_fields()
                        }, 1000)
                    }else if(d['status'] == 500){
                        alert('Failed to send OTP');
                        document.getElementById('captcha').removeAttribute('readonly', false);
                    }else {
                        document.querySelector('.hide-the-captcha').innerText = d['captcha'];
                        document.getElementById('captcha').removeAttribute('readonly', false);
                        document.getElementById('captcha-error').innerHTML = '';
                        document.querySelector('input[name="captcha-txt"]').value = '';
                        alert('phone number is not valid ' + d['a'])
                    }
                })
        })
        document.querySelector('.close-the-verification-tab').addEventListener('click', () => {
            document.querySelector('.phone_number_verification').style.display = 'none';
            document.getElementById('captcha').removeAttribute('readonly', false);
        })
    </script>
    <script>
        function get_input_fields() {
            var otpFields = document.querySelectorAll('.otp-input');

            otpFields.forEach(function(field, index) {
                field.addEventListener('input', function() {
                    if (this.value.length === 1 && index < otpFields.length - 1) {
                        otpFields[index + 1].focus();
                    }
                });

                field.addEventListener('keydown', function(event) {
                    // Allow only numeric keys and backspace/delete
                    var allowedKeys = [8, 9, 37, 39]; // Backspace, Tab, Left arrow, Right arrow
                    if (event.keyCode === 8) {
                        if (index == otpFields.length - 1) {
                            if (otpFields[index].value == '') {
                                if (otpFields[index - 1]) {
                                    otpFields[index - 1].focus();
                                }
                            }
                        } else {
                            otpFields[index - 1].focus();
                        }
                    }
                    if (event.key.match(/[0-9]/) || allowedKeys.includes(event.keyCode)) {
                        return true;
                    } else {
                        event.preventDefault();
                        return false;
                    }
                });
            });

            document.getElementById('verify_OTP').addEventListener('click', () => {
                input1 = document.getElementById('input1').value
                input2 = document.getElementById('input2').value
                input3 = document.getElementById('input3').value
                input4 = document.getElementById('input4').value

                if (input1.trim().length != 0 && input2.trim().length != 0 && input3.trim().length != 0 && input4.trim().length != 0) {
                    OTO = new FormData()
                    OTO.append("field1", input1)
                    OTO.append("field2", input2)
                    OTO.append("field3", input3)
                    OTO.append("field4", input4)
                    OTO.append("phone", document.getElementById('ad-phone-number').value)
                    OTO.append('items', 'OTOConfirmed')
                    fetch('<?= get_url() ?>api/user/checkContact', {
                        method: "POST",
                        body: OTO
                    }).then((response) => response.json()).then(function(data) {
                        if (data['status'] == 200) {
                            document.getElementById('form_submit').setAttribute('action', data['path'])
                            document.getElementById('form_submit').submit()
                        } else {
                            alert('not verified')
                        }
                    })
                } else {
                    alert('otp fiels are empty')
                }


            })


        };

        document.querySelector('input[name="orgination_enable"]').addEventListener('change', (e) => {
            const orgination = document.querySelectorAll('input[id="orgination"]');
            orgination.forEach(org => {
                if (e.target.checked == true) {
                    org.removeAttribute('disabled')
                } else {
                    org.setAttribute('disabled', 'true')
                }
            })
        })
    </script>

</body>

</html>