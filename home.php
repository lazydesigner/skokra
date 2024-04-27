<?php 
session_start();
$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/home.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Skokra - Manage your ads</title>
</head>

<body>
    <?php include './common-header.php' ?>
    
    <div class="container main-content">
        <h1 class="main-heading">Lorem ipsum dolor sit amet.</h1>
        <p class="sub"><strong>lorem ipsum dolor</strong></p>

        <div class="services-cards">
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i> Call Girls</div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/massage-2768833_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name">
                        <div><img src="./assets/images/icons8-massage-30.png" width="100%" height="100%" alt=""> </div> Massage
                    </div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i> Male Escorts</div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i> Transsexual</div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i>Dating</div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
            <div class="service-card-1">
                <div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i>Video Chat </div>
                </div>
                <div class="service-card-p">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit quisquam maxime sequi cumque deleniti temporibus blanditiis quo similique minus consequuntur quis veritatis, fugit et
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                        <li><a href="<?=get_url() ?>">lorem ipsum</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <p class="infornation-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo tempora, corrupti vitae provident asperiores incidunt alias corporis id aliquid, officiis, quia illo magni ab error? Neque natus ipsam praesentium ipsum cumque minus aliquid dolor inventore atque quaerat? Enim fuga eius eaque magni quidem, nisi culpa in aliquam reprehenderit nam consequuntur? Consequuntur ipsam ducimus corporis qui totam unde sint soluta labore sed hic commodi non rerum cumque delectus voluptatum eius, inventore recusandae et nostrum. Ab nisi molestiae dolorem, eaque cumque odio quia accusantium laborum ullam quidem quaerat facilis quo quod nobis a soluta est! At recusandae architecto aperiam voluptas sint autem.</p>

   

    <div class="section-for-add">
        <h3>Search ads in India</h3>

        <div class="call-girls-section">
            <strong>Call Girls</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>call-girls/bangalore/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>call-girls/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>call-girls/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>call-girls/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>call-girls/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Massage</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>massage/bangalore/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>massage/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>massage/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>massage/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>massage/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Male Escorts</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>male-escorts/bangalore/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>male-escorts/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>male-escorts/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>male-escorts/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>male-escorts/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Transsexual</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>transsexual/bangalore/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>transsexual/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>transsexual/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>transsexual/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>transsexual/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Dating</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>dating/bangalore/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>dating/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>dating/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>dating/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>dating/mumbai/"><button>Mumbai</button></a>
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
<script src="<?=get_url() ?>assets/js/common.js" defer></script>

</body>

</html>