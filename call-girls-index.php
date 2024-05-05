<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


$cat_array = ['transsexual', 'adult-meeting', 'massage', 'male-escorts', 'call-girls', 'dating'];
if (in_array($_GET['cat'], $cat_array)) {
} else {
    header("Location: " . get_url() . "");
}


session_start();
$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';

$superrows = Get_User_Details::Show_Super_Top_Ads();


$toprows = Get_User_Details::Show_Top_Ads();

if (Get_User_Details::checkifitsastateorcity($_GET['cty'])) {
    $normalAds = Get_User_Details::Show_Ads($_GET['cty']);
} else {
    $normalAds = Get_User_Details::Show_Ads(ucwords(str_replace('-', ' ', $_GET['cty'])));
}


$pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';


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
            $cityofcity .= '<option value="' . strtolower($ct) . '" selected>' . ucwords($ct) . '</option>';
        } else {
            $cityofcity .= '<option value="' . strtolower($ct) . '">' . ucwords($ct) . '</option>';
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
    <meta name="description" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" defer>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" async/>

    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" async>
    <title>Document</title>
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

        .container h1 {
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
        <h1>Independent Indian <?= ucwords(str_replace('-', ' ', $_GET['cat'])) ?></h1>

        <p style="font-weight: 600;">SUPERTOP STORIES</p>
        <div class="stories-container">
            <?php

            if (count($superrows) != 0) {
                foreach ($superrows as $rows) {
                    foreach ($rows as $row) { ?>
                        <?php if ($row['preview_image'] == null) { ?><?php } else {
                                                                        $imageData = @getimagesize($row['preview_image']);
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
        <?php
        if (count($superrows) != 0) {
            foreach ($superrows as $rows) {
                foreach ($rows as $row) {
                    // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                    $url = preg_replace($pattern, '', $row['title']);
                    $url = str_replace(' ', '-', $url);
                    $url = 'ad/' . $url . '/?x=0723' . $row['post_id'];

        ?>

                    <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                        <?php if ($row['preview_image'] == null) { ?><?php } else {
                                                                        $imageData = @getimagesize($row['preview_image']);
                                                                        if ($imageData !== false) { ?><div class="ad-image-block">
                            <?php if ($row['preview_image'] != null) {
                                                                                $imageData2 = @getimagesize($row['preview_image']);
                                                                                if ($imageData2 !== false) { ?> <img src="<?= $row['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                    } ?>
                            <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($row['images'], true)) ?></div>
                        </div><?php }
                                                                    } ?>
                <div class="ad-detail-block" style="<?php if ($row['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                $imageData = @getimagesize($row['preview_image']);
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
                foreach($toprows as $toprow){
                // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                $url = preg_replace($pattern, '', $toprow['title']);
                $url = str_replace(' ', '-', $url);
                $url = 'ad/' . $url . '/?x=0723' . $toprow['post_id'];
        ?>

                <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                    <?php if ($toprow['preview_image'] == null) { ?><?php } else {
                                                                    $imageData = @getimagesize($toprow['preview_image']);
                                                                    if ($imageData !== false) { ?><div class="ad-image-block">
                        <?php if ($toprow['preview_image'] != null) {
                                                                            $imageData2 = @getimagesize($toprow['preview_image']);
                                                                            if ($imageData2 !== false) { ?> <img src="<?= $toprow['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                        } ?>
                        <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($toprow['images']), true) ?></div>
                    </div><?php }
                                                                } ?>
            <div class="ad-detail-block" style="<?php if ($toprow['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                            $imageData = @getimagesize($toprow['preview_image']);
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
        <?php }}
        } ?>
    </div>
    <div class="container  topcss">
        <?php
        if (count($normalAds) != 0) {
            foreach ($normalAds[0] as $normalAd) {
                // $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
                $url = preg_replace($pattern, '', $normalAd['title']);
                $url = str_replace(' ', '-', $url);
                $url = 'ad/' . $url . '/?x=0723' . $normalAd['post_id'];
        ?>

                <div class="ad-blockdd" data-href='<?= get_url() . strtolower($url) ?>'>
                    <?php if ($normalAd['preview_image'] == null) { ?><?php } else {
                                                                        $imageData = @getimagesize($normalAd['preview_image']);
                                                                        if ($imageData !== false) { ?><div class="ad-image-block">
                        <?php if ($normalAd['preview_image'] != null) {
                                                                                $imageData2 = @getimagesize($normalAd['preview_image']);
                                                                                if ($imageData2 !== false) { ?> <img src="<?= $normalAd['preview_image'] ?>" loading="lazy" width="100%" height="100%" alt=""><?php }
                                                                                                                                                            } ?>
                        <div class="ad-image-count"><i class="ri-camera-3-line"></i><?= count(json_decode($normalAd['images'], true)) ?></div>
                    </div><?php }
                                                                    } ?>
            <div class="ad-detail-block" style="<?php if ($normalAd['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                $imageData = @getimagesize($normalAd['preview_image']);
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
    <div class="container list-of-cities-container">
        <strong>Call Girls</strong>

        <div class="list-of-cities">
            <a href="<?= get_url() ?>call-girls/kanpur">Kanpur</a>
            <a href="<?= get_url() ?>call-girls/delhi">Delhi</a>
            <a href="<?= get_url() ?>call-girls/agra">Agra</a>
            <a href="<?= get_url() ?>call-girls/jaipur">Jaipur</a>
            <a href="<?= get_url() ?>call-girls/goa">Goa</a>
            <a href="<?= get_url() ?>call-girls/mumbai">Mumbai</a>
            <a href="<?= get_url() ?>call-girls/pune">Pune</a>
            <a href="<?= get_url() ?>call-girls/chennai">Chennai</a>
            <a href="<?= get_url() ?>call-girls/lucknow">Lucknow</a>
            <a href="<?= get_url() ?>call-girls/noida">Noida</a>
            <a href="<?= get_url() ?>call-girls/gurugram">Gurugram</a>
            <a href="<?= get_url() ?>call-girls/patna">Patna</a>
            <a href="<?= get_url() ?>call-girls/varanasi">Varanasi</a>
        </div>

    </div>
    <div class="container service-category">
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
    </div>


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