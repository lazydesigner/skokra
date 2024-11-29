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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" defer>
    <title>Skokra - Manage your ads</title>

    <style>
        .service-card-1{
            display: flex;
            width: 50%;
        }
        @media (max-width:650px){
           
        .service-card-1{
            display: flex;
            width: 100%;
        }
        .service-card-img-name{
            font-size: 1rem;
            height: 30px;
            line-height: 30px;
        }
        }
    </style>
</head>

<body>
    <?php include './common-header.php' ?>
    
    <div class="container main-content">
        <h1 class="main-heading">Connect with Hot Advertisers or Post Your Adult Ads Now!</h1>
        <!-- <p class="sub"><strong>lorem ipsum dolor</strong></p> -->

        <div class="services-cards">
            <div class="service-card-1">
                <div style="width: 50%;"><div class="service-card-img">
                    <img src="./assets/images/woman-2219964_640.jpg" width="100%" height="100%" alt="">
                    <div class="service-card-img-name"><i class="ri-empathize-fill"></i> Call Girls</div>
                </div></div>
                <div style="width: 50%;padding:2%"><div class="service-card-p">
                    Find the Girl Who Matches Your Energy and Makes You Feel Amazing and Stress-Free!
                </div>
                <div class="service-cities">
                    <ul>
                        <li><a href="<?=get_url() ?>call-girls/delhi">Delhi</a></li>
                        <li><a href="<?=get_url() ?>call-girls/lucknow">Lucknow</a></li>
                        <li><a href="<?=get_url() ?>call-girls/bengaluru/">Bengaluru</a></li>
                    </ul>
                </div></div>
            </div>
            <!-- <div class="service-card-1">
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
            </div> -->
        </div>

        <p class="infornation-text2">Skokra is an online platform for call girls of an unmatched calibre from all over India. Our website gives chances to our online visitors to meet some beautiful females around them and the option to customize their erotic journey. Get a taste of luxury life with independent female call girls while staying in Fancy hotels or private resorts.</p>
        
        <p class="infornation-text2">Our beautiful call girls are dedicated to delivering exceptional customer care and ensuring every client is delighted. Our escorts are carefully selected to give the best option of service delivery from all around the world so customers can enjoy tailor-made experiences that suit their preferences. Irrespective of the fact that you are looking for a date night or an adventure tour, our call girls are the ones who will make your imagination soar. We have a grand selection of India's best female companion models that you can explore and pick that one companion that will make your occasion unforgettable.</p>

        <p class="infornation-text2">We are the ones who have the promise to give the best service of the highest quality and ensure that every encounter is a sweet moment. When searching for the ultimate escort service, look no further than Skokra.</p>

        <p class="infornation-text2">All our advertisers, whether they are an agency or independent call girls, need to put authentic contact details and real images. Our stunning escorts ensure that your intimate experiences are entirely satisfying and private. Moreover, we have independent, untouched Indian call girls who came up with door-to-door service. Bookings can be made through phone calls, emails, or WhatsApp.</p>

        <h2 style="color: var(--heading-color); text-align:center">Enjoy Independent escorts in India for pleasurable nights.</h2>
        <p class="infornation-text2">Independent escorts on Skokra not only spice up your nights but also give you a chance to explore the world of imagination and achieve your dreams. Our call girls create a friendly environment, which can promote relaxation for the client by providing gentle and empathetic touches. Our female staff can help you explore the most hidden sexual fantasies with the best independent escorts in India.</p>
        <p class="infornation-text2">Whether you are seeking gay escorts, couples, male companions, transgender individuals, or massage therapists for sensual massages, Skokra is your go-to destination for finding your ideal partner. All of our escorts are experienced and adept at ensuring your sexual satisfaction. You'll be treated like royalty in the bedroom. They possess the expertise to excite your senses and guide you through unforgettable experiences. Reach your peak pleasure with the services you've always fantasized about.</p>

        <p class="infornation-text2">The best part of our platform is that you can make good friends, create conversations, learn how they do in sex, and have fun differently. We have profiles from young local girls to curvy milfs. Russian escorts also publish their profiles on our website. Skokra is where you will get exactly what will slake your urge in a perfect way. If you want to get deeper into sensuality and the pleasure of sex, then we have escorts in every city where you can gallivant around.</p>

        <h2 style="color: var(--heading-color); text-align:center">How does our Skokra escort service operate?</h2>
        <p class="infornation-text2">Many people need to be made aware of the functioning of the Skokra escort service. There are independent call girls or escorts who post their Profile on our platform to get genuine clients for their erotic adult services. As you know, we are a genuine platform, so clients trust on Profile and contact them. We don't have any business between the client and an independent call girl as we are just an advertisement website, we earn by promoting Profile and earn revenue from ads and partnerships. We are not an escort website, and we have nothing to do with escort service as a broker or pimp. Our attractive girls spend time with the customers for tips or friendship. These are women who are skilled in making your dreams a reality; they fill the atmosphere with sparkling energy to make the best experience for everyone, and they are just much nicer people to be with than depression counselors. Each of the escorts we employ is subjected to a full background investigation and regular health tests.</p> 

        <p class="infornation-text2">Browse through our Escort Gallery to find your ideal companion, then contact us via call or WhatsApp. Coordinate an encounter with your perfect date whether you are organizing a gathering and need attractive women for your friends, business partners, boss, politician, client, etc. We have the staff you need for your event with a discount for three or more bookings.</p>

        <h3 style="color: var(--heading-color); text-align:center">What makes our escort agency better than other call girl services in India? </h3>
        <p class="infornation-text">There is more than one reason why Skokra.com is one of the most popular escort platforms in India. Our escorts provide quality service to their friends in every aspect and strive to be the best. That is why our customers love us.</p>

   

    <div class="section-for-add">
        <h3>Search ads in India</h3>

        <div class="call-girls-section">
            <strong>Call Girls</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>call-girls/bengaluru/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>call-girls/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>call-girls/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>call-girls/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>call-girls/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <!-- <div class="call-girls-section">
            <strong>Massage</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>massage/bengaluru/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>massage/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>massage/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>massage/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>massage/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Male Escorts</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>male-escorts/bengaluru/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>male-escorts/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>male-escorts/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>male-escorts/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>male-escorts/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Transsexual</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>transsexual/bengaluru/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>transsexual/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>transsexual/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>transsexual/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>transsexual/mumbai/"><button>Mumbai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Dating</strong>

            <div class="ads-cities">
                <a href="<?=get_url() ?>dating/bengaluru/"><button>Bangalore</button></a>
                <a href="<?=get_url() ?>dating/hyderabad/"><button>Hyderabad</button></a>
                <a href="<?=get_url() ?>dating/delhi/"><button>Delhi</button></a>
                <a href="<?=get_url() ?>dating/pune/"><button>Pune</button></a>
                <a href="<?=get_url() ?>dating/mumbai/"><button>Mumbai</button></a>
            </div>

        </div> -->

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