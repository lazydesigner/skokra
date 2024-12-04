<?php
session_start();
$uri = $_SERVER['REQUEST_URI'];
// Check if the URL contains any uppercase letters
if (preg_match('/[A-Z]/', $uri)) {
    // Convert the URL to lowercase
    $lowercaseUri = strtolower($uri);

    // Perform a 301 redirect to the lowercase URL
    header("Location: $lowercaseUri", true, 301);
    exit;
}
$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';

$profilerow = Get_User_Details::Get_Single_Ad_Detail(explode('0723', $_GET['x'])[1])[0];

$date = new DateTime($profilerow['date_of_insert']);
$dateofad = $date->format("d M");

if (empty($profilerow['services']) && empty($profilerow['attention_to']) && empty($profilerow['place_of_service']) && empty($profilerow['price'])) {
    $style1 = '';
    $style2 = '';
    $c = 4;
    $w = 24;
} else {
    $c = 3;
    $w = 32;
    $style1 = '';
    $style2 = '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <meta name="description" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" defer>  
    <title>Document</title>
    <style>
        .page-detail-and-information .skokra-breadcrumb {
            width: fit-content;
            text-align: center;
            /* height: 40px; */
            font-size: 1.3rem;
            padding: 5% 10px;
            /* line-height: 40px; */
            border-radius: 4px;
            border: 1px solid var(--header-color);
            font-size: small;
        }

        .page-detail-and-information a {
            color: #36454F
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

        .multiline-ellipsis1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            white-space: pre-wrap;
        }

        .profile-flex {
            width: 100%;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            color: var(--heading-color)
        }

        .profile-age {
            margin-top: 10px;
        }

        .profile-age span {
            border: 1px solid lightgrey;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 5px;
            font-weight: bold;
            color: var(--heading-color)
        }

        .profile-img {
            width: 65%;
        }

        h1 {
            font-size: 1.5rem;
        }

        .profile-det {
            width: 35%;
            padding: 0 0 0 2%;
        }

        .profile-flex button {
            width: 200px;
            height: 40px;
            padding: 2% 5%;
            border: 0;
            border-radius: 15px;
            background-color: var(--primary-color);
            margin: 3% 0;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: white;
        }

        .grid-of-images {
            width: 100%;
            height: auto;
            display: grid;
            grid-template-columns: repeat(<?= $c ?>, minmax(<?= $w . '%' ?>, 1fr));
            grid-auto-rows: 300px;
        }

        .img-item {
            margin: 1%;
        }

        .img-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .profile-img p {
            font-size: 1.1rem;
            line-height: 25px;
        }
        .profile-img div img{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .div-seprator p {
            font-size: 1.5rem;
            margin: 5% 0;
        }

        .service-list {
            width: 100%;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .service-list div {
            width: auto;
            padding: 5px 10px;
            border-radius: 10px;
            border: 1px solid var(--heading-color);
        }

        .report-abuse {
            width: 100%;
            min-height: 100px;
            border-radius: 10px;
            border: 1px solid var(--primary-color);
            padding: 1%;
            margin-top: 5%;
        }

        .report-abuse p {
            margin: 0;
            color: tomato;
        }

        .report-abuse i {
            font-size: 1.5rem;
        }

        .report-abuse ul {
            margin: 0;
            padding-left: 2%;
        }

        .report-abuse ul li {
            margin: 1% 0;
            font-size: small;
        }

        @media (max-width:650px){
            .profile-det, .profile-img{width: 100%;}
            .page-detail-and-information .skokra-breadcrumb{font-size: x-small;}
        }
    </style>
</head>

<body>
    <?php include './common-header.php' ?>
    <div class="container">
        <div class="page-detail-and-information" aria-label="">
            <div id="breadcrumbs">
                <ol style="display: flex;align-items:center;gap:.5%;list-style:none;padding:0" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" title="Genuine Call girls &amp; escorts Service: Photos, Phone number | Skoka" class="crumb" href="<?= get_url() ?>">
                            <div class="skokra-breadcrumb" itemprop="name"><i class="ri-home-4-line">
                                    <span style="display: none;">Skokra India </span>
                                </i></div>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" href="<?= get_url() . strtolower($profilerow['category']) ?>" itemprop="item" class="crumb">
                            <div class="skokra-breadcrumb" itemprop="name">Independent <?= ucwords(str_replace('-', ' ', $profilerow['category'])) ?></div>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                    <?php if (isset($profilerow['city'])) {
                        if (Get_User_Details::checkifitsastateorcity($profilerow['city'])) { ?>

                            <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                            <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb" href="<?= get_url() . strtolower($profilerow['category'] . '/' . str_replace(' ', '-', strtolower($profilerow['state']))) ?>" title="">
                                    <div class="skokra-breadcrumb" itemprop="name"><?= ucwords(str_replace('-', ' ', ucwords($profilerow['state']))) ?></div>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        <?php } ?>
                        <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb">
                                <div class="skokra-breadcrumb" itemprop="name"><?= ucwords(str_replace('-', ' ', $profilerow['city'])) ?></div>
                            </a>
                            <meta itemprop="position" content="4">
                        </li>
                    <?php  } ?>
                </ol>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 3%;">
        <div class="profile-flex">
            <div>
                <div><small><?= $dateofad ?> - Ad ID: <?php if(isset($_SESSION['customer_code'])){echo substr(str_replace($_SESSION['customer_code'] . '_in', '', $profilerow['adid']), -7);}else{echo substr($profilerow['adid'], -7);} ?></small></div>
                <div class="profile-age"><span><?= $profilerow['age'] . ' Years' ?></span><span> <i class="ri-map-pin-line"></i> <?= $profilerow['city'] ?></span></div>
                <h1><?= strtoupper($profilerow['title']) ?></h1>
            </div>
            <div>
                <a href="tel:<?= $profilerow['ad_phone_number'] ?>"><button>Call Now</button></a>
                <?php if ($profilerow['whatsapp_enable'] == 12) { ?><a href="https://wa.me/<?= $profilerow['ad_phone_number'] ?>" target="_blank"><button style="background-color: green;">Whatsapp</button></a><?php } ?>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 3%;">
        <div class="profile-flex">
            <div class="profile-img" <?= $style1 ?>>
                <div>
                    <img src="<?=$profilerow['preview_image'] ?>" width="100%" style="width:65%" height="auto" alt="call girls in India">
                </div>
                <p><strong><i class="ri-emotion-line"></i> About Me</strong></p>
                <p><?= nl2br(htmlspecialchars($profilerow['description'])) ?></p>
                <?php if($profilerow['top_ad'] != 0){ if (!empty($profilerow['images']) || $profilerow['images'] != null) { ?>
                    <div class="grid-of-images">
                        <?php
                        $images = json_decode($profilerow['images'], true);
                        foreach ($images as $img) {
                            $imageData = @getimagesize('https://cdn.skokra.com/secure-images/' . $img);
                            if ($imageData !== false) { ?>
                                <div class="img-item">
                                    <img src="<?= 'https://cdn.skokra.com/secure-images/' . $img ?>" width="100%" height="100%" loading="lazy" alt="">
                                </div>
                        <?php }
                        } ?>
                    </div>
                <?php }} ?>
            </div>

            <div class="profile-det" <?= $style2 ?>>

                <div class="service-list">
                    <?php if(!empty($profilerow['african_ethnicity'])){echo '<div>'.$profilerow['african_ethnicity'].'</div>';} ?>
                    <?php if(!empty($profilerow['nationality'])){echo '<div>'.$profilerow['nationality'].'</div>';} ?>
                    <?php if(!empty($profilerow['boobs'])){echo '<div>'.$profilerow['boobs'].'</div>';} ?>
                    <?php if(!empty($profilerow['hair'])){echo '<div>'.$profilerow['hair'].'</div>';} ?>
                    <?php if(!empty($profilerow['body_type'])){echo '<div>'.$profilerow['body_type'].'</div>';} ?>
                </div>

                <?php if (!empty($profilerow['services'])) { ?>
                    <div class="div-seprator">
                        <p><strong><i class="ri-hearts-line"></i> Services</strong></p>

                        <div class="service-list">
                            <?php
                            $images = json_decode($profilerow['services'], true);
                            foreach ($images as $img) { ?><div><?= $img ?></div><?php } ?>

                        </div>

                    </div><?php } ?>
                <?php if (!empty($profilerow['attention_to'])) { ?><div class="div-seprator">
                        <p><strong><i class="ri-empathize-line"></i> Attention To</strong></p>

                        <div class="service-list">
                            <?php
                            $images = json_decode($profilerow['attention_to'], true);
                            foreach ($images as $img) { ?><div><?= $img ?></div><?php } ?>
                        </div>
                    </div><?php } ?>
                <?php if (!empty($profilerow['place_of_service'])) { ?><div class="div-seprator">
                        <p><strong><i class="ri-map-2-line"></i> Place Of Service</strong></p>

                        <div class="service-list">
                            <?php
                            $images = json_decode($profilerow['place_of_service'], true);
                            foreach ($images as $img) { ?><div><?= $img ?></div><?php } ?>
                        </div>
                    </div><?php } ?>
                <?php if (!empty($profilerow['price'])) { ?><div class="div-seprator">
                        <p><strong><i class="ri-coin-line"></i> Payments</strong></p>
                        <small>Price </small>
                        <div style="border: 1px solid var(--heading-color);padding:4% 2%;border-radius:10px;display:flex;justify-content:space-between;align-items:center">
                            <p style="margin: 0;">From</p>
                            <div style="padding: 5px 10px; border-radius: 10px; background: var(--heading-color);color:white"><?= $profilerow['price'] ?></div>
                        </div>
                        <?php if (!empty($profilerow['payment_method'])) { ?>
                            <div class="service-list" style="margin-top: 4px;">
                                <?php
                                $images = json_decode($profilerow['payment_method'], true);
                                foreach ($images as $img) { ?><div><?= $img ?></div><?php } ?>
                            </div> <?php } ?>
                    </div><?php } ?>

                <div class="div-seprator">
                    <p><strong>Contact Me</strong></p>
                </div>
                <div style="display: flex;flex-wrap:wrap;gap:10px;margin-top:5%">
                    <a href="tel:<?= $profilerow['ad_phone_number'] ?>"><button style="max-width:160px">Call Now</button></a>
                    <?php if ($profilerow['whatsapp_enable'] == 12) { ?><a href="https://wa.me/<?= $profilerow['ad_phone_number'] ?>" target="_blank"><button style="background-color: green;max-width:160px">Whatsapp</button></a><?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="report-abuse">
            <p><i class="ri-spam-2-line"></i><b> Report Abuse</b></p>

            <ul>
                <li>Emails <b>privacy@skokra.com</b> can be used to report cases of intellectual property infringement or improper use of photos or data (e.g., phone numbers, email addresses, names, and addresses).</li>
                <li>You can report instances of content that is considered abusive or illegal by sending an email to <b>support@skokra.com</b>.</li>
            </ul>
        </div>
    </div>

    <?php include './footer.php' ?>
    <?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/account/dashboard/private-area.php';

    if (file_exists($path)) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/account/dashboard/private-area.php';
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/account/dashboard/private-area.php';
    }


    ?>
    <script src="<?= get_url() ?>assets/js/common.js" defer></script>

</body>

</html>