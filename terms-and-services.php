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
    <link rel="shortcut icon" href="<?= get_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/home.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/respontomobile.css" defer>
    <title>Skokra - Terms and Condition</title>

    <script>
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            let user = getCookie("confirm_terms");
            if (user != "") {
                document.body.classList.remove('body-no-scroll');
                var remove_agree_terms = document.getElementById("confirm-18");
                remove_agree_terms.style.display = "none";
            }
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(";");
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == " ") {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            let user = getCookie("confirm_terms");
            if (user != "") {
                //var remove_agree_terms = document.getElementById("confirm-18");
                //remove_agree_terms.style.display = "none";
                remove_agree_terms_hide()
            } else {
                var remove_agree_terms = document.getElementById("confirm-18");
                remove_agree_terms.style.display = "block";
            }
        }
        </script>
    <style>
        form{display: none;}
    </style>
</head>

<body onload="checkCookie()">
    <?php include './common-header.php' ?>

    <div class="container main-content">
        <h1  class="main-heading">Terms and Services</h1>
        <p class="infornation-text2">We provide world-class privacy and security with 100% discretion, which other websites do not offer. The call girls at Skokra are very encouraging, and the service is completely discreet, so you will never feel unsafe here. No one will know you have used our service, and we do not require any of your information. Every advertisement must highlight the availability of escort or massage services. It is prohibited to create ads that connect to the identities of others. It is forbidden to produce advertisements which are connected to the identities of others. It is severely forbidden to reveal a person's email address, phone number, or any other contact information. The images you upload must be lawful. You must retain copyright for your photos, and if they include different individuals, you must obtain their explicit consent to feature them on the site.</p>

        <p class="infornation-text2">References to child pornography, sexual acts with animals, sexual activities involving pregnant women, extreme violence, or drug usage are strictly absent from the site, whether in text or imagery. But in case you find any such thing on our website, please contact us at support@skokra.com. We will ban that ID immediately and remove such content from the website. </p>

        <p class="infornation-text2">Advertisements that break the law, such as those containing illegal content, links to sites with unlawful material, solicitation for illicit actions, or content deemed offensive by the advertiser, will be removed without prior notice. In severe cases, police reports may be filed using the Profile's current IP address and additional information about the advertiser.
        We maintain the right to suspend, block, or remove advertisements that we consider spam or lack truthful information.</p>

        <h2  class="main-heading">Hygienic and healthy environment </h2>
        <p class="infornation-text2">We promote healthy meeting/friendship/sex in every possible way. So we request independent escorts to do regular health check ups and to avoid any contact without protection. We are not involved in meetings between our online visitors and ad publishers by any means. So we just request our visitors to get everything checked from their end.</p>

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