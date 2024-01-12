<?php include './routes.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <meta name="description" content="">
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/home.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Skokra - Manage your ads</title>
</head>

<body>
    <header>
        <div class="container">
            <nav class="nav">
                <a href="#" class="logo"><img src="./assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt=""></a>
                <ul>
                    <li><a href=""><i class="ri-login-box-line"></i> Login</a></li>
                    <li><a href=""><i class="ri-edit-circle-line"></i> Sign up</a></li>
                    <li><button class="post-your-ad">POST YOUR AD <i class="ri-arrow-right-line"></i></button></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="search-header">
        <div class="container">
            <form action="">
                <div>
                    <div class="form-group">
                        <select name="category" id="">
                            <option value="call-girls">Call Girls</option>
                            <option value="male-escorts">Male Escorts</option>
                            <option value="massage">massage</option>
                            <option value="adult-meeting">Adult Meeting</option>
                            <option value="transsexual">Transsexual</option>
                        </select>
                        <input type="search" placeholder="Search Here...">
                    </div>
                    <div class="form-group">
                        <select name="state" id="">
                            <option value="all">All the regions</option>
                            <option value="delhi">Delhi</option>
                            <option value="agra">Agra</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="goa">Goa</option>
                            <option value="pune">Pune</option>
                            <option value="others">Others</option>
                        </select>
                        <select name="cities" id="">
                            <option value="delhi">Delhi</option>
                            <option value="agra">Agra</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="goa">Goa</option>
                            <option value="pune">Pune</option>
                            <option value="others">Others</option>
                        </select>
                        <select name="area" id="">
                            <option value="all">all</option>
                        </select>
                        <button><i class="ri-search-2-line"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
                        <li><a href="">lorem ipsum</a></li>
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
                <a href=""><button>Bangalore</button></a>
                <a href=""><button>Hyderabad</button></a>
                <a href=""><button>Delhi</button></a>
                <a href=""><button>Pune</button></a>
                <a href=""><button>Mubmai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Massage</strong>

            <div class="ads-cities">
                <a href=""><button>Bangalore</button></a>
                <a href=""><button>Hyderabad</button></a>
                <a href=""><button>Delhi</button></a>
                <a href=""><button>Pune</button></a>
                <a href=""><button>Mubmai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Male Escorts</strong>

            <div class="ads-cities">
                <a href=""><button>Bangalore</button></a>
                <a href=""><button>Hyderabad</button></a>
                <a href=""><button>Delhi</button></a>
                <a href=""><button>Pune</button></a>
                <a href=""><button>Mubmai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Transsexual</strong>

            <div class="ads-cities">
                <a href=""><button>Bangalore</button></a>
                <a href=""><button>Hyderabad</button></a>
                <a href=""><button>Delhi</button></a>
                <a href=""><button>Pune</button></a>
                <a href=""><button>Mubmai</button></a>
            </div>

        </div>
        <div class="call-girls-section">
            <strong>Dating</strong>

            <div class="ads-cities">
                <a href=""><button>Bangalore</button></a>
                <a href=""><button>Hyderabad</button></a>
                <a href=""><button>Delhi</button></a>
                <a href=""><button>Pune</button></a>
                <a href=""><button>Mubmai</button></a>
            </div>

        </div>

    </div>

<?php include './footer.php' ?>
</body>

</html>