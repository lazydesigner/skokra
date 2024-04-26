<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #36454F
        }

        .container {
            width: 100%;
            height: 100%;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            text-align: center;
            color: white
        }

        .content-container {
            width: 100%;
            height: 30%;
            display: flex;
            align-items: end;
            justify-content: center;
        }

        .content-img {
            width: 100%;
            margin: auto;
            display: flex;
            justify-content: center;
        }

        .country-list {
            margin-top: 5%;
        }

        .list {
            width: 90%;
            height: auto;
            padding: 1% 2%;
            border-radius: 10px;
            margin: 1% auto;
            box-shadow: 0 0 4px 1px lightgrey;
            transition: .3s;
            display: flex;
            align-items: center;
        }

        .list:hover {
            box-shadow: 0 0 12px 6px lightgrey;
            transform: scale(1.001);
        }

        .list a {
            font-size: 2rem;
            margin: 0;
            text-decoration: none;
        }

        p {
            margin: 0;
        }

        footer {
            width: 100%;
            height: auto;
            border-top: 1px solid lightgrey;
            padding: 2%;
        }

        .list img {
            width: 40px;
        }

        .h1 {
            width: 100%;
            height: 150px;
            line-height: 150px;
            background-color: #EF499A;
        }

        @media (min-width:320px) and (max-width:900px) {
            .h1 {
                height: auto;
                padding: 3% 0;
                line-height: 39px;
                background-color: #EF499A;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-container">
            <div>
                <div class="content-img">
                    <img src="https://in.skokra.com/assets/images/SKOKRA+LOGO+NEW+(2).webp.png" alt="">
                </div>
            </div>
        </div>
        <div class="h1">
            <h1>#1 Advertisement Platform in the World! | Post Free Ads Online</h1>
        </div>
        <div class="country-list">
            <h2 style="text-align: center;">Find the most attractive date in your Country.</h2>
            <div class="list">
                <a href="https://in.skokra.com">
                    <p><img src="https://in.skokra.com/assets/images/indian-flag.png" alt=""> India</p>
                </a>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 - skokra.com</p>
    </footer>
</body>

</html>