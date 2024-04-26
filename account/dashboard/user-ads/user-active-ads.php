<?php
session_start();
include '../../../routes.php';
include '../../../backend/user_task.php';



$results = Get_User_Details::Get_Full_ad_detail();

if (!isset($_SESSION['user_identification']) || !isset($_SESSION['customer_code'])) {
    Get_User_Details::Get_Customer_Code();
}

// checkDateNear($formattedDate);

function checkDateNear($formattedDate)
{
    $currentDate = new DateTime();
    $targetDate = new DateTime($formattedDate);
    $difference = $currentDate->diff($targetDate);
    // Check if the difference is less than or equal to 3 days (adjust as needed)
    if ($difference->days <= 3) {
        return  true;
    } else {
        return false;
    }
}

function timeto($timeString)
{
    $timestamp = strtotime($timeString);

    // Format the time
    $formattedTime = date("g:i A", $timestamp);

    return $formattedTime;
}


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
    <style>
        .delete_ad {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            place-items: center;
        }

        .delete-pop-up {
            width: 30%;
            height: 200px;
            background: white;
            border-radius: 10px;
            display: grid;
            place-items: center;
            text-align: center;
        }

        .delete-pop-up button {
            cursor: pointer;
            background: transparent;
            padding: 5% 10%;
            border-radius: 5px;
            border: 1px solid var(--header-color);
        }
        .multiline-ellipsis1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            /* let the text wrap preserving spaces */
        }
        .multiline-ellipsis2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            /* let the text wrap preserving spaces */
        }
        .preview-ad-title a{color:var(--primary-color)}
    </style>
</head>

