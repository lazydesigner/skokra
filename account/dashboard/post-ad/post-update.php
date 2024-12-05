<?php 
session_start();
$POST_INSERT = 'yes'; //to hide add post button in this page

$path =  $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/routes.php';

if (file_exists($path)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/routes.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/routes.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/backend/user_task.php';
}


$result = Get_User_Details::Get_ad_detail($_GET['post_id']);
function Select_opt($value, $option){
    if(strtolower($value) == strtolower($option)){
        echo 'checked';
    }else{
        echo '';
    }
}




function Select_opt2($value, $option){
    if($option != null){
        $option2 = json_decode($option);
    if(in_array(strtolower($value), array_map('strtolower', $option2))){
        echo 'checked';
    }else{
        echo '';
    }}else{echo '';}
}

function Select_opt3($value, $option){
    if(strtolower($value) == strtolower($option)){
        echo 'selected';
    }else{
        echo '';
    }
}

$list_of_citie = '<option value="">All the Cities</option>';
$list_of_cities = Get_User_Details::Get_states_detail()[0];

foreach($list_of_cities as $list_of_city){
    $list_of_cty = json_decode($list_of_city['cities'], true);
    foreach($list_of_cty as $list_of_ct){
        if(strtolower(str_replace(' ','-', $list_of_ct)) == strtolower($result['city'])){
            $list_of_citie .= '<option value="'.strtolower(str_replace(' ','-', $list_of_ct)).'" selected>'.ucwords($list_of_ct).'</option>';
        }else{
        $list_of_citie .= '<option value="'.strtolower(str_replace(' ','-', $list_of_ct)).'">'.ucwords($list_of_ct).'</option>';
    }}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
        }

        .preview-image-box-grid {
            display: grid;
            
            grid-template-columns: repeat(5, minmax(20%, 1fr));
            grid-auto-rows: 250px;
            justify-content: space-between;
            /* grid-template-rows: auto; */
            column-gap: 5px;
        }
        .preview-image{position: relative;}
        .lock-img{
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            position: absolute;
            top: 0;
            left: 0;
            display: grid;
            place-items: center;
        }
        .lock-img i{font-size: 1.5rem;color: white;}

        .crop-the-image-container {
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            place-items: center;
        }

        .preview-the-image {
            width: 400px;
            height: 400px;
            background-color: lightgrey;
        }

        .preview-the-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .multiline-ellipsis {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            margin: 1% 0;
            /* let the text wrap preserving spaces */
        }
    </style>
</head>

