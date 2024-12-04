<?php
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
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Skokra - Privacy and Policy</title>

    <style>
        form{display: none;}
    </style>
</head>

<body>
    <?php include './common-header.php' ?>

    <div class="container main-content">
        <h1  class="main-heading">Privacy and Policies</h1>
        <p class="infornation-text2">We will retain your details until you choose to delete your account. If you deactivate your Profile, your details will be instantly hidden from public access and systematically eradicated the following night. Only your forum contributions will persist, yet all indications of your Profile (other than the profile name) will disappear. We implement consistent backups, preserving the information for a defined duration before being automatically eliminated. This guarantees that skokra.com can be restored in case of a system failure.</p>

        <p class="infornation-text2">Skokra, a start-up company, assists by having access to the data that we store in our systems. Skokra is responsible for third-party ad placements and cookies management, which they use for targeted advertising. As a result of these, advertising was one of the resources used by Skokra.</p> 

        <h2  class="main-heading">We maintain data for numerous purposes:</h2>
        <p class="infornation-text2">Skokra stands as a premier complimentary adult classifieds ads platform in India. Explore free classifieds or submit complimentary ads. Discover independent escorts and agencies.
        Your information is the cornerstone of our service; it enables others to locate you and you to locate them, allowing you to assess growth potential.</p>

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

</body>

</html>