<body>
    <?php include '../dash-nav.php' ?>

    <div class="container">
        <h1>Your Ads</h1>

        <div class="active-ads-tab-flex">
            <div class="active-tab current-active-tab">
                <span>
                    <div class="ads-count"><?php echo count($results) ?></div>
                    <strong>Active</strong>
                </span>
            </div>
            <div class="active-tab">
                <span>
                    <div class="ads-count"><?php  ?></div>
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
        <p class="number-of-active-ad">You Have <strong><?php echo count($results) ?> active</strong> ads</p>
    </div>

    <?php
    foreach ($results as $result) { 
        $pattern = '/[*%{}\/|><+=\]\[?.:,:\'\\\\]/u';
            $url = preg_replace($pattern,'',$result['title']);    
        $url = str_replace(' ','-',$url);    
        $url = 'ad/'.$url.'/?x=0723'.$result['post_id'];
        
        ?>
        <div class="container ads-container">
            <div class="ad-expiry-date">Expiring date: <strong><?= $result['ad_expiry_date'] ?></strong></div>
            <div class="ad-posted-by"><small>Posted by: <?= $result['email'] ?></small></div>
            <?php if ($result['top_ad'] == 1) { ?>
                <div class="promoted-ad-info">
                    <div class="promoted-ad-expiry"><i class="ri-alert-fill"></i> Promotion expired on <?=$result['top_ad_expiry_date'] ?>.</div>
                    <div>
                        <strong>Top SuperTop <?= $result['n_t_a_s_c_f'] ?>x<?= $result['n_d_a_s_c'] ?> <span style="color: var(--primary-color);"><?= ucwords($result['ad_shift']) ?></span></strong><br>
                        <p><?php echo timeto($result['starting_time']) ?> - <?php echo timeto($result['end_time']) ?></p>
                    </div>
                </div><?php } ?>
            <div class="preview-of-active-ad"  data-href = '<?=get_url().strtolower($url) ?>'>
                <div class="preview-ad-image" style="<?php if ($result['preview_image'] == null) { ?>width:0%; <?php } else {
                                                                                                                $imageData = @getimagesize($result['preview_image']);
                                                                                                                if ($imageData === false) { ?>width:0%; <?php }
                                                                                                                                                } ?>">
                    <?php if ($result['preview_image'] != null) {
                        $imageData2 = @getimagesize($result['preview_image']);
                        if ($imageData2 !== false) { ?> <img src="<?= $result['preview_image'] ?>" alt=""><?php }
                                                                                                    } ?>

                </div>
                <div class="preview-ad-details" style="<?php if ($result['preview_image'] == null) { ?>width:100%; <?php } else {
                                                                                                                    $imageData = @getimagesize($result['preview_image']);
                                                                                                                    if ($imageData === false) { ?>width:100%; <?php }
                                                                                                                                                        } ?>">

                    <div>
                        <div class="preview-ad-category"><small><?php $cat = explode('-', $result['category']);
                                                                $cat2 = '';
                                                                for ($i = 0; $i < count($cat); $i++) {
                                                                    if ($i == (count($cat) - 1)) {
                                                                        $cat2 .= ucwords($cat[$i]);
                                                                    } else {
                                                                        $cat2 .= ucwords($cat[$i]) . ' ';
                                                                    }
                                                                }
                                                                echo $cat2;
                                                                ?></small></div>
                        <h3 class="preview-ad-title multiline-ellipsis1"><a href="<?=get_url().strtolower($url) ?>"><?= $result['title'] ?></a></h3>
                        <p class="preview-ad-desc multiline-ellipsis2"><?= $result['description'] ?></p>
                        <div class="preview-additional-info">
                            <div class="preview-ad-age">
                                <p><?= $result['age'] ?> years</p>
                            </div>
                            <div class="preview-ad-location"><strong><?= $result['city'] ?> </strong><!-- / Charbagh --></div>
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
                    <a onclick="Activity('<?php if($result['suspend'] == 1 ){ ?>unsus<?php }else{?>sus<?php } ?>','<?= str_replace($_SESSION['customer_code'] . '_in', '', $result['adid']); ?>','<?php if($result['suspend'] == 1 ){ ?>Are You Sure you want Unsuspend This Ad<?php }else{?>Are You Sure you want Suspend This Ad<?php } ?>','<?= str_replace($_SESSION['customer_code'] . '_in', '', $result['adid']); ?>')"><?php if($result['suspend'] == 1 ){ ?><i class="ri-play-fill"></i><?php }else{?><i class="ri-pause-circle-fill"></i><?php } ?><br>
                        <small>suspend</small></a>
                </div>
                <div class="add-col">
                    <a href="<?= get_url() ?>u/post-update/"><i class="ri-edit-box-line"></i><br><small>Edit</small></a>
                </div>
                <div class="add-col">
                    <a onclick="Activity('del','<?= str_replace($_SESSION['customer_code'] . '_in', '', $result['adid']); ?>','Are You Sure you want to delete this Ad permanently')"><i class="ri-delete-bin-fill"></i><br>
                        <small>delete</small></a>
                </div>
                <div class="add-col">
                    <button onclick="Activity('dup','<?= str_replace($_SESSION['customer_code'] . '_in', '', $result['adid']); ?>','Are You Sure you want to duplicate this Ad')">duplicate</button>
                </div>
                <div class="add-col">
                    <button id="unlockpromo" data-href='<?php $pst_id = explode('_in', $result['adid']); echo $pst_id[1] ?>' ><i class="ri-lock-unlock-fill"></i> <small>renew promo and unlock images</small></button>
                </div>
            </div>

        </div>
    <?php } ?>

    <div class="delete_ad">
        <div class='delete-pop-up'>
            <div>
                <p>Ad Deleted Successfuly!</p>
                <button onclick='Activity2()'>Back To Page</button>
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
    <script>
        function Activity(activity, post_id,msg) {
            if (confirm(msg)) {
                let data = new FormData();
                data.append('activity', activity);
                data.append('post_', post_id);
                fetch('<?= get_url() ?>u/activity-center', {
                    method: 'POST',
                    body: data
                }).then(response => response.json()).then(value => {
                    if (value['success'] == 'success') {
                        document.querySelector('.delete_ad').style.display = 'grid';
                    }else if (value['success2'] == 'success2') {
                        window.location.href = "<?= get_url() . 'u/account/ads/' ?>";
                    }else if (value['success3'] == 'success3') {
                        window.location.href = "<?= get_url() . 'u/account/ads/' ?>";
                    }else if (value['success5'] == 'success5') {
                        window.location.href = "<?= get_url() . 'u/account/ads/' ?>";
                    }else{
                        console.log(value)
                    }
                })
            }
        }


        function Activity2() {
            window.location.href = "<?= get_url() . 'u/account/ads/' ?>";
        }

        document.getElementById('unlockpromo').addEventListener('click', (e)=>{
            window.location.href = '<?=get_url() ?>u/order-checkout/'+document.getElementById('unlockpromo').getAttribute('data-href')
        })
    </script>
    <script>
    const ad_blockdd = document.querySelectorAll('.preview-of-active-ad');
        ad_blockdd.forEach((ad, i)=>{
        ad.addEventListener('click',()=>{
            url = ad_blockdd[i].getAttribute('data-href')
            window.location.href = url;
        })
    })
</script>
</body>

</html>