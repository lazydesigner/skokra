<?php

session_start();
$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';


$rows = Get_User_Details::Get_states_detail()[0];

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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
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

        .container h1 {
            font-size: 1.2rem;
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

        .city-block {
            width: 100%;
            height: auto;
            padding: 2%;
            border-radius: 10px;
            margin: 5% 0 0 0;
            box-shadow: 0 0 10px -1px var(--header-color);
        }

        .city-name {
            border-top: 1px solid var(--header-color);
            padding: 1% 0;
            margin: 1% 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1%;
        }
        .city-name div{margin: .5% 0;color:#36454F;}
        .city-name div a{color:#36454F;padding: 10px 15px;display: block;}
        .city-name div:hover{color: white!important;background-color: var(--header-color);cursor: pointer;border-radius: 5px;}
        .city-name div a:hover{color: white}
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
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" href="<?= get_url() . 'call-girls' ?>" itemprop="item" class="crumb">
                            <div class="skokra-breadcrumb" itemprop="name">Independent Call Girls</div>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>

                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <?php // if(isset($_GET['q'])){echo 'Result for : '.$_GET['q'] ; }else{ echo $_GET['s']; } 
        ?>
        <h1>Independent Call Girls</h1>


        <?php

        foreach ($rows as $row) { ?>
        <div class="city-block">
                    <strong><?= $row['state'] ?></strong>
                    <div class="city-name">
        <?php
            foreach (json_decode($row['cities']) as $city) { ?>

                
                    
                        <div><a href="<?=get_url().'call-girls/'.strtolower(str_replace(' ','-',$city)) ?>"><?= ucwords($city) ?></a></div>
                   
             

        <?php } ?>  </div>  </div><?php  } ?>
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


    <script>
        const ad_blockdd = document.querySelectorAll('.ad-blockdd');
        ad_blockdd.forEach((ad, i) => {
            ad.addEventListener('click', () => {
                url = ad_blockdd[i].getAttribute('data-href')
                window.location.href = url;
            })

        })
    </script>

</body>

</html>