<?php
session_start();
$POST_INSERT = 'yes';
$login_page = 'yes';
include '../routes.php';
include '../backend/user_task.php';


$stopthefurtherprocess = true; //Remove it when you remove $login_page

if (isset($stopthefurtherprocess)) {
    if ($stopthefurtherprocess == true) {
        $result = Get_User_Details::Get_ad_detail($_GET['post_id']);
    }
}

$rows = Get_User_Details::Price_plan();

$plan = Get_User_Details::Get_Plane_table();

$customer =  Get_User_Details::Get_Customer_Details();

$plan =  $plan->fetch(PDO::FETCH_ASSOC)

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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/common.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css" defer>
    <title>Skokra - Manage your ads</title>
    <style>
        .price-btn {
            width: 100%;
            height: auto;
            padding: 2%;
            border-radius: 5px;
            /* border: 1px solid lightgrey; */
        }

        .price-btn button {
            width: 100%;
            height: 40px;
            border: 0;
            border-radius: 5px;
            background-color: dodgerblue;
            color: white;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
        }

        .price-flex {
            padding: 2%;
            width: 100%;
            display: flex;
        }

        .payment-btn {
            padding: 2%;
            width: 30%;
            height: auto;
            border-radius: 5px;
            height: fit-content;
        }

        .price-grid {
            width: 70%;
            height: auto;
            padding: 2% 2% 2% 1%;
        }

        .container h1 {
            text-align: center;
            margin: 3% 0;
        }

        .safety-tips {
            background-image: linear-gradient(to right, #DC006C, #0060B0);
            border-radius: 10px;
            text-align: center;
            width: 100%;
            height: 100px;
            color: white;
            position: relative;
            font-size: 1.3rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .safety-tips p {
            margin: 0;
            padding: 0;
            font-weight: 600;
        }


        .profile-box {
            width: 100%;
            padding: 2%;
            box-shadow: 0 0 6px 3px lightgrey;
            border-radius: 5px;
        }

        .profile-det {
            width: 100%;
            height: auto;
            display: flex;
        }

        .profile-img {
            width: 10%;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-title {
            width: 90%;
            padding: 0 1%;
        }

        .profile-title span {
            background-color: lightgrey;
            padding: 1% 2%;
            border-radius: 20px;
            display: block;
            width: fit-content;
        }

        .delete-the-post {
            width: 3%;
            margin: 0 1%;
            font-size: 1.5rem;
            cursor: pointer;
            cursor: pointer;
            color: #DC006C;
        }

        .multiline-ellipsis {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            /* let the text wrap preserving spaces */
        }
        #check i{
            font-size: 2rem;
            display: block;
        }
        .insufficient{
            background-color: rgba(255, 0, 0, 0.35);
            font-weight: 600;
            padding: 1% 2%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include './dashboard/dash-nav.php' ?>

    <div class="container">
        <div class="safety-tips">
            <p>Use only our official Skokka website to make secure purchases. <br>
                Watch out for fakers.</p>
        </div>
        <div class="price-flex">
            <div class="price-grid">
                <div class="profile-box">
                    <div class="profile-det">
                        <div class="profile-det">
                            <div class="profile-img">
                                <img src="<?= $result['preview_image'] ?>" width="100%" height="100%" alt="">
                            </div>
                            <div class="profile-title "><a href="<?= get_url() ?>u/post-manager/<?= $_GET['post_id'] ?>" class="multiline-ellipsis"><?= $result['title'] ?></a> <br> <span><?php $cat = explode('-', $result['category']);
                                                                                                                                                                                            $cat2 = '';
                                                                                                                                                                                            for ($i = 0; $i < count($cat); $i++) {
                                                                                                                                                                                                if ($i == (count($cat) - 1)) {
                                                                                                                                                                                                    $cat2 .= ucwords($cat[$i]);
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    $cat2 .= ucwords($cat[$i]) . ' ';
                                                                                                                                                                                                }
                                                                                                                                                                                            }
                                                                                                                                                                                            echo $cat2;
                                                                                                                                                                                            ?></span></div>
                        </div>
                        <div class="delete-the-post"><i class="ri-edit-box-line"></i></div>
                        <div class="delete-the-post"><i class="ri-delete-bin-fill"></i></div>
                    </div>
                    <div>
                        <div class="profile-det" style="justify-content: space-between;margin:2% 0">
                            <div><span style="font-weight:600">Top <?= $plan['times_a_day'] . ' X ' . $plan['number_of_days'] . ' ' . $plan['ad_shift'] ?></span> <br><small><i class="ri-time-line"></i> 8 p.m - 10 p.m</small></div>
                            <div style="font-size: small;">Rs <?= $plan['number_of_credits'] * $plan['cost_of_token'] ?>.00 <br> (<?= $plan['number_of_credits'] ?> Tokens) </div>
                        </div>
                        <div class="profile-det" style="justify-content: space-between; ">
                            <div>+ SuperTop</div>
                            <div style="font-size: small;">Rs <?= $plan['super_top_ad'] * $plan['cost_of_token'] ?>.00 <br> (<?= $plan['super_top_ad'] ?> Tokens) </div>
                        </div>
                    </div>
                </div>
                <h2>How do you prefer to pay?</h2>
                <div class="profile-box select-top-pay" <?php if($customer['total_token_left'] < ($plan['number_of_credits'] + $plan['super_top_ad'])){ ?> style='user-select:none' <?php }else{ ?>style='border:1px solid dodgerblue'<?php } ?> data-value = 'token'>
                    <div class="profile-det" style="justify-content: space-between;margin:2% 0">
                           <div class="profile-det" id="profile-det" style="align-items: center;"><span id="check"><?php if($customer['total_token_left'] < ($plan['number_of_credits'] + $plan['super_top_ad'])){ ?> <i class="ri-circle-line"></i> <?php }else{ ?><i class="ri-checkbox-circle-line"  style="color:dodgerblue"></i><?php } ?></span> <i class="ri-coin-fill"></i> Tokens</div>
                           <div><p style="text-wrap: nowrap;">Available Tokens : <?=$customer['total_token_left'] ?></p></div>
                    </div>
                    <?php if($customer['total_token_left'] < ($plan['number_of_credits'] + $plan['super_top_ad'])){ ?>
                        <p class="insufficient">Insufficient Tokens <a href="<?=get_url() ?>u/account/tokens">Buy Tokens</a></p>    
                    <?php } ?>
                </div>
                <div class="profile-box select-top-pay" style="margin-top:20px" data-value = 'visa'>
                    <div class="profile-det" id="profile-det" style="justify-content: space-between;margin:2% 0">
                           <div class="profile-det"  style="align-items: center;"><span id="check"><i class="ri-circle-line"></i></span> VISA</div>
                    </div>
                </div>
            </div>
            <div class="payment-btn">
                <div style="padding:4% 2%;border-radius:5px;margin-bottom:10px;box-shadow:0 0 6px 3px lightgrey"><span style="font-weight: 600;">Order Summary</span><br>
                    <small><?= $_GET['post_id'] ?></small>
                </div>
                <div style="padding:2%;border-radius:5px;box-shadow:0 0 6px 3px lightgrey">
                    <div class="price-itemd" style="padding:4% 1%;border:0;display:flex;justify-content:space-between"><span><b>Total: </b></span> <span id="total_p"><b>
                                <div style="font-size: small;color:#DC006C">Rs <?= ($plan['super_top_ad'] + $plan['number_of_credits']) * $plan['cost_of_token'] ?>.00 <br> (<?= $plan['number_of_credits'] + $plan['super_top_ad'] ?> Tokens) </div>
                            </b></span></div>
                    <div class="price-btn">
                        <button id="paynow" value='<?php if($customer['total_token_left'] < ($plan['number_of_credits'] + $plan['super_top_ad'])){ ?>visa<?php }else{ ?>token<?php } ?> '>Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../footer.php' ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/account/dashboard/private-area.php' ?>
    <script src="../assets/js/common.js" defer></script>

    <script>

        const select_top_pay = document.querySelectorAll('.select-top-pay');
        const check = document.querySelectorAll('#check');
        
        select_top_pay.forEach((items, i) => {
            items.addEventListener('click', (e) => {
                select_top_pay.forEach((item, j) => {
                    item.style.border = '1px solid lightgrey'
                    check[j].innerHTML = '<i class="ri-circle-line"></i>';
                })
                items.style.border = '1px solid dodgerblue';
                    check[i].innerHTML = '<i class="ri-checkbox-circle-line" style="color:dodgerblue"></i>';
                    document.getElementById('paynow').value = items.getAttribute('data-value');
                    console.log()
            })
        })

        document.getElementById('paynow').addEventListener('click',(e)=>{
            alert('Something Went Wrong! Logic Error')
        })
    </script>
</body>

</html>