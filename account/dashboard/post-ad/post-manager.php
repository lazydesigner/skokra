<?php
session_start();
include '../../../routes.php';
include '../../../backend/user_task.php';
if(!isset($_SESSION['user_identification']) || !isset($_SESSION['customer_code'])){
    Get_User_Details::Get_Customer_Code(); 
}


if (isset($stopthefurtherprocess)) {
    if ($stopthefurtherprocess == true) {
        $result = Get_User_Details::Get_ad_detail($_GET['post_id']);
        
        $pattern = '/[*%{}()\/|><+=\]\[?.:,:"\'\\\\]/u';
            $url = preg_replace($pattern,'',$result['title']);    
        $url = str_replace(' ','-',$url);    
        $url = 'ad/'.$url.'/?x=0723'.$result['post_id'];
    }
}

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
        .back-to-ad-manager {
            margin: 2% 0;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .back-to-ad-manager a {
            color: #C61569;
        }

        .manage-your-ad {
            padding: 3%;
            text-align: center;
        }

        .manage-your-ad h1 {
            font-weight: 500;
        }

        h2 {
            font-size: 1.1rem;
            font-weight: 500;
            margin: .5% 0
        }

        .ad-info {
            width: 100%;
            height: auto;
            padding: 1%;
            border: 1px solid lightgrey;
            border-radius: 5px;
        }

        .ad-info p {
            margin: 0;
            font-size: small;
        }

        .ad-info-flex {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding-bottom: 1%;
            border-bottom: 1px solid lightgrey;

        }

        .ad-expiry>div {
            margin: 5% 0 0 0;
        }

        .ad-expiry a {
            font-weight: 600;
            margin: 0;
            color: #C61569;
        }

        .share-flex {
            width: auto;
            display: flex;
            align-items: center;
            gap: 3%;
            /* justify-content:; */
        }

        .share-flex a {
            color: #C61569;
        }

        .preview-of-active-ad {
            width: 100%;
            height: auto;
            box-shadow: 0 0 12px 6px whitesmoke;
            /* border: 1px solid lightgrey; */
            display: flex;
            align-items: center;
            margin: 2% 0;
            border-radius: 10px;
        }

        .preview-ad-image {
            width: 20%;
            overflow: hidden;
        }
        .preview-ad-image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-ad-details {
            width: 80%;
            padding: 0 1%;
        }

        .preview-additional-info {
            width: 100%;
            align-items: center;
            display: flex;
            gap: 3%;
            font-size: small;
        }

        .preview-ad-title {
            margin: 1% 0;
        }

        .preview-ad-desc {
            margin: 0;
        }

        .free-preview-ad-splash {
            background-color: #D1ECF1;
            color: #C61569;
            padding: 2%;
            border-radius: 10px;
            /* margin: 1.5% 0; */
        }

        .preview-additional-info {
            width: 100%;
            display: flex;
            gap: 3%;
            margin: 1% 0;
        }

        .free-preview-ad-splash {
            background-color: #C61569;
            color: #0C5460;
            padding: 2%;
            border-radius: 10px;
            margin: 1.5% 0;
        }

        .add-col {
            flex: 1;
            text-transform: uppercase;
            text-align: center;
            align-self: center;
        }

        .add-col i {
            font-size: 1.7rem;
        }

        .add-col button {
            width: 100%;
            padding: 15px 0;
            height: auto;
            border-radius: 20px;
            background-color: transparent;
            border: 2px solid var(--header-color);
            color: var(--header-color);
            text-transform: uppercase;
        }

        .add-col:last-child button {
            font-size: 1.3rem;
            background-color: var(--header-color);
            text-transform: uppercase;
            color: white;
            padding: 15px 10px;
        }

        .add-col :is(a, button) {
            cursor: pointer;
            color: var(--header-color);
        }
        .delete_ad{
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);
            position:fixed;
            top:0;
            left:0;
            display:none;
            place-items:center;
        }
        .delete-pop-up{
            width:30%;
            height:200px;
            background:white;
            border-radius:10px;
            display:grid;
            place-items:center;
            text-align:center;
        }
        .delete-pop-up button{
            cursor:pointer;
            background:transparent;
            padding:5% 10%;
            border-radius:5px;
            border:1px solid var(--header-color);
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
        <div class="back-to-ad-manager">
            <a href="<?= get_url() ?>u/account/ads/"><i class="ri-arrow-left-s-fill"></i> Back to your ads</a>
        </div>
        <div class="manage-your-ad">
            <h1>Manage Your Ad</h1>
        </div>
    </div>
    <div class="container">
        <h2>Ad Info</h2>
        <div class="ad-info">
            <div class="ad-info-flex">
                <div class="ad-flex-col">
                    <div class="ad-expiry">
                        <p>Expiry date: <b><?=$result['ad_expiry_date'] ?></b></p>
                        <small>Posted by: <b><?=$result['email'] ?></b></small><br>
                        <div><a href="<?=get_url().strtolower($url) ?>">View your ad online <i class="ri-arrow-right-s-fill"></i></a></div>
                    </div>
                </div>
                <div class="ad-flex-col">
                    <p><i class="ri-circle-fill"></i> Active</p>
                </div>
            </div>
            <h2 style="font-size: small;margin:1% 0 1.5% 0">Share Your Ad</h2>
            <div class="share-flex">
                <div id="textToCopy" style="display: none;"><?=get_url().strtolower($url) ?></div>
                <a onclick="copyText()"><i class="ri-file-copy-line"></i> Copy Link</a>
                <a href="whatsapp://send?text=Check%20out%20this%20awesome%20website:%20<?=get_url().strtolower($url) ?>" target="_blank"><i class="ri-whatsapp-line"></i> Whatsapp</a>
                <!-- <a href=""><i class="ri-mail-line"></i> Email</a> -->
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 5%;">
        <h2>Contacts Info</h2>
        <div class="ad-info">
            <div class="share-flex">
                <a href=""><i class="ri-phone-fill"></i><?=$result['ad_phone_number'] ?></a>
                <a href=""><i class="ri-whatsapp-line"></i><?php if($result['whatsapp_enable'] == 0){ echo 'No';}else{echo 'Yes';} ?></a>
            </div>
            <p style="margin-top:1.5%"><b>Visibility:</b> Anyone can see you contacts in your ad details. <a href="">Edit Ad</a> to change this option.</p>
        </div>
    </div>

    <div class="container" style="margin: 5% auto">
    <h2>Manage Your Ad</h2>
    <div class="preview-of-active-ad"  data-href = '<?=get_url().strtolower($url) ?>'>
                <div class="preview-ad-image" style="<?php if ($result['preview_image'] == null) { ?>width:0%; <?php } else {
                                                                                                                $imageData = @getimagesize($result['preview_image']);
                                                                                                                if ($imageData === false) { ?>width:0%; <?php }
                                                                                                                                                } ?>">
                    <?php if ($result['preview_image'] != null) {
                        $imageData2 = @getimagesize($result['preview_image']);
                        if ($imageData2 !== false) { ?> <img src="<?= $result['preview_image'] ?>" width="100%" height="100%" alt=""><?php }
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
        <div class="preview-additional-info ">
        <div class="add-col">
                    <a onclick="Activity('<?php if($result['suspend'] == 1 ){ ?>unsus<?php }else{?>sus<?php } ?>','<?=$_GET['post_id'] ?>','<?php if($result['suspend'] == 1 ){ ?>Are You Sure you want Unsuspend This Ad<?php }else{?>Are You Sure you want Suspend This Ad<?php } ?>','<?=$_GET['post_id'] ?>')"><?php if($result['suspend'] == 1 ){ ?><i class="ri-play-fill"></i><?php }else{?><i class="ri-pause-circle-fill"></i><?php } ?><br>
                        <small>suspend</small></a>
                </div>
                <div class="add-col">
                    <a href="<?= get_url() ?>u/post-update/"><i class="ri-edit-box-line"></i><br><small>Edit</small></a>
                </div>
                <div class="add-col">
                    <a onclick="Activity('del','<?=$_GET['post_id'] ?>','Are You Sure you want to delete this Ad permanently')"><i class="ri-delete-bin-fill"></i><br>
                        <small>delete</small></a>
                </div>
                <div class="add-col">
                <button onclick="Activity('dup','<?=$_GET['post_id'] ?>','Are You Sure you want to duplicate this Ad')">duplicate</button>
                </div>
            <div class="add-col">
                <button><small>PROMOTE</small></button>
            </div>
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

    <div class="delete_ad">
        <div class='delete-pop-up'>
           <div> <p>Ad Deleted Successfuly!</p>
            <button onclick='Activity2()'>Back To Dashboard</button></div>
        </div>
    </div>

    <?php include '../../../footer.php' ?>
    <?php include '../private-area.php' ?>
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
                    }
                })
            }
        }

        function Activity2(){window.location.href="<?=get_url().'u/account/dashboard/' ?>";}
    </script>
    
<script>
    const ad_blockdd = document.querySelectorAll('.preview-of-active-ad');
    ad_blockdd.forEach((ad,i)=>{
        ad.addEventListener('click',()=>{
            url = ad_blockdd[i].getAttribute('data-href')
        window.location.href = url;
        })
        
    })

function copyText() {
  // Select the text to copy
  var texttocopy = document.getElementById("textToCopy");
  
  // Create a temporary input element
  var dummyinput = document.createElement("textarea");
  dummyinput.value = text.innerText;
  document.body.appendChild(dummyinput);
  
  // Select the text within the input element
  dummyinput.select();
  
  // Copy the selected text
  document.execCommand("copy");
  
  // Remove the temporary input element
  document.body.removeChild(dummyinput);
  
  // Alert the user that the text has been copied
  alert("Text copied!");
}
</script>
</body>

</html>