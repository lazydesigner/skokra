<?php
$rows = Get_User_Details::Get_states_detail()[0];

$state = '<option value="">All the regions</option>';
$city = '<option value="">All the Cities</option>';


if(isset($_GET['cty'])){
$getcity = $_GET['cty'];
}elseif(isset($profilerow['city'])){
    $getcity = $profilerow['city'] ; 
}

// print_r($rows);

foreach($rows as $row){

    if(isset($getcity)){
        if(Get_User_Details::checkifitsastateorcity($getcity)){
            $navstate = Get_User_Details::getStateByCity($getcity);
        }else{
            $navstate = str_replace('-', ' ', $getcity);
        }
    }else{ 
        $navstate = 'skokra';
    }

    if(strtolower($row["state"]) == strtolower($navstate)){
        $state .= '<option value="'.str_replace(' ', '-',strtolower($row["state"])).'" selected>'.ucwords($row["state"]).'</option>';
    }else{
        $state .= '<option value="'.str_replace(' ', '-',strtolower($row["state"])).'">'.ucwords($row["state"]).'</option>';
    }    

    $cty = json_decode($row['cities'], true);
    foreach($cty as $ct){
        if(isset($getcity)){
            $navcty = $getcity;
        }else{
            $navcty = 'skokra';
        }
        if(strtolower($ct) == strtolower($navcty)){
            $city .= '<option value="'.str_replace(' ', '-',strtolower($ct)).'_'.str_replace(' ', '-',strtolower($row["state"])).'" selected>'.ucwords($ct).'</option>';
        }else{
            $city .= '<option value="'.str_replace(' ', '-',strtolower($ct)).'_'.str_replace(' ', '-',strtolower($row["state"])).'">'.ucwords($ct).'</option>';
        }
    }

    if(isset($cityofcity)){
        $city = $cityofcity;
    }


}

?>
<div class="restrict" id="confirm-18" >
    <div class="confirm-18">
    <div class="logo" style="width:30%;margin:auto"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt="" aria-label="skokra Ads network"></div>
    <p><b>Before continuing, please read the following disclaimer.</b></p>
    <p>I agree to see explicit material intended for an adult audience since I am older than eighteen.
</p><p>
I acknowledge that I have read and accepted the
Terms and Conditions</p>
<div class="confirm-btn"><button onclick="setCookie('confirm_terms', 'accepted_terms', 30)">Accept</button>
<button onclick="()=>{window.location.href = '<?=get_url() ?>';}">Decline</button></div>
    </div>
</div>
<header>
    <div class="container">
        <nav class="nav">
            <a href="<?= get_url() ?>" class="logo"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt="" aria-label="skokra Ads network"></a>
            <ul>

                <?php if (!isset($_SESSION['email'])) { ?>

                    <li><a href="<?= get_url() ?>login/"><i class="ri-login-box-line"></i> Login</a></li>
                    <li><a href="<?= get_url() ?>signup/"><i class="ri-edit-circle-line"></i> Sign up</a></li>
                <?php } else { ?>
                    <li class="user-account">
                        <div id="open-private-area"><i class="ri-user-star-line"></i><br><small><?= $_SESSION['email'] ?></small></div>
                    </li>
                <?php } ?>
                <li><a id="forward-the-link" data-href="<?= get_url() ?>u/post-insert/"><button class="post-your-ad" aria-label="POST YOUR AD"><span>POST YOUR AD</span><i class="ri-arrow-right-line"></i></button></a></li>
            </ul>
        </nav>
    </div>
</header>
<?php if (empty($dashboard)) { ?>
    <div class="search-header">
        <div class="container">
            <form action="" id="searchform" autocomplete="off">
                <div>
                    <div class="form-group">
                        <select name="category" id="categoryf">
                            <option value="call-girls" <?php if(isset($_GET['cat'])){if($_GET['cat'] == 'call-girls'){ echo 'selected'; }} ?>>Call Girls</option>
                            <!-- <option value="male-escorts" <?php if(isset($_GET['cat'])){if($_GET['cat'] == 'male-escorts'){ echo 'selected'; }} ?>>Male Escorts</option>
                            <option value="massage" <?php if(isset($_GET['cat'])){if($_GET['cat'] == 'massage'){ echo 'selected'; }} ?>>massage</option>
                            <option value="adult-meeting" <?php if(isset($_GET['cat'])){if($_GET['cat'] == 'adult-meeting'){ echo 'selected'; }} ?>>Adult Meeting</option>
                            <option value="transsexual" <?php if(isset($_GET['cat'])){if($_GET['cat'] == 'transsexual'){ echo 'selected'; }} ?>>Transsexual</option> -->
                        </select>
                        <input type="search" id="search" placeholder="Search Here...">
                    </div>
                    <div class="form-group">
                        <select name="list-of-states" id="list-of-states">
                            <?=$state ?>
                        </select>
                        <select name="cities" id="cities_s">
                        <?=$city ?>
                        </select>
                        <select name="area" id="">
                            <option value="all">all</option>
                        </select>
                        <button><i class="ri-search-2-line"></i> Search</button>
                    </div>
                </div>
            </form>
            <a id="forward-the-link" data-href="<?= get_url() ?>u/post-insert/"><button class="post-your-ad post-your-ad2"><span>POST YOUR AD</span><i class="ri-arrow-right-line"></i></button></a>
        </div>
    </div>
<?php } ?>