<body>

    <?php include '../dash-nav.php' ?>
    <div class="post-insert-heading">
        <h1>Edit your Ad</h1>
    </div>


    <form id="form" action="<?= get_url() ?>update-insert-ad" method="POST">
        <div class="step-one">
            <div class="container">
                <div class="top-form-field">
                    <strong>Your Ad</strong>
                    <small>*Required fields</small>
                    <input type="text" name="post_id" hidden value="<?=$_GET['post_id'] ?>">
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">*Select category</label>
                        <select name="category" id="category">
                            <option value="call-girls" <?=Select_opt3('call-girls',$result['category']) ?>>Call Girls</option>
                            <!-- <option value="massages" <?=Select_opt3('massages',$result['category']) ?>>Massages</option>
                            <option value="male-escorts" <?=Select_opt3('male-escorts',$result['category']) ?>>Male Escorts</option>
                            <option value="transsexual" <?=Select_opt3('transsexual',$result['category']) ?>>Transsexual</option>
                            <option value="adult-meetings" <?=Select_opt3('adult-meetings',$result['category']) ?>>Adult Meetings</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">*Select city</label>
                        <select name="city" id="city">
                            <?=$list_of_citie ?>
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
                        <input type="number" value="<?=$result['age'] ?>" name="age">
                    </div>
                    <div class="form-group">
                        <label for="city">*Title</label>
                        <textarea name="title" id="" cols="30" rows="5" placeholder="Give your ad a good title"><?=$result['title'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">*Description</label>
                        <textarea name="description" id="" cols="30" rows="8" placeholder="Use this space to describe yourself, your body, your skills and what you like..."><?=$result['description'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="container">
            <input type="file" name="drag-and-drop-profile-photo" hidden id="replace-the-selected-profile-photo">
            <div class="top-form-field">
                <label for=""><strong>Your Photos</strong></label>
            </div>
                <div class="form-container">
                    <div class="form-group">
                        <div class="preview-drap-or-selected-image">

                        <div class="preview-image-box-grid" id="preview-image-box-grid">

<!-- resized-drop-area is the class to be added below to make it small and responsive -->

</div>

                            <div class="drag-and-drop-profile-photo" id="drag-and-drop-profile-photo">
                                <input type="file" name="drag-and-drop-profile-photo" id="draged-or-selected-profile-photo">
                                <div>
                                    <p style="text-transform: uppercase;">you can upload upto 10 pictures </p>
                                    <p><i class="ri-camera-fill"></i></p>
                                    <p>Drag the picture here or click to select them</p>
                                </div>
                            </div>
                        </div>
                        <small class="information-about-profile-image" style="text-align: center;">if you don't choose any preview photos, first photo inserted in photo gallery will be selected as default preview photo</small>
                    </div>

                    <div class="form-group">
                        <small class="Only-one-picture-visible-for-free-add" style="color:darkblue;"><i class="ri-information-line"></i> Only one picture visible for free add</small>
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
                            <input type="radio" name="african"  <?=Select_opt('African',$result['african_ethnicity']) ?> id="african" value="African">

                            <label for="indian" class="category" id="indian">
                                <div>Indian</div>
                            </label>
                            <input type="radio" name="african"  <?=Select_opt('Indian',$result['african_ethnicity']) ?> id="indian" value="Indian">

                            <label for="asian" class="category" id="asian">
                                <div>Asian</div>
                            </label>
                            <input type="radio" name="african"  <?=Select_opt('Asian',$result['african_ethnicity']) ?> id="asian" value="Asian">

                            <label for="arab" class="category" id="arab">
                                <div>Arab</div>
                            </label>
                            <input type="radio" name="african"  <?=Select_opt('Arab',$result['african_ethnicity']) ?> id="arab" value="Arab">

                            <label for="latin" class="category" id="latin">
                                <div>Latin</div>
                            </label>
                            <input type="radio" name="african"  <?=Select_opt('Latin',$result['african_ethnicity']) ?> id="latin" value="Latin">

                            <label for="caucasian" class="category" id="caucasian">
                                <div>Caucasian</div>
                            </label>
                            <input type="radio" name="african"  <?=Select_opt('Caucasian',$result['african_ethnicity']) ?> id="caucasian" value="Caucasian">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Nationality</label>
                        <select name="nationality" id="nationality">
                            <option value="0">Select Nationality</option>
                            <option value="indian"  <?=Select_opt3('indian',$result['nationality']) ?>>Indian</option>
                            <option value="russian" <?=Select_opt3('russian',$result['nationality']) ?>>Russian</option>
                            <option value="australian <?=Select_opt3('australian',$result['nationality']) ?>">Australian</option>
                            <option value="american" <?=Select_opt3('american',$result['nationality']) ?>>American</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Breast</label>
                        <div class="form-flex">
                            <label for="natural-boobs" class="boobs">
                                <div>Natural Boobs</div>
                            </label>
                            <input type="radio" name="boobs" <?=Select_opt('Natural Boobs',$result['boobs']) ?> id="natural-boobs" value="Natural Boobs">

                            <label for="busty" class="boobs" id="busty">
                                <div>Busty</div>
                            </label>
                            <input type="radio" name="boobs" <?=Select_opt('Busty',$result['boobs']) ?> id="busty" value="Busty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Hair</label>
                        <div class="form-flex">
                            <label for="blond-hair" class="hair">
                                <div>Blond Hair</div>
                            </label>
                            <input type="radio" name="hair" id="blond-hair" value="Blond Hair" <?=Select_opt('Blond Hair',$result['hair']) ?>>

                            <label for="brown-hair" class="hair">
                                <div>Brown Hair</div>
                            </label>
                            <input type="radio" name="hair" id="brown-hair" value="Brown Hair" <?=Select_opt('Brown Hair',$result['hair']) ?>>
                            <label for="black-hair" class="hair">
                                <div>Black Hair</div>
                            </label>
                            <input type="radio" name="hair" id="black-hair" value="Black Hair" <?=Select_opt('Black Hair',$result['hair']) ?>>

                            <label for="red-hair" class="hair">
                                <div>Red Hair</div>
                            </label>
                            <input type="radio" name="hair" id="red-hair" value="Red Hair" <?=Select_opt('Red Hair',$result['hair']) ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Body Type</label>
                        <div class="form-flex">
                            <label for="slim" class="body-type">
                                <div>Slim</div>
                            </label>
                            <input type="radio" name="body-type" id="slim" value="slim"  <?=Select_opt('slim',$result['body_type']) ?>>

                            <label for="curvy" class="body-type">
                                <div>Curvy</div>
                            </label>
                            <input type="radio" name="body-type" id="curvy" value="curvy" <?=Select_opt('curvy',$result['body_type']) ?>>
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
                            <input type="checkbox" name="services[]" <?=Select_opt2('Oral',$result['services']) ?> id="service1" value="Oral">
                            <label class="service_" for="service1">
                                <div>Oral</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Anal',$result['services']) ?> id="service2" value="Anal">
                            <label class="service_" for="service2">
                                <div>Anal</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('BDSM',$result['services']) ?> id="service3" value="BDSM">
                            <label class="service_" for="service3">
                                <div>BDSM</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('GirlFriend Experience',$result['services']) ?> id="service4" value="GirlFriend Experience">
                            <label class="service_" for="service4">
                                <div>Girlfriend experience</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Videocall',$result['services']) ?> id="service5" value="Videocall">
                            <label class="service_" for="service5">
                                <div>Videocall</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Threesome',$result['services']) ?> id="service6" value="Threesome">
                            <label class="service_" for="service6">
                                <div>Threesome</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Role play',$result['services']) ?> id="service7" value="Role play">
                            <label class="service_" for="service7">
                                <div>Role play</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Porn actressess',$result['services']) ?> id="service8" value="Porn actressess">
                            <label class="service_" for="service8">
                                <div>Porn actresses</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Erotic massage',$result['services']) ?> id="service9" value="Erotic massage">
                            <label class="service_" for="service9">
                                <div>Erotic massage</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('French kiss',$result['services']) ?> id="service10" value="French kiss">
                            <label class="service_" for="service10">
                                <div>French kiss</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Sexting',$result['services']) ?> id="service11" value="Sexting">
                            <label class="service_" for="service11">
                                <div>Sexting</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Body ejaculation',$result['services']) ?> id="service12" value="Body ejaculation">
                            <label class="service_" for="service12">
                                <div>Body ejaculation</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Fetish',$result['services']) ?> id="service13" value="Fetish">
                            <label class="service_" for="service13">
                                <div>Fetish</div>
                            </label><input type="checkbox" name="services[]" <?=Select_opt2('Tantric massage',$result['services']) ?> id="service14" value="Tantric massage">
                            <label class="service_" for="service14">
                                <div>Tantric massage</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Attention to</label>
                        <div class="form-flex">
                            <input type="checkbox" id="attention_men" <?=Select_opt2('Men',$result['attention_to']) ?> name="attention_to[]" value="Men">
                            <label class="Attention" for="attention_men">
                                <div>Men</div>
                            </label>
                            <input type="checkbox" id="Attention_women" <?=Select_opt2('Women',$result['attention_to']) ?> name="attention_to[]" value="Women">
                            <label class="Attention" for="Attention_women">
                                <div>Women</div>
                            </label>
                            <input type="checkbox" id="Attention_couple" <?=Select_opt2('Couple',$result['attention_to']) ?> name="attention_to[]" value="Couples">
                            <label class="Attention" for="Attention_couple">
                                <div>Couples</div>
                            </label>
                            <input type="checkbox" id="Attention_disabled" <?=Select_opt2('disabled',$result['attention_to']) ?> name="attention_to[]" value="disabled">
                            <label class="Attention" for="Attention_disabled">
                                <div>Disabled</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Place of service</label>
                        <div class="form-flex">
                            <input type="checkbox" id="place_of_service_home" <?=Select_opt2('At Home',$result['place_of_service']) ?> name="place_of_service[]" value="At Home" />
                            <label class="place_of_service" for="place_of_service_home">
                                <div>At Home</div>
                            </label>
                            <input type="checkbox" id="place_of_service_party" <?=Select_opt2('Event And Parties',$result['place_of_service']) ?> name="place_of_service[]" value="Event And Parties">
                            <label class="place_of_service" for="place_of_service_party">
                                <div>Event And Parties</div>
                            </label>
                            <input type="checkbox" id="place_of_service_hotel" <?=Select_opt2('Hotel / Motel',$result['place_of_service']) ?> name="place_of_service[]" value="Hotel / Motel">
                            <label class="place_of_service" for="place_of_service_hotel">
                                <div>Hotel / Motel</div>
                            </label>
                            <input type="checkbox" id="place_of_service_clubs" <?=Select_opt2('clubs',$result['place_of_service']) ?> name="place_of_service[]" value="clubs">
                            <label class="place_of_service" for="place_of_service_clubs">
                                <div>Clubs</div>
                            </label>
                            <input type="checkbox" id="place_of_service_outcall" <?=Select_opt2('OutCall',$result['place_of_service']) ?> name="place_of_service[]" value="OutCall">
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
                            <option value="1000"  <?=Select_opt3('1000',$result['price']) ?>>From Rs 1000</option>
                            <option value="2000"  <?=Select_opt3('2000',$result['price']) ?>>From Rs 2000</option>
                            <option value="3000"  <?=Select_opt3('3000',$result['price']) ?>>From Rs 3000</option>
                            <option value="4000"  <?=Select_opt3('4000',$result['price']) ?>>From Rs 4000</option>
                            <option value="5000"  <?=Select_opt3('5000',$result['price']) ?>>From Rs 5000</option>
                            <option value="6000"  <?=Select_opt3('6000',$result['price']) ?>>From Rs 6000</option>
                            <option value="7000"  <?=Select_opt3('7000',$result['price']) ?>>From Rs 7000</option>
                            <option value="8000"  <?=Select_opt3('8000',$result['price']) ?>>From Rs 8000</option>
                            <option value="9000"  <?=Select_opt3('9000',$result['price']) ?>>From Rs 9000</option>
                            <option value="10000"  <?=Select_opt3('10000',$result['price']) ?>>From Rs 10000</option>
                            <option value="11000"  <?=Select_opt3('11000',$result['price']) ?>>From Rs 11000</option>
                            <option value="12000"  <?=Select_opt3('12000',$result['price']) ?>>> 12000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Payment methods</label>
                        <div class="form-flex">
                            <input type="checkbox" value="cash" <?=Select_opt2('cash',$result['payment_method']) ?> name="payment-method[]" id="cash">
                            <label class="payment" for="cash">
                                <div>Cash</div>
                            </label>
                            <input type="checkbox" value="credit-card" <?=Select_opt2('credit-card',$result['payment_method']) ?> name="payment-method[]" id="credit-card">
                            <label class="payment" for="credit-card">
                                <div>Credit Card</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Your Contacts</strong></span>
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
                            <input type="radio" <?=Select_opt('phone',$result['contact']) ?> name="contact" id="phone" value="phone" checked>
                            <label for="email-phone" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Email and Phone
                                </div>
                            </label>
                            <input type="radio" <?=Select_opt('email-phone',$result['contact']) ?> name="contact" value="email-phone" id="email-phone">
                            <label for="eamil" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Only Email
                                </div>
                            </label>
                            <input type="radio" <?=Select_opt('email',$result['contact']) ?> name="contact" value="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Email Address</label>
                        <input type="text" value="<?=$_SESSION['email'] ?>" readonly disabled name="user-email">
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Phone Number</label>
                        <input type="number" value="<?=$result['ad_phone_number'] ?>" readonly disabled name="ad-phone-number" id="">
                    </div>
                    <div class="form-group">
                        <div class="form-flex">
                            <label class="switch">
                                <input type="checkbox" value="true" <?php if($result['whatsapp_enable'] == 1){echo 'checked';} ?> name="whatsapp-emable">
                                <span class="slider"></span>
                            </label>Whatsapp
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <button class="next-step" id="next-step"><i class="ri-lock-unlock-fill"></i> ACTIVATE A PROMO AND UNLOCK IMAGES</button>
                <button class="next-step" name='update_post_ad' id="next-step">GO ON</button>
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


    <div class="crop-the-image-container" id="crop-the-image-container">
        <div>
            <div class="preview-the-image" id="preview-the-image">
                <img src="" id="preview_image_to_crop" alt="">
            </div>
            <button id='crop-button'>Crop</button>
            <button id="close_the_preview">Back</button>
        </div>
    </div>

    <div class="container"><?php include '../../../footer.php' ?></div>
    <?php include '../private-area.php' ?>

    <script>
        // document.getElementById('progress').addEventListener('click',()=>{
        //     // CREATE A BUTTON WITH NAME PROGRESS
        //     count++
        //     let active = document.querySelectorAll('.progress-bar')
        //     for(i=0;i<count;i++){
        //         if(i != 4){
        //             active[i].classList.add("active-progress")
        //             if(i==3){
        //                 document.getElementById('progress').disabled = 'true'
        //             }
        //         }
        //     }
        // })

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
                        console.log('clicked')
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
            const categoryRadios = document.querySelectorAll('.category');
            const boobsRadios = document.querySelectorAll('.boobs');
            const hairRadios = document.querySelectorAll('.hair');
            const bodyRadios = document.querySelectorAll('.body-type');

            handleRadioButtons(categoryRadios);
            handleRadioButtons(boobsRadios);
            handleRadioButtons(hairRadios);
            handleRadioButtons(bodyRadios);
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

        // Select all radio and checkbox inputs that have the checked attribute
let inputs = document.querySelectorAll('input[type="radio"][checked], input[type="checkbox"][checked]');

// Loop through each input
inputs.forEach(function(input) {
    // Get the id of the current input
    let inputId = input.id;

    // If the input has an id, use it to find the associated label
    if (inputId) {
        let label = document.querySelector(`label[for="${inputId}"]`);
        
        // If the label is found, add the 'label' class to the input and/or label
        if (label) {
            label.classList.add('label');   // Add class to associated label if needed
        }
    }
});



        // document.getElementById('next-step').addEventListener('click',(e)=>{
        //     e.preventDefault()
        //     const formdata = document.getElementById('form')
        //     const data = new FormData(formdata)

        //     // Checking that all fields
        //     // are filled out before moving to next step
        //     for (let pair of data.entries()) {
        //         if(pair[0] == 'services[]'){
        //             const services = [];
        //             services.push(pair[1]);
        //         }else{

        //         }
        //     }
        // })
    </script>

    <script>
        // Image Functioning
        let count = 1


        const dropZone = document.getElementById('drag-and-drop-profile-photo');

        dropZone.addEventListener('click', () => {
            document.getElementById('draged-or-selected-profile-photo').click()
        })

        // function OnClick() {
        //     event.stopPropagation();
        //     document.getElementById('draged-or-selected-profile-photo').click();
        //     console.log('clicked for image selection');
        // }

        document.getElementById('draged-or-selected-profile-photo').addEventListener('change', (e) => {

            HandelImageUploading(e.target.files)
        })

        dropZone.addEventListener('dragover', PREVENTDefalut, false)
        // dropZone.addEventListener('drop', PREVENTDefalut, false)
        dropZone.addEventListener('dragleave', PREVENTDefalut, false)

        function PREVENTDefalut() {
            event.preventDefault();
            event.stopPropagation();
        }

        // function droptheimage() {
        //     event.preventDefault();
        //     event.stopPropagation();
        //     HandelImageUploading(event.dataTransfer.files)
        //     // event.dataTransfer.clearData();
        // }
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            HandelImageUploading(e.dataTransfer.files)
            e.dataTransfer.clearData()
        }, false)

        function HandelImageUploading(imageupload) {

            const image = new FormData()
            image.append('image', imageupload[0])
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            // fetch('<?= get_url() ?>image_processing/image-upload.php', {
            fetch('https://cdn.skokra.com/image-upload.php', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                // document.getElementById('draged-or-selected-profile-photo').value = '';
                document.getElementById('preview-image-box-grid').innerHTML = '';
                if (d['status'] == true) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                }
            })
        }

        ShowPreviewImage('<?= $_SESSION['email'] ?>')

        function ShowPreviewImage(identifications) {
            const identification = new FormData()
            identification.append('i', identifications)
            identification.append('pi', '<?= $_GET['post_id'] ?>')
            identification.append('up_img', 'updating')
            fetch('<?= get_url() ?>show-image', {
                method: 'post',
                body: identification
            }).then(res => res.json()).then(data => { 

                if(data['count'] >= 10 ){
                    document.getElementById('drag-and-drop-profile-photo').style.display = 'none'
                }

                document.getElementById('drag-and-drop-profile-photo').classList.add('resized-drop-area')
                // document.getElementById('preview-image-box-grid').innerHTML = '';
                document.getElementById('preview-image-box-grid').innerHTML = data['output'];
                // document.getElementById('preview-image-box-grid').innerHTML += '<div class="drag-and-drop-profile-photo preview-image-box" onclick="OnClick()" ondragleave="PREVENTDefalut(this)" ondragover="PREVENTDefalut(this)" ondrop="droptheimage(this)" id="drag-and-drop-profile-photo"><input type="file" name="drag-and-drop-profile-photo" id="draged-or-selected-profile-photo" hidden multiple><div><p style="text-transform: uppercase;">you can upload upto 10 pictures </p><p><i class="ri-camera-fill"></i></p><p>Drag the picture here or click to select them</p></div></div>';
                AddPreview_image()
                
            })
        }

