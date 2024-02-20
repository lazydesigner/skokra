<?php include '../../routes.php';
session_start();
$dashboard = 'true';
$_SESSION['customer_id'] = 'a';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" async>
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/common-header.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/home.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex nofollow">
    <title>SKOKRA - User Dashboard</title>
</head>

<body>
    <?php include '../../common-header.php' ?>

    <div class="container">
        <div class="age-attention">
            <div class="age-alert">
                <p><strong><i class="ri-alarm-warning-fill"></i> Important: Age Verification Required!</strong><br><br>

                    To access the exclusive features within your private area, you are required to verify your age.</p>
            </div>
        </div>

        <div class="action-pannel">
            <div class="welcome-user">
                <strong>WELCOME</strong>
                <p>useraccountmail@gmail.com</p>
                <div class="customer-id">
                    <small>Customer Code:</small>
                    <p>DEE87PA07K</p>
                </div>
            </div>
            <div class="action-row">
                <div class="action-col">
                    <div class="action-grid">
                        <div class="action-ads">
                            <ul>
                                <li>
                                    <div class="action-ads-row">
                                        <h2><i class="ri-edit-box-line"></i>Your Ads</h2>
                                        <i class="ri-arrow-right-s-line sko"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Active</p>
                                        <span>0</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Not published</p>
                                        <span>0</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="action-ads">
                            <ul>
                                <li>
                                    <div class="action-ads-row">
                                        <h2><i class="ri-database-2-fill"></i></i>Credits</h2>
                                        <i class="ri-arrow-right-s-line sko"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Currents</p>
                                        <span>0</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Used</p>
                                        <span>0</span>
                                    </div>
                                </li>
                                <li>
                                    <button class="buy-coin" id="buy-coin">Buy Credits</button>
                                </li>
                            </ul>
                        </div>
                        <div class="action-ads">
                            <ul>
                                <li>
                                    <div class="action-ads-row">
                                        <h2><i class="ri-line-chart-fill"></i>Products</h2>
                                        <i class="ri-arrow-right-s-line sko"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Purchase our products to be always on TOP!</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="action-ads">
                            <ul>
                                <li>
                                    <div class="action-ads-row">
                                        <h2><i class="ri-user-settings-fill"></i>Edit Profile</h2>
                                        <i class="ri-arrow-right-s-line sko"></i>
                                    </div>
                                </li>
                                <li>
                                    <div class="action-ads-row">
                                        <p>Manage your personal info.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="action-col">
                    <div class="age-verification-form">
                        <h2><i class="ri-pass-valid-line"></i>Verify Your Age!</h2>
                        <ul>
                            <li> How does it work?</li>
                            <li>Any questions?</li>
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



            <div class="help-box">
                <div class="support"><i class="ri-customer-service-2-fill"></i></div>
                <div style="padding:1% 2% ;">
                    <strong>Seeking support</strong><br>
                    <small>Contact us through one of our channels from Monday to Friday from 2pm to 9pm.</small><br><br>
                    <a href="" aria-label="whatsapp"><i class="ri-whatsapp-fill"></i> whatsapp</a> <a href="" aria-label="telegram"><i class="ri-telegram-fill"></i> telegram</a>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../footer.php' ?>
</body>

</html>