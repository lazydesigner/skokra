<?php include '../../../routes.php';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/user-ads.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
</head>

<body>
    <?php include '../dash-nav.php' ?>

    <div class="container">
        <h1>Your Ads</h1>

        <div class="active-ads-tab-flex">
            <div class="active-tab current-active-tab">
                <span>
                    <div class="ads-count">0</div>
                    <strong>Active</strong>
                </span>
            </div>
            <div class="active-tab">
                <span>
                    <div class="ads-count">0</div>
                    <strong>Not published</strong>
                </span>
            </div>
        </div>
    </div>

    <div class="container ads-container">
        <p>Browse your ads</p>
        <strong>Ads type</strong><br>
        <div class="form-group">
            <select name="" id="">
                <option value="">All</option>
                <option value="">Promoted</option>
                <option value="">Free</option>
            </select>
        </div>
        <div class="ad-filter" id="ad-filter">
            <div>Open Filter</div>
            <div><i class="ri-arrow-right-s-line"></i></div>
        </div>
        <div class="flter_list">
            <div class="form-group">
                <label for="">Expiring Ad</label>
                <select name="" id="">
                    <option value="">All</option>
                    <option value="">Yes</option>
                    <option value="">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Expiring Ad</label>
                <select name="" id="">
                    <option value="">All</option>
                    <option value="">Yes</option>
                    <option value="">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Expiring Ad</label>
                <select name="" id="">
                    <option value="">All</option>
                    <option value="">Yes</option>
                    <option value="">No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container">
        <p class="number-of-active-ad">You Have <strong>0 active</strong> ads</p>
    </div>

    <div class="container ads-container">
        <div class="ad-expiry-date">Expiring date: <strong>May 24, 2024</strong></div>
        <div class="ad-posted-by"><small>Posted by: example2021@gmail.com</small></div>

        <div class="promoted-ad-info">
            <div class="promoted-ad-expiry"><i class="ri-alert-fill"></i> Promotion expired on Jan. 25, 2024 - 11:59 p.m.</div>
            <div>
                <strong>Top SuperTop 10x1 <span style="color: var(--primary-color);">Night</span></strong><br>
                <p>12 a.m - 9 a.m</p>
            </div>
        </div>

        <div class="preview-of-active-ad">
            <div class="preview-ad-image"></div>
            <div class="preview-ad-details">
                <div>
                    <div class="preview-ad-category"><small>Call Girls</small></div>
                    <h3 class="preview-ad-title">Love to be with you all day long!</h3>
                    <p class="preview-ad-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim aspernatur atque, alias facere iure voluptas exercitationem deleniti quod consectetur reprehenderit, repudiandae sed iusto fugit! Autem tenetur iure ab deserunt fuga.</p>
                    <div class="preview-additional-info">
                        <div class="preview-ad-age">
                            <p>25 years</p>
                        </div>
                        <div class="preview-ad-location"><strong>Lucknow </strong>/ Charbagh</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="preview-additional-info free-preview-ad-splash">
            <div class="preview-ad-aged">
                <p><i class="ri-information-2-line"></i></p>
            </div>
            <div class="preview-ad-location"><strong>Free ad</strong>
                <p><small>1 online visible photo, activate a promo and unlock images</small></p>
            </div>
        </div>
        <div class="preview-additional-info ">
            <div class="add-col">
                <a><i class="ri-delete-bin-fill"></i><br>
                <small>delete</small></a>
            </div>
            <div class="add-col">
                <a><i class="ri-pause-circle-fill"></i><br>
                <small>suspend</small></a>
            </div>
            <div class="add-col">            
                <a href="<?=get_url() ?>u/post-update/"><i class="ri-edit-box-line"></i><br><small>Edit</small></a>
            </div>
            <div class="add-col">
                <button>duplicate</button>
            </div>
            <div class="add-col">
                <button><i class="ri-lock-unlock-fill"></i> <small>renew promo and unlock images</small></button>
            </div>
        </div>

    </div>



    <div class="container"><?php include '../../../footer.php' ?></div>
    <?php include '../private-area.php' ?>
    <script>
        document.getElementById('ad-filter').addEventListener('click', () => {
            const h = document.querySelector('.flter_list')
            if (h.style.maxHeight == h.scrollHeight + 'px') {
                h.style.maxHeight = null
                document.getElementById('ad-filter').style.borderBottomLeftRadius = '5px'
                document.getElementById('ad-filter').style.borderBottomRightRadius = '5px'
                h.style.border = 0;
            } else {
                h.style.maxHeight = h.scrollHeight + 'px'
                document.getElementById('ad-filter').style.borderBottomLeftRadius = '0px'
                document.getElementById('ad-filter').style.borderBottomRightRadius = '0px'
                h.style.border = '.5px solid rgb(198, 198, 198)'
            }

        })
    </script>
</body>

</html>