<?php 
session_start();
include '../routes.php';
include '../backend/user_task.php';
$row = Get_User_Details::Get_Customer_Details();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/home.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" defer>
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
    <style>
        .age-verification-form{width: 100%;background-color: #F8F9FA;}
        .acc-det{margin: 5% auto;}
        .container h2{font-size: 1.3rem;text-align: center;margin: 0;}
        .container h3{font-size: 1rem;text-align: center;margin:1% 0;font-weight: 400;font-style: oblique;}
        .change-your-pass{
            padding: 3%;
            background-color: #F8F9FA;
            text-align: center;
            margin: 3% 0;
            border-radius: 10px;
        }
        .change-your-pass p{
            font-size: 1.2rem;
            font-weight: 600;
        }
        .change-your-pass button{
            width: auto;
            padding:  10px 15px;
            height: 40px;
            border: 2px solid var(--primary-color);
            background-color: transparent;
            border-radius: 10px;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include './dashboard/dash-nav.php' ?>

    <div class="container">
       <h1 style="text-align: center;">Edit Profile</h1>

       <div class="container acc-det">
        <h2>MY ACCOUNT</h2>
        <h3><strong>EMAIL: </strong><?=$row['email'] ?></h3>
       </div>
        <div class="change-your-pass">
            <p><i class="ri-lock-2-line"></i> RESET PASSWORD</p>
            <small>To update your password, we'll send you an email.</small><br><br>
            <button>RESET PASSWORD</button>
        </div>


        <div class="action-pannel">
            <div class="action-row">
                <div class="action-col" style="width: 100%;">
                    <div class="age-verification-form">
                        <h2><i class="ri-pass-valid-line"></i>Verify Your Age!</h2>
                        <ul>
                            <li><i class="ri-information-line"></i> How does it work?</li>
                            <li><i class="ri-information-line"></i> Any questions?</li>
                        </ul>
                        <div class="age-verify-info">
                            <div class="age-card"><i class="ri-pass-valid-line"></i></div>
                            <p>As Skokra we need to be sure that everyone who publish is of age.</p>
                            <b style="font-size: 1.5rem;">Verify your age now!</b>
                            <p>If you need any help in the process,<br> check out our tutorial or write to <br><a style="color: var(--header-color)" href="mailto:">support@skokra.com</a></p>
                            <p>We’ll get back to you soon!</p>
                        </div>
                        <a href=""><button>Start Now</button></a>
                    </div>
                </div>
            </div>
        </div>

        <p  style="color: var(--primary-color);">Delete My Account</p>

    </div>
    <div class="container">
        <div class="need-help">
            <div class="need-help-icon"><i class="ri-customer-service-2-fill"></i></div>
            <div class="need-help-content">
                <div>
                    <strong>Need help?</strong><br>
                    <small>Contact us through one of our channels from Monday to Friday from 2pm to 9pm.</small>
                </div>
                <div class="need-help-button">
                    <a href="" style="color: var(--primary-color);"><i class="ri-whatsapp-fill"></i> Whatsapp</a>
                    <a href="" style="color: var(--primary-color);"><i class="ri-telegram-fill"></i> Telegram</a>
                </div>
            </div>
        </div>
    </div>

    <?php include '../footer.php' ?>
    <?php include './dashboard/private-area.php' ?>
</body>

</html>