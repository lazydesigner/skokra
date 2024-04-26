<?php 
session_start();
$POST_INSERT = 'yes'; //to hide add post button in this page
include '../../../routes.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/post-insert.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
        }
        .form-flex{align-items: start;}
        .success{
            text-align: center;
            width: 70%;
            margin: auto;
            border: 1px solid #DC006C;
            border-radius: 10px;
            padding: 5%;
        }

    </style>
</head>

<body>

    <?php include '../dash-nav.php' ?>
    <div class="post-insert-heading">
        <h1>Publish for free in just a few steps!</h1>
    </div>

    <div class="form-progress-bar container">
        <div class="form-progress ">
            <div class="progress-bar active-progress"><i class="ri-user-fill"></i></div>
            <strong>Ad Info</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar active-progress"><i class="ri-camera-2-fill"></i></div>
            <strong>Your photos</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar active-progress"><i class="ri-thumb-up-fill"></i></div>
            <strong>Visibility</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar active-progress"><i class="ri-check-double-line"></i></div>
            <strong>Finish</strong>
        </div>
    </div>

   <div class="container">
        <div class="success">
            <p>Your Ad has Been  Published Successfully! </p>
            <a href='<?=get_url().'u/post-manager/'.$_GET['post_id'] ?>'><button style='margin:auto;text-align:center;background:transparent;border:1px solid #DC006C;padding:2% 4%;cursor:pointer;border-radius:5px'>Manage Ad</button></a>
        </div>
       
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
                    <a href=""><i class="ri-whatsapp-fill"></i> Whatsapp</a>
                    <a href=""><i class="ri-telegram-fill"></i> Telegram</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container"><?php include '../../../footer.php' ?></div>
    <?php include '../private-area.php' ?>
    
    <script>
        setTimeout(()=>{
            window.location.href = "<?=get_url().'u/post-manager/'.$_GET['post_id'] ?>";
        },4000)
    </script>
   

</body>

</html>