// =================================================
let cropper;

        function CropTheImage(id) {

            let preview = document.getElementById('skokracroped' + id).src;

            document.getElementById('crop-the-image-container').style.display = 'grid'

            document.getElementById('preview_image_to_crop').src = '';

            document.getElementById('preview_image_to_crop').src = preview;


            CropFunction()

        }

        function CropFunction() {
            prev = document.getElementById('preview_image_to_crop')
            const cropperOptions = {
                aspectRatio: 1 / 1, // Aspect ratio of the crop box (square)
                viewMode: 2, // Displayed image covers the crop box
                dragMode: 'move', // Can only move the crop box
                autoCropArea: 1, // Always create a 100% crop box
                movable: false, // Disable dragging
                zoomable: false, // Disable zooming
                rotatable: false, // Disable rotating
                scalable: false // Disable scaling
            };
            cropper = new Cropper(prev, cropperOptions);
        }

        document.getElementById('crop-button').addEventListener('click', function(e) {
            e.preventDefault()
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Set width of the output image
                height: 200 // Set height of the output image
            });

            // Convert the canvas to base64 data URL
            const croppedImage = croppedCanvas.toDataURL();

            // Do something with the croppedImage, for example, upload it to the server
            // Here you can use AJAX to send the croppedImage to the server
            const img = new FormData()
            img.append('image', croppedImage)
            img.append('imageName', document.getElementById('preview_image_to_crop').src)
            fetch('https://cdn.skokra.com/croptheimage.php', {
                    method: 'POST',
                    body: img
                })
                .then(response => response.json())
                .then(data => {
                    if (data['status'] == 200) {
                        ShowPreviewImage('<?= $_SESSION['email'] ?>');
                        document.getElementById('crop-the-image-container').style.display = 'none';
                        cropper.destroy();
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('close_the_preview').addEventListener('click', () => {
            document.getElementById('crop-the-image-container').style.display = 'none';
            document.getElementById('preview_image_to_crop').src = '';
            cropper.destroy();
        })

        // DELETING THE IMAGE FUNCTION
        function DeleteImage(pi, i) {
            const image = new FormData()
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            image.append('i', i)
            fetch('https://cdn.skokra.com/delete-image.php', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                if (d['status'] == 200) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                } else {
                    alert('image not deleted')
                }
            })
        }
        // DELETING THE IMAGE FUNCTION

        // REUPLOADING THE IMAGE pi->post-id--i->id
        let image_i;

        function ReuploadImage(pi, i) {
            document.getElementById('replace-the-selected-profile-photo').click()
            image_i = i
        }
        document.getElementById('replace-the-selected-profile-photo').addEventListener('change', (e) => {
            const image = new FormData()
            image.append('image', e.target.files[0])
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            image.append('i', image_i)
            fetch('https://cdn.skokra.com/image-upload.php', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                document.getElementById('draged-or-selected-profile-photo').value = '';
                document.getElementById('preview-image-box-grid').innerHTML = '';
                if (d['status'] == true) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                }
            })
        })

        function AddPreview_image() {
            let preview_image_box = document.querySelectorAll('.preview-image-box')
            let preview_image = document.querySelectorAll('.preview-tag')
            let skokracroped = document.querySelectorAll('.skokracropedX')
            let lock_img = document.querySelectorAll('#lock-img')
            preview_image_box.forEach((imagex, i) => {
                imagex.addEventListener('click', (e) => {
                    let data = new FormData();
                    data.append('activity', 'preview');
                    data.append('post_', '<?= $_GET['post_id'] ?>');
                    data.append('i', skokracroped[i].src);
                    fetch('<?= get_url() ?>u/activity-center', {
                        method: 'POST',
                        body: data
                    }).then(response => response.json()).then(value => {
                        if (value['success4'] == 'success4') {
                            preview_image.forEach((img,j) => {
                                img.style.backgroundColor = 'grey';
                                lock_img[j].innerHTML = ''
                                lock_img[j].style.backgroundColor = 'rgba(0, 0, 0, .5)'
                                lock_img[j].innerHTML = '<i class="ri-lock-2-line"></i>';
                                
                            })
                                preview_image[i].style.backgroundColor = 'dodgerblue';
                                lock_img[i].style.backgroundColor = 'transparent'
                                lock_img[i].innerHTML = '';
                        }
                    })

                })
            })
        }



        // Image Functioning
    </script>



</body>

</html>