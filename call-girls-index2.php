<?php


// This Page Show City Content 



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


$cat_array = ['call-girls'];
// $cat_array = ['transsexual', 'adult-meeting', 'massage', 'male-escorts', 'call-girls', 'dating'];
if (in_array($_GET['cat'], $cat_array)) {
} else {
    header("Location: " . get_url() . "");
}


$superrows = Get_User_Details::Show_Super_Top_Ads();


$toprows = Get_User_Details::Show_Top_Ads();

if (Get_User_Details::checkifitsastateorcity($_GET['cty'])) {
    $normalAds = Get_User_Details::Show_Ads($_GET['cty']);
} else {
    $normalAds = Get_User_Details::Show_Ads(ucwords(str_replace('-', ' ', $_GET['cty'])));
}


$pattern = '/[*%{}()\/|><+=\]\[?.,:"\'\\\\&;$^@!]/u';

function remove_emoji($url)
{
    // This regex removes emojis by matching non-alphanumeric and non-ASCII characters
    $url = preg_replace('/[^\x20-\x7E]/u', '', $url);
    // Replace multiple consecutive dashes with a single dash
    $url = preg_replace('/-+/', '-', $url);

    // Trim any leading or trailing dashes
    return trim($url, '-');
}



if (isset($_GET['cty'])) {
    if (Get_User_Details::checkifitsastateorcity($_GET['cty'])) {
        $cityf = Get_User_Details::Get_Cities_detail(Get_User_Details::getStateByCity($_GET['cty']))[0];
    } else {
        $cityf = Get_User_Details::Get_Cities_detail($_GET['cty'])[0];
    }




    $cityofcity = '<option value="">All the Cities</option>';

    if (is_string($cityf['cities'])) {
        $cty = json_decode($cityf['cities'], true);
    } else {
        $x = json_encode($cityf['cities']);
        $cty = json_decode($x, true);
    }

    foreach ($cty as $ct) {
        if (isset($_GET['cty'])) {
            $navcty = $_GET['cty'];
        } else {
            $navcty = 'skokra';
        }
        if (strtolower($ct) == strtolower($navcty)) {
            $cityofcity .= '<option value="' . strtolower($ct) . '_' . strtolower(str_replace(' ', '-', Get_User_Details::getStateByCity($_GET['cty']))) . '" selected>' . ucwords($ct) . '</option>';
        } else {
            $cityofcity .= '<option value="' . strtolower($ct) . '_' . strtolower(str_replace(' ', '-', Get_User_Details::getStateByCity($_GET['cty']))) . '">' . ucwords($ct) . '</option>';
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" defer>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" async />
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">

    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="<?= strtolower(get_url() . $_GET['cat'] . '/' . Get_User_Details::getStateByCity($_GET['cty']) . '/' . $_GET['cty'] . '/') ?>" />
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" async>
    <title>Independent Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> | <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Escorts - Skokra</title>
    <meta name="description" content="Are you looking for genuine <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> escorts with real images and mobile number? Skokra has 500+ Independent call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> with full satisfaction.">
    <script>
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            let user = getCookie("confirm_terms");
            if (user != "") {
                document.body.classList.remove('body-no-scroll');
                var remove_agree_terms = document.getElementById("confirm-18");
                remove_agree_terms.style.display = "none";
            }
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(";");
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == " ") {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            let user = getCookie("confirm_terms");
            if (user != "") {
                //var remove_agree_terms = document.getElementById("confirm-18");
                //remove_agree_terms.style.display = "none";
                remove_agree_terms_hide()
            } else {
                var remove_agree_terms = document.getElementById("confirm-18");
                remove_agree_terms.style.display = "block";
            }
        }
        </script>
    <style>
        /* .page-detail-and-information ol li{ */
        /* border: 1px solid var(--header-color); */
        /* } */
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

        .stories-container {
            width: 100%;
            height: auto;
            display: flex;
            gap: 10px;
            justify-content: start;
            align-items: center;
        }

        .container h1,
        h2,
        h3,
        h4 {
            font-size: 1.2rem;
        }

        .story-items {
            width: 10%;
            height: 160px;
            background-color: lightblue;
            border-radius: 5px;
            overflow: hidden;
            display: grid;
            position: relative;
        }

        .story-items img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .story-items>div {
            width: 95%;
            height: fit-content;
            position: absolute;
            /* background-color: red; */
            bottom: 0;
            left: 2%;
        }

        .story-items p {
            width: 100%;
            text-wrap: nowrap;
            text-overflow: ellipsis;
            align-self: last baseline;
            background-color: white;
            z-index: 1;
            margin: 2% 0;
        }

        .current-date {
            margin-bottom: 3%;
        }

        .ad-blockdd {
            margin-top: 2%;
            width: 100%;
            min-height: auto;
            max-height: 300px;
            display: flex;
            background-color: whitesmoke;
            border: 1px solid var(--header-color);
            border-radius: 10px;
            overflow: hidden;
        }

        .ad-image-block {
            width: 22%;
            height: 100%;
            position: relative;
            background-color: lightblue;
        }

        .ad-image-block img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ad-image-count {
            position: absolute;
            width: 50px;
            height: 20px;
            background-color: rgba(0, 0, 0, .4);
            color: white;
            bottom: 1%;
            left: 2%;
            z-index: 1;
            border-radius: 5px;
            text-align: center;
        }

        .ad-detail-block {
            width: 78%;
            /* width: 100%; */
            height: 100%;
            padding: 1%;
            cursor: auto;
        }

        .ad-details p {
            font-size: 1.1rem;
            line-height: 25px;
        }

        .ad-details {
            padding: .5% 1%;
        }

        .skokra-ad-title {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .skokra-ad-title a {
            color: #0060B0
        }

        .ad-detail-category {
            width: 100%;
            height: auto;
            display: grid;
            justify-content: end;
        }

        .ad-tags {
            width: max-content;
            height: max-content;
            padding: .5% 10px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            /* justify-content: end; */
            background-color: var(--header-color);
            color: white;
            font-size: small;
        }

        .ad-tags i {
            transform: rotate(-90deg);
            font-size: 1.2rem;
        }

        .ad-contact-button {
            width: 100%;
            padding: 0 1%;
            margin: 2% 0;
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 1%;
        }

        .about-ad-detail {
            display: flex;
            align-items: center;
            gap: 1%;
        }

        .about-ad-detail p {
            width: fit-content;
            padding: 0 1%;
            text-wrap: nowrap;
            border-radius: 10px;
            background-color: lightblue;
            margin: .5% 0;
            font-size: small;
        }

        .ad-contact-button button {
            min-width: 60px;
            height: 35px;
            border-radius: 5px;
            box-shadow: 0 0 5px 3px lightblue;
            border: 0;
            cursor: pointer;
            font-weight: 500;
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

        .service-category {
            text-align: center;
            padding: 1.5% 0;
            margin: 2% auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 12px 6px #F8F8FF;
            font-size: 1.3rem;
            font-weight: 500;
        }

        .service-category a {
            color: var(--primary-color)
        }

        .service-category:hover a {
            color: var(--header-color)
        }

        .list-of-cities-container {
            margin-top: 2%;
            box-shadow: 0 0 12px 6px #F8F8FF;
            padding: 2%;
            text-align: center;
        }

        .list-of-cities-container strong {
            font-size: 1.5rem;
            text-align: center;
        }

        .list-of-cities {
            width: 100%;
            height: auto;
            padding: 2% 4%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .list-of-cities a {
            width: fit-content;
            margin: .5% 1%;
            padding: 1% 2%;
            border-radius: 30px;
            border: 1px solid var(--header-color);
            color: var(--primary-color)
        }

        .list-of-cities a:hover {
            box-shadow: 0 0 6px 3px #F8F8FF;
            background-color: #F8F8FF;
        }

        .multiline-ellipsis1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            /* let the text wrap preserving spaces */
        }

        .container {
            color: var(--heading-color)
        }
    </style>
    <style>
        .story {
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .8);
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .story-info {
            padding: 2%;
        }

        .story-div {
            width: 50%;
            height: 90%;
            background-color: black;
            border-radius: 5px;
            position: relative;
        }

        .story-title p {
            color: white;
            margin: 0;
        }

        .story-services {
            margin-top: 1%;
            display: flex;
            gap: 5px;
        }

        .story-services div {
            background-color: #0060B0;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            padding: 1% 3%;
            width: fit-content;
        }

        .story-indecator {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5px;
        }

        .story-img-div {
            width: 100%;
            height: 77.5%;
            margin-top: 2%;
            /* border: 1px solid #0060B0;
            display: grid;
            grid-template-columns: repeat(3, minmax(100%, 1fr)); */
            position: relative;
            /* overflow: hidden; */
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .swiper-pagination-bullet {
            width: 30%;
            height: 5px;
            border-radius: 10px;

            /* display: inline; */
        }

        .close_the_story {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background-color: white;
            color: black;
            right: -40px;
            top: 10px;
        }

        .swiper-horizontal>.swiper-pagination-bullets,
        .swiper-pagination-bullets.swiper-pagination-horizontal {
            bottom: var(--swiper-pagination-bottom, auto);
        }

        @media (min-width:320px) and (max-width:550px) {
            .story-div {
                width: 90%;
            }

            .close_the_story {
                top: -20px;
                right: -10px;
                width: 35px;
                height: 35px;
            }

            .story-items {
                width: 40%;
            }

            .ad-blockdd {
                width: 100%;
                max-height: fit-content;
                flex-wrap: wrap;
            }

            .ad-image-block {
                height: 200px;
                width: 100%;
            }

            .ad-detail-block {
                width: 100%;
            }

            .ad-image-block img {
                object-fit: cover;
                object-position: top;
            }

            /* TOP ADS CSS */
            .topcss .ad-image-block {
                height: 200px;
                width: 40%;
            }

            .topcss .ad-detail-block {
                width: 60%;
            }

            .topcss .ad-contact-button {
                display: none;
            }

            .topcss .skokra-ad-title {
                font-size: .9rem;
            }

            .topcss .ad-details p {
                font-size: .8rem;
                line-height: 17px;
            }

            .topcss .multiline-ellipsis {
                -webkit-line-clamp: 4;
            }

            .topcss .multiline-ellipsis1 {
                -webkit-line-clamp: 2;
            }


            .page-detail-and-information .skokra-breadcrumb {
                padding: 5% 5px;
                font-size: x-small;
            }





        }

        @media (min-width:550px) and (max-width:900px) {
            .story-div {
                width: 65%;
            }

            .story-items {
                width: 22%;
            }

            .ad-image-block {
                width: 32%;
            }

            .ad-detail-block {
                width: 68%;
            }

            /* .ad-contact-button{display: none;} */
            .skokra-ad-title {
                font-size: 1.2rem;
            }

            .ad-details p {
                font-size: .9rem;
                line-height: 19px;
            }

            .multiline-ellipsis {
                -webkit-line-clamp: 3;
            }

            .multiline-ellipsis1 {
                -webkit-line-clamp: 2;
            }
        }

        .ad-image-count {
            display: none
        }

        .area-bottom {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            justify-content:center
        }

        .area-bottom span {
            margin: 0 5px;
            padding: 2px 4px;
            color: black;
            display: block;
            border-radius: 5px;
        }

        .area-bottom span a {
            color: black;
            font-weight: 600;
            margin: 5px 0;
        }

        .area-bottom span:nth-child(even) {
            background-color: dodgerblue;
        }

        .area-bottom span:nth-child(odd) {
            background-color: #B81261;

        }

        .area-bottom span:nth-child(odd) a {
            color: white;
        }
    </style>
</head>

<body class="body-no-scroll" onload="checkCookie()">

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
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" href="<?= get_url() . strtolower($_GET['cat']) ?>" itemprop="item" class="crumb">
                            <div class="skokra-breadcrumb" itemprop="name">Independent <?= ucwords(str_replace('-', ' ', $_GET['cat'])) ?></div>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                    <?php if (isset($_GET['cty'])) {
                        if (Get_User_Details::checkifitsastateorcity($_GET['cty'])) { ?>

                            <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                            <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb" href="<?= get_url() . strtolower($_GET['cat'] . '/' . str_replace(' ', '-', Get_User_Details::getStateByCity($_GET['cty']))) ?>" title="">
                                    <div class="skokra-breadcrumb" itemprop="name"><?= ucwords(str_replace('-', ' ', Get_User_Details::getStateByCity($_GET['cty']))) ?></div>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        <?php } ?>
                        <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                        <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb">
                                <div class="skokra-breadcrumb" itemprop="name"><?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></div>
                            </a>
                            <meta itemprop="position" content="4">
                        </li>
                    <?php  } ?>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <?php // if(isset($_GET['q'])){echo 'Result for : '.$_GET['q'] ; }else{ echo $_GET['s']; } 
        ?>
        <h1><?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>
            <?= ucwords(str_replace('-', ' ', $_GET['cat'])) ?>
            | <?= ucwords(str_replace('-', ' ', $_GET['cat'])) ?>
            in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> 24/7</h1>

        

        <p style="font-weight: 600;">SUPERTOP STORIES</p>
        <div class="stories-container">
            <?php

            if (count($superrows) != 0) {
                foreach ($superrows as $rows) {
                    foreach ($rows as $row) { ?>
                        <?php if ($row['preview_image'] == null) { ?><?php } else {
                                                                        $imageData =  @fopen($row['preview_image'], 'r');
                                                                        if ($imageData !== false) { ?>
                        <div class="story-items" onclick="showStory('<?= $row['post_id'] ?>')">
                            <img src="<?= $row['preview_image'] ?>" loading="lazy" width='100%' height='100%' alt="">
                            <div>
                                <p><?= $row['title'] ?></p>
                            </div>
                        </div>
    <?php }
                                                                    }
                                                                }
                                                            }
                                                        } ?>
        </div>
        <div class="current-date" style="margin-top: 2%;"><small><?php echo strtoupper(date('d F')) ?></small></div>
    </div>
    <div class="container">
    <h2 style="text-align: center;">
            Latest Profiles Posted by <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls
        </h2>
        <?php
        if (count($superrows) != 0) {
            foreach ($superrows as $rows) {
                foreach ($rows as $row) {
                    // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                    $url = preg_replace($pattern, '', $row['title']);
                    $url = remove_emoji($url);
                    $url = str_replace(' ', '-', $url);
                    $url = 'ad/' . $url . '/?x=0723' . $row['post_id'];

        ?>

                    <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                        <?php if ($row['preview_image'] == null) { ?><?php } else {
                                                                        $imageData =  @fopen($row['preview_image'], 'r');
                                                                        if ($imageData !== false) { ?><div class="ad-image-block">
                            <?php if ($row['preview_image'] != null) {
                                                                                $imageData2 =  @fopen($row['preview_image'], 'r');
                                                                                if ($imageData2 !== false) { ?> <img src="<?= $row['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                                                                    } ?>
                            <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($row['images'], true)) ?></div>
                        </div><?php }
                                                                    } ?>
                <div class="ad-detail-block" style="<?php if ($row['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                $imageData =  @fopen($row['preview_image'], 'r');
                                                                                                                if ($imageData === false) { ?>width:100%; <?php }
                                                                                                                                                    } ?>">
                    <div class="ad-detail-category">
                        <div class="ad-tags"><i class="ri-share-forward-fill"></i><?php if ($row['supertop_ad'] == 1) {
                                                                                        echo 'Ultra Premium';
                                                                                    } else {
                                                                                        echo 'Premium';
                                                                                    } ?></div>
                    </div>
                    <div class="ad-details">
                        <div class="skokra-ad-title multiline-ellipsis1"><a href="<?= get_url() . strtolower($url) ?>"><?= $row['title'] ?></a></div>
                        <p class="multiline-ellipsis"><?= $row['description'] ?></p>
                        <div class="about-ad">
                            <div class="about-ad-detail">
                                <p><?= $row['age'] ?> years</p>
                                <p><?php if (!empty($row['services'])) {
                                        $serv = json_decode($row['services'], true);
                                        echo $serv[0];
                                    } ?></p>
                                <p><?php if (!empty($row['address'])) { ?>
                                <p><?= $row['address'] . ', ' ?></p> <?php } ?> <?php if (isset($row['city'])) { ?><p><?= ucwords($row['city']) ?></p> <?php } ?></p>
                            </div>
                        </div>
                        <div class="ad-price-and-category about-ad-detail">
                            <?php if (isset($row['city'])) { ?><p><?php $cat = explode('-', $row['category']);
                                                                    $cat2 = '';
                                                                    for ($i = 0; $i < count($cat); $i++) {
                                                                        if ($i == (count($cat) - 1)) {
                                                                            $cat2 .= ucwords($cat[$i]);
                                                                        } else {
                                                                            $cat2 .= ucwords($cat[$i]) . ' ';
                                                                        }
                                                                    };
                                                                    echo $cat2 . ' in ' . ucwords($row['city']) ?></p> <?php } ?><?php if (!empty($row['price'])) { ?><p><?= 'From Rs. ' . $row['price'] ?></p> <?php } ?>
                        </div>
                    </div>
                    <div class="ad-contact-button">
                        <a href="tel:<?= $row['ad_phone_number'] ?>"><button>Call <?= $row['ad_phone_number'] ?></button></a>
                        <!-- <a href="https://wa.me/<?= $row['ad_phone_number'] ?>"><button>Whatsapp</button></a> -->
                    </div>
                </div>
                    </div>
        <?php }
            }
        } ?>
    </div>
    <div class="container topcss">
        <?php
        if (count($toprows) != 0) {
            foreach ($toprows as $toprows) {
                foreach ($toprows as $toprow) {
                    // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                    $url = preg_replace($pattern, '', $toprow['title']);
                    $url = remove_emoji($url);
                    $url = str_replace(' ', '-', $url);
                    $url = 'ad/' . $url . '/?x=0723' . $toprow['post_id'];
        ?>

                    <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                        <?php if ($toprow['preview_image'] == null) { ?><?php } else {
                                                                        $imageData =  @fopen($toprow['preview_image'], 'r');
                                                                        if ($imageData !== false) { ?><div class="ad-image-block">
                            <?php if ($toprow['preview_image'] != null) {
                                                                                $imageData2 =  @fopen($toprow['preview_image'], 'r');
                                                                                if ($imageData2 !== false) { ?> <img src="<?= $toprow['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                                                                    } ?>
                            <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($toprow['images']), true) ?></div>
                        </div><?php }
                                                                    } ?>
                <div class="ad-detail-block" style="<?php if ($toprow['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                $imageData =  @fopen($toprow['preview_image'], 'r');
                                                                                                                if ($imageData === false) { ?>width:100%; <?php }
                                                                                                                                                    } ?>">
                    <div class="ad-detail-category">
                        <div class="ad-tags"><i class="ri-share-forward-fill"></i><?php if ($toprow['supertop_ad'] == 1) {
                                                                                        echo 'Ultra Premium';
                                                                                    } else {
                                                                                        echo 'Premium';
                                                                                    } ?></div>
                    </div>
                    <div class="ad-details">
                        <div class="skokra-ad-title"><a href="<?= get_url() . strtolower($url) ?>"><?= $toprow['title'] ?></a></div>
                        <p class="multiline-ellipsis"><?= $toprow['description'] ?></p>
                        <div class="about-ad">
                            <div class="about-ad-detail">
                                <p><?= $toprow['age'] ?> years</p>
                                <p><?php if (!empty($toprow['services'])) {
                                        $serv = json_decode($toprow['services'], true);
                                        echo $serv[0];
                                    } ?></p>
                                <p><?php if (!empty($toprow['address'])) { ?>
                                <p><?= $toprow['address'] . ', ' ?></p> <?php } ?> <?php if (isset($toprow['city'])) { ?><p><?= ucwords($toprow['city']) ?></p> <?php } ?></p>
                            </div>
                        </div>
                        <div class="ad-price-and-category about-ad-detail">
                            <?php if (isset($toprow['city'])) { ?><p><?php $cat = explode('-', $toprow['category']);
                                                                        $cat2 = '';
                                                                        for ($i = 0; $i < count($cat); $i++) {
                                                                            if ($i == (count($cat) - 1)) {
                                                                                $cat2 .= ucwords($cat[$i]);
                                                                            } else {
                                                                                $cat2 .= ucwords($cat[$i]) . ' ';
                                                                            }
                                                                        };
                                                                        echo $cat2 . ' in ' . ucwords($toprow['city']) ?></p> <?php } ?><?php if (!empty($toprow['price'])) { ?><p><?= 'From Rs. ' . $toprow['price'] ?></p> <?php } ?>
                        </div>
                    </div>
                    <div class="ad-contact-button">
                        <a href="tel:<?= $toprow['ad_phone_number'] ?>"><button>Call <?= $toprow['ad_phone_number'] ?></button></a>
                        <!-- <a href="https://wa.me/<?= $toprow['ad_phone_number'] ?>"><button>Whatsapp</button></a> -->
                    </div>
                </div>
                    </div>
        <?php }
            }
        } ?>
    </div>
    <div class="container  topcss">
        <?php
        if (count($normalAds) != 0) {
            foreach ($normalAds[0] as $normalAd) {
                // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                $url = preg_replace($pattern, '', $normalAd['title']);
                $url = remove_emoji($url);
                $url = str_replace(' ', '-', $url);
                $url = 'ad/' . $url . '/?x=0723' . $normalAd['post_id'];
        ?>

                <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                    <?php if ($normalAd['preview_image'] == null) { ?><?php } else {
                                                                        $imageData = @fopen($normalAd['preview_image'], 'r');
                                                                        if ($imageData !== false) { ?><div class="ad-image-block">
                        <?php if ($normalAd['preview_image'] != null) {
                                                                                $imageData2 = @fopen($normalAd['preview_image'], 'r');
                                                                                if ($imageData2 !== false) { ?> <img src="<?= $normalAd['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                                                                        } ?>
                        <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($normalAd['images'], true)) ?></div>
                    </div><?php }
                                                                    } ?>
            <div class="ad-detail-block" style="<?php if ($normalAd['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                $imageData = @fopen($normalAd['preview_image'], 'r');
                                                                                                                if ($imageData === false) { ?>width:100%; <?php }
                                                                                                                                                    } ?>">
                <div class="ad-detail-category">
                    <!-- <div class="ad-tags"><i class="ri-share-forward-fill"></i><?php if ($normalAd['supertop_ad'] == 0) {
                                                                                        echo '';
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?></div> -->
                </div>
                <div class="ad-details">
                    <div class="skokra-ad-title"><a href="<?= get_url() . strtolower($url) ?>"><?= $normalAd['title'] ?></a></div>
                    <p class="multiline-ellipsis"><?= $normalAd['description'] ?></p>
                    <div class="about-ad">
                        <div class="about-ad-detail">
                            <p><?= $normalAd['age'] ?> years</p>
                            <p><?php if (!empty($normalAd['services'])) {
                                    $serv = json_decode($normalAd['services'], true);
                                    echo $serv[0];
                                } ?></p>
                            <p><?php if (!empty($normalAd['address'])) { ?>
                            <p><?= $normalAd['address'] . ', ' ?></p> <?php } ?> <?php if (isset($normalAd['city'])) { ?><p><?= ucwords($normalAd['city']) ?></p> <?php } ?></p>
                        </div>
                    </div>
                    <div class="ad-price-and-category about-ad-detail">
                        <?php if (isset($normalAd['city'])) { ?><p><?php $cat = explode('-', $normalAd['category']);
                                                                    $cat2 = '';
                                                                    for ($i = 0; $i < count($cat); $i++) {
                                                                        if ($i == (count($cat) - 1)) {
                                                                            $cat2 .= ucwords($cat[$i]);
                                                                        } else {
                                                                            $cat2 .= ucwords($cat[$i]) . ' ';
                                                                        }
                                                                    };
                                                                    echo $cat2 . ' in ' . ucwords($normalAd['city']) ?></p> <?php } ?><?php if (!empty($normalAd['price'])) { ?><p><?= 'From Rs. ' . $normalAd['price'] ?></p> <?php } ?>
                    </div>
                </div>
                <div class="ad-contact-button">
                    <a href="tel:<?= $normalAd['ad_phone_number'] ?>"><button>Call <?= $normalAd['ad_phone_number'] ?></button></a>
                    <!-- <a href="https://wa.me/<?= $normalAd['ad_phone_number'] ?>"><button>Whatsapp</button></a> -->
                </div>
            </div>
                </div>
        <?php }
        } ?>
    </div>
    <div class="container" style="text-align: center;">

        <h2>Best Call Girl Service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> | Skokra</h2>

        <p>Skokra is here to assist you in finding top-class call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> for your pleasure. We are available around the clock to ensure your moments are infused with romance. We offer independent, open-minded call girls who can gratify your desires. Our passionate and energetic female escorts in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> are striving to deliver pleasure. You can book female partners in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> 24/7 without being scammed by local <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> escort agencies.</p>

        <h3>Are you looking for sexual pleasure in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>?</h3>
        <p>Life offers many pleasures, but one of the best pleasures is having Call girls in your arms. If you are looking for the best call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>, Skokra is the perfect place to find a unique and stunning <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> escort that suits your interests. Explore a new level of intimacy with hot girls that ensures some unforgettable moments and fulfils your satisfaction. No what the place is, whether it's your place or any hotel, they always make you comfortable and fulfil your wishes to have sex.</p>

        <h3>Hire the best Independent <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Escorts in a few minutes.</h3>
        <p>Skokra escort directory offers an opportunity for you to connect with a reliable, genuine, and sophisticated escort in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. We enable you not only to get quality service but also to get rid of shady agencies that play tricks and keep you in the dark as we ensure complete transparency and safety. As opposed to most escort agencies in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> and brothels, our perspective is different, resulting in your convenience, safety, and satisfaction. Move to our platform, where luxury is paired with trust and decency. </p>

        <h2>100% Real <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girl Images with Phone Number</h2>
        <p>It is not easy to find a real and genuine escort service provider in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. Many imposters post fake images and their phone numbers at low rates as we are a huge escort directory that operates internationally. We have a support team who can help you in case of any fraud and false data or images.</p>

        <h3>Modern-Day Adult Services in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></h3>
        <p>aipur has a history of courtesans in our society who have now converted to modern-day escorts. <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> call girls run their businesses in a well-defined legal and professional environment. They basically provide their services to a broad range of customers, including businessmen, tourists, and locals who are in need of erotic companionship in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. This digital era allows online clients easier access to 200+ <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> call girl profiles with full discretion and privacy.</p>
        <p>
            The service is not limited to only adultery, fun, or intercourse. Sometimes, people need female companionship to attend events, private parties, movies, or deep conversations. </p>

        <h2>Types of Escorts available in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></h2>
        <p><?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> escorts can be classified into the following categories:</p>

        <h3>Independent call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> </h3>
        <p>Independent call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> refers to those who work independently, manage their own time, fix their meetings, rates, and sometimes advertise on our website or social media pages.</p>

        <h3>Agency Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></h3>
        <p><?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> escort agency call girls are the ones connected to an agency that takes care of the logistics, bookings, and interactions with the clients. These agencies may or may not be liable. So please agencies very wisely.</p>

        <h3>VIP Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> </h3>
        <p>VIP call girls specialize in high-class clients. Mostly, these girls are High-class models or TV actresses. Most of these high-class escorts serve VIP clients with their luxury experiences.</p>

        <h4>Escort Service Booking process in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></h4>
        <p>The clients or online website visitors have the option of 100+ escort profiles of different ages, ranging from <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> college call girls to mature housewife escorts in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. Bookings are usually done either by calling or WhatsApp chat with agencies or independent girls with full confidentiality.</p>
        <p>
            We are a premier yet budget-friendly escort service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. With nearly a great experience providing intimate services, our website offers some of the most alluring escorts in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> at a reasonable price. An unforgettable evening filled with enticing escorts is just a call away. Our best <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> call girls can fulfil your deepest desires and unquenched passions. You can easily indulge in sensual delights through our call-girl service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>.</p>

        <h3>Legal and Ethical Considerations in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Escort Service</h3>

        <p>Working together with reliable agencies or individuals who stay within the legal parameters is a key factor in ensuring safety and alignment. Our online platform is working as a classified site where these reliable agencies and independent escort can post their ad to get connected with genuine clients. Skokra is a web directory for many call girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> that emphasizes real and safe meetings.</p>

        <h2>Women seeking men in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></h2>
        <p>Are you a gentleman looking for some erotic fun? Are you looking for a female companion in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>? It doesn't matter whether you are married or unmarried. But if you are looking for genuine independent females in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> seeking men, then you come to the right website. Our platform can also find you female companions for long-term relationships rather than a one-night stand in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>. <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> is a city where you can't easily find someone to spend a passionate night with. No brokers, no agents, only genuine independent <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> call girls or housewives just at your phone call. </p>

        <h3>F&Q</h3>

        <p style="background-color:lightblue; width:fit-content;padding:0 5px;margin:auto"><strong>Is Skokra liable in terms of Discreet and confidentiality?</strong></p>
        <p>Our website is a third-party platform to meet advertisers (Independent call girls) and online visitors (Clients). We never disclose any private information to anyone. We don't save browsing history, IP address, Personal Details, etc. We also request our clients to discreetly share their information with independent escorts. </p>

        <p style="background-color:lightblue; width:fit-content;padding:0 5px;margin:auto"><strong>What payment method do you accept?</strong></p>
        <p>As a classified website, we don't charge any money from the client's end. If you need to pay to escort, make sure you spend face to face. Do not pay anything for the sake of advance.</p>

        <!-- Tags -->
        <div class="" style="margin:5px 0 10px 0">
                <h3 class="text-dark"><i class="fas fa-tags"></i> Tags</h3>
                <div class="area-bottom">
                    <span class="label label-default"> <a href="#">Call Girls girl in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> call girls Call Girl
                            service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls Locanto</a> </span>
                    <span class="label label-danger"> <a href="#"> call girls
                            Call Girl service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> sex Call Girls</a> </span>
                    <span class="label label-success"> <a href="#"> Call Girls at <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls girl</a> </span>
                    <span class="label label-danger"> <a href="#"> Call Girl girl</a> </span>
                    <span class="label label-default"> <a href="#"> call girl service
                            <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> female Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-success"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> sex girl</a> </span>
                    <span class="label label-info"> <a href="#"> Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> Call Girls services <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> female Call Girls</a> </span>
                    <span class="label label-default"> <a href="#"> housewife Call Girls
                            in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> call girls number</a> </span>
                    <span class="label label-success"> <a href="#"> Call Girls girls in
                            <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls service</a> </span>
                    <span class="label label-warning"> <a href="#"> model Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls services</a> </span>
                    <span class="label label-default"> <a href="#"> Call Girls service <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> Russian Call Girls
                            in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-success"> <a href="#"> call girls near me</a>
                    </span>
                    <span class="label label-danger"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls</a> </span>
                    <span class="label label-default"> <a href="#"> royal Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> independent Call Girls</a> </span>
                    <span class="label label-success"> <a href="#"> cheap <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls</a> </span>
                    <span class="label label-info"> <a href="#"> Call Girls girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> independent <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls</a> </span>
                    <span class="label label-danger"> <a href="#"> foreign Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> cheap female Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                    <span class="label label-primary"> <a href="#"> royal Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> hotel Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls girls</a> </span>
                    <span class="label label-danger"> <a href="#"> female Call Girl <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> sex Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> Call Girl service near me</a> </span>
                    <span class="label label-success"> <a href="#"> call girls</a> </span>
                    <span class="label label-info"> <a href="#"> Russian Call Girls
                            <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> independent Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> cheap Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> model Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> Call Girls service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-success"> <a href="#"> Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> female Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> Call Girls services in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> VIP Call Girls</a> </span>
                    <span class="label label-primary"> <a href="#"> call girl near me</a>
                    </span>
                    <span class="label label-success"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> sex</a> </span>
                    <span class="label label-info"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> call girl
                            number</a> </span>
                    <span class="label label-default"> <a href="#"> independent Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> cheap Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-success"> <a href="#"> girls Call Girl <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                    <span class="label label-warning"> <a href="#"> call girls
                            Call Girls service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> Call Girls service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> independent call
                            girls</a> </span>
                    <span class="label label-success"> <a href="#"> VIP Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> model Call Girls</a> </span>
                    <span class="label label-danger"> <a href="#"> female Call Girls of <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-default"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girl agency</a> </span>
                    <span class="label label-primary"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girl service</a> </span>
                    <span class="label label-warning"> <a href="#"> call girls Call Girl
                            service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Russian
                            Call Girls</a> </span>
                    <span class="label label-primary"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?>i sex video</a> </span>
                    <span class="label label-success"> <a href="#"> call girl number</a>
                    </span>
                    <span class="label label-info"> <a href="#"> call girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                    <span class="label label-warning"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls agency</a> </span>
                    <span class="label label-danger"> <a href="#"> call girls Call Girl
                            service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-primary"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> sex</a> </span>
                    <span class="label label-success"> <a href="#"> call girl contact number</a>
                    </span>
                    <span class="label label-info"> <a href="#"> sexy Call Girls call girls in
                            <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-warning"> <a href="#"> <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?> Call Girls</a> </span>
                    <span class="label label-danger"> <a href="#"> कॉल गर्ल लिस्ट <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                    <span class="label label-success"> <a href="#"> call girls Call Girl
                            service in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-info"> <a href="#"> call girl in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                    <span class="label label-warning"> <a href="#"> best Call Girls in <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a> </span>
                    <span class="label label-danger"> <a href="#"> Call Girls <?= ucwords(str_replace('-', ' ', $_GET['cty'])) ?></a>
                    </span>
                </div>
        </div>
        <!-- Tags -->


    </div>
    <div class="container list-of-cities-container">
        <strong>Call Girls</strong>

        <div class="list-of-cities">
            <a href="<?= get_url() ?>call-girls/uttar-pradesh/kanpur/">Kanpur</a>
            <a href="<?= get_url() ?>call-girls/delhi/delhi/">Delhi</a>
            <a href="<?= get_url() ?>call-girls/uttar-pradesh/agra/">Agra</a>
            <a href="<?= get_url() ?>call-girls/rajasthan/jaipur/">Jaipur</a>
            <a href="<?= get_url() ?>call-girls/goa/goa/">Goa</a>
            <a href="<?= get_url() ?>call-girls/maharashtra/mumbai/">Mumbai</a>
            <a href="<?= get_url() ?>call-girls/maharashtra/pune/">Pune</a>
            <a href="<?= get_url() ?>call-girls/tamil-nadu/chennai/">Chennai</a>
            <a href="<?= get_url() ?>call-girls/uttar-pradesh/lucknow/">Lucknow</a>
            <a href="<?= get_url() ?>call-girls/uttar-pradesh/noida/">Noida</a>
            <a href="<?= get_url() ?>call-girls/haryana/gurugram/">Gurugram</a>
            <a href="<?= get_url() ?>call-girls/bihar/patna/">Patna</a>
            <a href="<?= get_url() ?>call-girls/uttar-pradesh/varanasi/">Varanasi</a>
        </div>

    </div>
    <!-- <div class="container service-category">
        <a href="<?= get_url() ?>call-girls">Call Girls</a>
    </div>
    <div class="container service-category">
        <a href="<?= get_url() ?>massages">Massages</a>
    </div>
    <div class="container service-category">
        <a href="<?= get_url() ?>male-escorts">Male Escorts</a>
    </div>
    <div class="container service-category">
        <a href="<?= get_url() ?>transsexual">Transsexual</a>
    </div> -->


    <div class="story" id="story">
        <div class="story-div">
            <div class="close_the_story" onclick="close_the_story()">X</div>
            <div class="story-info">
                <div class="story-title">
                </div>
                <div class="story-services">
                </div>
            </div>
            <div class="story-indecator">
            </div>
            <div class="story-img-div">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="border:2px solid lightgrey; padding:10px 5px; border-radius:5px;margin:2% auto ">
        <p><strong>Skokra.com doesn't intervene between pleasure seeker<sup>1</sup> and Advertisers<sup>2</sup></strong></p>
        <small>By accessing our website and using our adult escort classified ads, the online visitor accepts our terms and conditions.
            The adult classified ads are posted by a third person; we are not responsible for the content and images posted by them. Posting content and images consents to their having the right to use them on our website. Skokra is a free classified website that also follows the moral rules of society. We forbid any child pornography on our website. Skokra is also not responsible for any monetary transactions between the pleasure seeker and advertisers. <br><br>
            <b>1</b> Please seeker is an online visitor who visits our website for real fun. They take a number of desired independent girls or escort agencies and contact them. <br>
            <b>2</b> Advertiser is defined as an ad publisher/ independent girl/ escort agency who posts their ad on our website to seek genuine clients.</small>
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            cssMode: true,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
            mousewheel: true,
            keyboard: true,
        });
    </script>
    <script>
        const ad_blockdd = document.querySelectorAll('.ad-blockdd');
        ad_blockdd.forEach((ad, i) => {
            ad.addEventListener('click', () => {
                url = ad_blockdd[i].getAttribute('data-href')
                window.location.href = url;
            })
        })

        function showStory(id) {
            const story = new FormData();
            story.append("storyId", id);
            story.append("activity", 'story');
            fetch('<?= get_url() ?>u/activity-center', {
                    method: 'POST',
                    body: story
                }).then(res => res.json())
                .then(data => {
                    document.querySelector('.story').style.display = 'flex'
                    document.querySelector('.story-title').innerHTML = '<p>' + data['title'] + '</p>'
                    document.querySelector('.story-services').innerHTML = '<div>' + data['age'] + ' Years</div><div style=" text-transform: capitalize;">' + data['city'] + ', ' + data['state'] + '</div><div>' + JSON.parse(data['services'])[0] + '</div>';
                    images = JSON.parse(data['images']);
                    im = '';
                    images.forEach((img, i) => {
                        im += '<div class="swiper-slide"><img src="https://cdn.skokra.com/secure-images/' + img + '" width="100%" height="100%" alt="Skokra Calll girls ad Agency"></div>'
                        if (i == 3) {
                            return true;
                        }
                    })
                    document.querySelector('.swiper-wrapper').innerHTML = im

                })
        }

        function close_the_story() {
            document.querySelector('.story').style.display = 'none'
        }
    </script>

</body>

</html>