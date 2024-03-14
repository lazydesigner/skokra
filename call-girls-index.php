<?php 
session_start();
$login_page = 'yes';
include './routes.php' ?>
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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Document</title>
    <style>
        .page-detail-and-information ol li{
            /* border: 1px solid var(--header-color); */
        }
        .page-detail-and-information .skokra-breadcrumb{
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
        .stories-container{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container h1{
            font-size: 1.2rem;
        }
        .story-items{
            width: 10%;
            height: 160px;
            background-color: lightblue;
            border-radius: 5px;
            overflow: hidden;
            display: grid;
            position: relative;
        }
        .story-items > div{
            width: 95%;
            height: fit-content;
            position: absolute;
            /* background-color: red; */
            bottom: 0;
            left: 2%;
        }
        .story-items p{
            width: 100%;
            text-wrap: nowrap;
            text-overflow: ellipsis;
            align-self:last baseline;
            z-index: 1;
            margin:2% 0;
        }
        .current-date{
            margin-bottom: 3%;
        }
        .ad-blockdd{
            margin-top: 2%;
            width: 100%;
            height: 300px;
            display: flex;
            background-color: whitesmoke;
            border: 1px solid var(--header-color);
            border-radius: 10px;
            overflow: hidden;
        }
        .ad-image-block{
            width: 17%;
            height: 100%;
            position: relative;
            background-color: lightblue;
        }
        .ad-image-count{
            position: absolute;
            width: 50px;
            height: 20px;
            background-color: rgba(0,0,0,.4);
            color:white;
            bottom: 1%;
            left: 2%;
            z-index: 1;
            border-radius: 5px;
            text-align: center;
        }
        .ad-detail-block{
            width: 83%;
            /* width: 100%; */
            height: 100%;
            padding: 1%;
        }
        .ad-details p{font-size: 1.1rem;line-height: 25px;}
        .ad-details{
            padding: .5% 1%;
        }
        .skokra-ad-title{
            font-weight: bold;
            font-size: 1.4rem;
        }
        .ad-detail-category{
            width: 100%;
            height: auto;
            display: grid;
            justify-content: end;
        }
        .ad-tags{
            width:  max-content;
            height: max-content;
            padding: .5% 2%;
            border-radius: 100px;
            display: flex;
            align-items: center;
            /* justify-content: end; */
            background-color: var(--header-color);
            color: white;
            font-size: small;
        }
        .ad-tags i{transform: rotate(-90deg);font-size: 1.2rem;}
        .ad-contact-button{
            width: 100%;
            padding: 0 1%;
            margin: 2% 0;
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 1%;
        }
        .about-ad-detail{
            display: flex;
            align-items: center;
            gap: 1%;
        }
        .about-ad-detail p{
            width: fit-content;
            padding: 0 1%;
            border-radius: 10px;
            background-color: lightblue;
            margin:.5% 0;
            font-size: small;
        }
        .ad-contact-button button{
            width: 60px;
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
        .service-category{
            text-align: center;
            padding: 1.5% 0;
            margin: 2% auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 12px 6px #F8F8FF;
            font-size: 1.3rem;
            font-weight: 500;
        }
        .service-category:hover a{
            color:var(--header-color)
        }

        .list-of-cities-container{
            margin-top: 2%;
            box-shadow: 0 0 12px 6px #F8F8FF;
            padding: 2%;
            text-align: center;
        }
        .list-of-cities-container strong{
            font-size: 1.5rem;
            text-align: center;
        }
        .list-of-cities{
            width: 100%;
            height: auto;
            padding: 2% 4%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .list-of-cities a{
            width: fit-content;
            margin: .5% 1%;
            padding: 1% 2%;
            border-radius: 30px;
            border: 1px solid var(--header-color);
        }
        .list-of-cities a:hover{
            box-shadow: 0 0 6px 3px #F8F8FF;background-color: #F8F8FF;
        }
    </style>
</head>

<body>
    <?php include './common-header.php' ?>
    <div class="container">
        <div class="page-detail-and-information" aria-label="">
            <div id="breadcrumbs">
                <ol style="display: flex;align-items:center;gap:.5%;list-style:none;padding:0" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" title="Genuine Call girls &amp; escorts Service: Photos, Phone number | Skoka" class="crumb" href="<?= get_url() ?>"><div class="skokra-breadcrumb" itemprop="name"><i class="ri-home-4-line">
                                    <span style="display: none;">Skokra India </span>
                                </i></div></a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb" href="<?= get_url() ?>" title=""><div class="skokra-breadcrumb" itemprop="name">state</div></a>
                        <meta itemprop="position" content="2">
                    </li>
                    <li><b><i class="ri-arrow-right-s-line"></i></b></li>
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" class="crumb"><div class="skokra-breadcrumb" itemprop="name">city</div></a>
                        <meta itemprop="position" content="3">
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Independent Indian Call Girls - India Escorts</h1>

        <p style="font-weight: 600;">SUPERTOP STORIES</p>
        <div class="stories-container">
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="story-items">
                <div>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
        </div>
        <div class="current-date"><small><?php echo strtoupper(date('d F')) ?></small></div>
    </div>
    <div class="container">
        <div class="ad-blockdd">
            <div class="ad-image-block">
                <div class="ad-image-count"><i class="ri-camera-3-line"></i>3</div>
            </div>
            <div class="ad-detail-block">
                <div class="ad-detail-category">
                    <div class="ad-tags"><i class="ri-share-forward-fill"></i> Super Top</div>
                </div>
                <div class="ad-details">
                    <div class="skokra-ad-title">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis recusandae?</div>
                    <p class="multiline-ellipsis">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur ipsa quisquam nemo eum quaerat facilis saepe! Corporis, omnis? Fuga consequatur itaque odit quam, non ad.</p>
                    <div class="about-ad">
                        <div class="about-ad-detail">
                            <p>25 years</p><p>Experience</p><p>Rawatpur, kanpur</p>
                        </div>
                    </div>
                    <div class="ad-price-and-category about-ad-detail">
                        <p>call girls in kanpur</p><p>Rs 2000</p>
                    </div>
                </div>
                <div class="ad-contact-button">
                    <button>call</button>
                    <button>Whats</button>
                </div>
            </div>
        </div>
        <div class="ad-blockdd">
            <?php if(isset($image)){ ?><div class="ad-image-block">
                <div class="ad-image-count"><i class="ri-camera-3-line"></i>3</div>
            </div><?php }?>
            <div class="ad-detail-block" <?php if(!isset($image)){ ?>style="width:100%" <?php }?>>
                <div class="ad-detail-category">
                    <div class="ad-tags"><i class="ri-share-forward-fill"></i> Super Top</div>
                </div>
                <div class="ad-details">
                    <div class="skokra-ad-title">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis recusandae?</div>
                    <p class="multiline-ellipsis">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur ipsa quisquam nemo eum quaerat facilis saepe! Corporis, omnis? Fuga consequatur itaque odit quam, non ad.</p>
                    <div class="about-ad">
                        <div class="about-ad-detail">
                            <p>25 years</p><p>Experience</p><p>Rawatpur, kanpur</p>
                        </div>
                    </div>
                    <div class="ad-price-and-category about-ad-detail">
                        <p>call girls in kanpur</p><p>Rs 2000</p>
                    </div>
                </div>
                <div class="ad-contact-button">
                    <button>call</button>
                    <button>Whats</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container list-of-cities-container">
        <strong>Call Girls</strong>

        <div class="list-of-cities">
            <a href="">Kanpur</a>
            <a href="">Delhi</a>
            <a href="">Agra</a>
            <a href="">Jaipur</a>
            <a href="">Goa</a>
            <a href="">Mumbai</a>
            <a href="">Pune</a>
            <a href="">Chennai</a>
            <a href="">Lucknow</a>
            <a href="">Noida</a>
            <a href="">Gurugram</a>
            <a href="">Patna</a>
            <a href="">Varanasi</a>
        </div>

    </div>
    <div class="container service-category">
        <a href="">Call Girls</a>
    </div>
    <div class="container service-category">
        <a href="">Massages</a>
    </div>
    <div class="container service-category">
        <a href="">Male Escorts</a>
    </div>
    <div class="container service-category">
        <a href="">Transsexual</a>
    </div>
    <?php include './footer.php' ?>

</body>

</html>