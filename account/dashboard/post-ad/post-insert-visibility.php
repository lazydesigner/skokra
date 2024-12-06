<?php
session_start();
$POST_INSERT = 'yes'; //to hide  add post button in this page
include '../../../routes.php';
include '../../../backend/user_task.php';
if (!isset($_SESSION['user_identification']) || !isset($_SESSION['customer_code'])) {
    Get_User_Details::Get_Customer_Code();
}

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$queryString = $parsedUrl['query'] ?? '';

// Parse the query string into an associative array
parse_str($queryString, $queryParams);

// Get the value of the 'a' parameter
$aValue = $queryParams['a'] ?? null;

if (isset($stopthefurtherprocess)) {
    if ($stopthefurtherprocess == true) {
        Get_User_Details::Check_Ad_Owner($_GET['post_id'], $aValue);
    }
}



// date_default_timezone_set(date_default_timezone_get());
date_default_timezone_set('Asia/Kolkata');
function isTimePassed($hour)
{
    // Get the current time in 24-hour format
    $currentTime = date("H");

    // If the provided hour is less than the current hour, assume it's for tomorrow
    if ($hour < $currentTime) {
        return true;
        // $currentDate = date("Y-m-d");
        // $providedTime = date("Y-m-d H:i", strtotime("$currentDate +1 day $hour:00"));
    } else {
        return false;
        // Use the current date if the provided hour is in the future of the current hour
        // $providedTime = date("Y-m-d H:i", strtotime("today $hour:00"));
    } 
}
if (isset($_POST['next-step'])) {
    $currentDateTime = time();

    // // Format the current date and time
    // $top_ad_expiry_date = date("M. j, Y - h:i a", $currentDateTime);



    $currentDate = new DateTime();
    $currentDate->modify('+15 days');
    $formattedDate = $currentDate->format('F j, Y');
    $price_plane = explode('_', $_POST['price-plan']);
    // $top_ad_expiry_date = '';
    $selected_plan = Get_User_Details::Get_Single_Plane_table($price_plane[1]);
    $selected_plan = json_decode($selected_plan, true);
    if (isset($_POST['price-plan'])) {

        $fields = [];

        
        $date1 = new DateTime();
        $date2 = new DateTime();

        $n_d_a_s_c = $selected_plan[0]['number_of_days'];
        if (isset($_POST['time_to_show'])) {

            $time_to_show = explode('-', $_POST['time_to_show']);

            if (strpos($time_to_show[0], 'am') !== false) {
                $mod = str_replace('am', '', $time_to_show[0]);
                if (isTimePassed($time_to_show[0])) {
                    $futureDateTime = strtotime("+$n_d_a_s_c days", $currentDateTime);

                    $futureDateTimeWithMinutes = strtotime("+180 minutes", $futureDateTime);

                    $top_ad_expiry_date = date("M. j, Y - h:i a", $futureDateTimeWithMinutes);
                }else{
                    $n_d_a_s_cc = (int)$n_d_a_s_c - 1;
                    $futureDateTime = strtotime("+$n_d_a_s_cc days", $currentDateTime);
                    $futureDateTimeWithMinutes = strtotime("+180 minutes", $futureDateTime);
                    $top_ad_expiry_date = date("M. j, Y - h:i a", $futureDateTimeWithMinutes);
                }
                $date1->setTime($mod, 0, 0);
            } else {
                $date1->setTime($time_to_show[0], 0, 0);
                if (isTimePassed($time_to_show[0])) {
                    echo '1';
                    $futureDateTime = strtotime("+$n_d_a_s_c days", $currentDateTime);
                    $futureDateTimeWithMinutes = strtotime("+180 minutes", $futureDateTime);
                    $top_ad_expiry_date = date("M. j, Y - h:i a", $futureDateTimeWithMinutes);
                }else{
                    $n_d_a_s_cc = (int)$n_d_a_s_c - 1;
                    $futureDateTime = strtotime("+$n_d_a_s_cc days", $currentDateTime);
                    $futureDateTimeWithMinutes = strtotime("+180 minutes", $futureDateTime);
                    $top_ad_expiry_date = date("M. j, Y - h:i a", $futureDateTimeWithMinutes);
                }
            }

            if (strpos($time_to_show[1], 'am') !== false) {
                $mod1 = str_replace('am', '', $time_to_show[1]);
                $date2->setTime(0, 0, 0);
            } else {
                $date2->setTime($time_to_show[1], 0, 0);
            }

            $starting_time = $date1->format('H:i:s');
            $end_time = $date2->format('H:i:s');
        } else {
            $date1->setTime(0, 0, 0);
            $date2->setTime(9, 0, 0);
            $starting_time = $date1->format('H:i:s');
            $end_time = $date2->format('H:i:s');
            $futureDateTime = strtotime("+$n_d_a_s_c days", $currentDateTime);
            $futureDateTimeWithMinutes = strtotime("+180 minutes", $futureDateTime);
            $top_ad_expiry_date = date("M. j, Y - h:i a", $futureDateTimeWithMinutes);
        }
        if (isset($_POST['supertopplan'])) {
            $supertop_ad = 1;
        }

        // Fields Names

        $ad_expiry_date = $formattedDate;
        $top_ad = 1;

        $ad_shift = $selected_plan[0]['ad_shift'];
        $n_t_a_s_c_f = $selected_plan[0]['times_a_day'];
        $ad_complete = 1;



        $fields['ad_expiry_date'] = $ad_expiry_date;
        $fields['top_ad_expiry_date'] = $top_ad_expiry_date;
        $fields['top_ad'] = $top_ad;
        if (isset($supertop_ad)) {

            $totalToken =  $selected_plan[0]['number_of_credits'] + $selected_plan[0]['super_top_ad'];

            $fields['supertop_ad'] = $supertop_ad;
        } else {
            $totalToken =  $selected_plan[0]['number_of_credits'];
        }
        $fields['n_t_a_s_c_f'] = $n_t_a_s_c_f;
        $fields['n_d_a_s_c'] = $n_d_a_s_c;
        $fields['ad_shift'] = $ad_shift;
        $fields['starting_time'] = $starting_time;
        $fields['end_time'] = $end_time;
        $fields['ad_complete'] = $ad_complete;

// print_r($fields);
        if (Get_User_Details::Update_Post_Ad($fields, 'profiles_ad', $_GET['post_id'], $_SESSION['customer_code'], $totalToken)) {
            header('Location:' . get_url() . 'u/post-finish/' . $_GET['post_id']);
            exit;
        } else {
            header('Location:' . get_url() . 'u/account/tokens/' . $_GET['post_id']);
            exit;
        }
    } else {
        $fields = [];
        $fields['ad_expiry_date'] = $formattedDate;
        $fields['ad_complete'] = 1;
        $totalToken = 0;
        if (Get_User_Details::Update_Post_Ad($fields, 'profiles_ad', $_GET['post_id'], $_SESSION['customer_code'], $totalToken)) {
            header('Location:' . get_url() . 'u/post-finish/' . $_GET['post_id']);
            exit;
        } else {
            echo '<script>alert("Something Went Wrong! Please Try Later")</script>';
        }
    }
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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/post-insert.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
        }

        .form-flex {
            align-items: start;
        }

        .upgrade-to-supertop {
            margin-top: 3%;
            display: none;
        }

        .upgrade-super {
            border: 1px solid lightgrey;
            border-radius: 5px;
            padding: 1%;
            margin-top: 3%;
        }

        .upgrade-super h4 {
            margin: 0;
        }

        .upgrade-to-supertop p {
            margin: 0;
            font-weight: bold;
        }

        .switch {
            cursor: pointer;
        }

        #post_ad_for_free {
            display: block;
        }

        #post_super_ad {
            display: none;
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
            <div class="progress-bar"><i class="ri-check-double-line"></i></div>
            <strong>Finish</strong>
        </div>
    </div>

    <form action="" method="post">
        <div class="step-three">
            <div class="container flex-container">
                <div class="form-container">
                    <label for=""><span class="color-top-up-image"><i class="ri-share-forward-fill"></i> Top</span><strong>Top ad</strong></label><br>
                    <small>Put your ad (Ad Id:<?= $_GET['post_id'] ?>) on the top whenever you want</small>

                    <div class="show-super-top-ad-example"><i class="ri-eye-fill"></i> show example</div>
                    <div class="super-top-learn-more">
                        <p>XXL visibility with the new SuperTop ad</p>
                        <a href="">learn more!</a>
                    </div>
                    <div class="book-ad-time-slot">
                        <?php
                        $plan = Get_User_Details::Get_Plane_table();
                        while ($row = $plan->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="time-slot time-slot-one">
                                <div class="time-slot-flex">
                                    <input type="radio" value="in_<?= $row['ad_plan_id'] ?>" name="price-plan" id="price-plan" hidden>
                                    <div class="form-flex">
                                        <div class="select_plan" for="price-plan"><i class="ri-checkbox-blank-circle-line"></i></div>
                                        <div>
                                            <strong><?= $row['times_a_day'] . 'X' . $row['number_of_days'] ?></strong><br>
                                            <p><?= $row['times_a_day'] ?> top-ups a <?= $row['ad_shift'] ?> for <?= $row['number_of_days'] ?> <?= $row['ad_shift'] ?></p>
                                            <div><b>Rs <?php echo $row['number_of_credits'] * $row['cost_of_token'] ?>.00 (<?= $row['number_of_credits'] ?> tokens)</b></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?= $row['ad_shift'] ?></label><br>
                                        <?php if ($row['ad_shift'] == 'day') { ?>
                                            <select name="time_to_show" id="select-select-field" disabled>
                                                <option value="">Select time slot</option>
                                                <option value="9am-12">9am - 12pm</option>
                                                <option value="12-15">12pm - 3pm</option>
                                                <option value="15-18">3pm - 6pm</option>
                                                <option value="18-20">6pm - 8pm</option>
                                                <option value="20-22">8pm - 10pm</option>
                                                <option value="22-12am">10pm - 12am</option>
                                            </select>
                                        <?php } else { ?>
                                            <small>12 a.m - 9 a.m</small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="upgrade-to-supertop">
                                    <p>Upgrades</p>
                                    <small>Upgrade to get more calls</small>
                                    <div class="time-slot-flex upgrade-super" style="justify-content: space-between;">
                                        <div>
                                            <h4>SuperTop</h4>
                                            <small>More visibility and higher call volume</small><br><br>
                                            <b>+ Rs <?php echo $row['super_top_ad'] * $row['cost_of_token'] ?>.00 (<?= $row['super_top_ad'] ?> tokens)</b>
                                        </div>
                                        <div>
                                            <label class="switch" style="width:6%">
                                                <input type="checkbox" value="yes" id="supertopplan" name="supertopplan">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-container" style="position: sticky;top:2%">
                    <p style="font-size: 1.5rem;font-weight:bold;margin-top:0">Promotions</p>
                    <div id='post_ad_for_free' for=""><small>no promotion selected</small></div>
                    <div class="time-slot-flex" id="post_super_ad" style="width: 100%;justify-content:space-between">
                        <div>
                            <h3>Total</h3>
                        </div>
                        <div>
                            <h4 style="margin: 0;" id="total_amount"></h4>
                            <div id="total_credits"></div>
                        </div>
                    </div>
                    <button class="next-step" name="next-step" id="next-step" style="width: 100%;">POST AD FOR FREE</button>
                </div>
            </div>
            <div class="container" style="margin:1% auto">
                <small>For Technical assistance you can send an email to: <a href=""><span style="color: #DC006C;">support@skokra.com</span></a></small><br>
                <small>Support Center: <a href=""><span style="color: #DC006C;">+91 000 000 0000</span></a> From Mon to Fri / From 02:00 PM to 10:00 PM</small>
            </div>
        </div>
    </form>

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
        const select_plan = document.querySelectorAll('.select_plan')
        const select_select_field = document.querySelectorAll('#select-select-field')
        const price_plan = document.querySelectorAll('#price-plan')
        const upgrade_to_supertop = document.querySelectorAll('.upgrade-to-supertop')
        const supertopplan = document.querySelectorAll('#supertopplan')
        select_plan.forEach((item, i) => {

            item.addEventListener('click', (ee) => {
                ee.stopPropagation()
                select_plan.forEach((e, ii) => {
                    e.innerHTML = '<i class="ri-checkbox-blank-circle-line"></i>'
                    upgrade_to_supertop[ii].style.display = 'none'
                    if (select_select_field[ii]) {
                        select_select_field[ii].setAttribute('disabled', true)
                    }
                    document.getElementById('total_credits').innerText = '';
                    document.getElementById('total_amount').innerText = '';
                })

                // r = item.children[0];
                if (select_select_field[i]) {
                    select_select_field[i].addEventListener('change', (e) => {
                        if (e.target.value.trim().length == 0) {
                            document.getElementById('next-step').setAttribute('disabled', true)
                        } else {
                            document.getElementById('next-step').removeAttribute('disabled')
                        }
                    })
                }

                if (price_plan[i].checked) {
                    console.log('checked')
                    price_plan[i].checked = false;
                    upgrade_to_supertop[i].style.display = 'none'
                    item.innerHTML = '<i class="ri-checkbox-blank-circle-line"></i>'
                    if (select_select_field[i]) {
                        select_select_field[i].setAttribute('disabled', true)
                        document.getElementById('next-step').setAttribute('disabled', true)
                    } else {
                        document.getElementById('next-step').removeAttribute('disabled')
                    }
                    document.getElementById('total_credits').innerText = '';
                    document.getElementById('total_amount').innerText = '';
                    document.getElementById('next-step').innerText = 'POST AD FOR FREE';
                    document.getElementById('post_ad_for_free').style.display = 'block';
                    document.getElementById('post_super_ad').style.display = 'none';
                } else {
                    const Plan_i = new FormData()
                    Plan_i.append("id", price_plan[i].value)
                    fetch('<?= get_url() ?>get_plan_det/', {
                            method: "POST",
                            body: Plan_i
                        }).then(response => response.json())
                        .then(data => {
                            upgrade_to_supertop[i].style.display = 'block'
                            price_plan[i].checked = true;
                            item.innerHTML = '<i class="ri-radio-button-line"></i>';
                            if (select_select_field[i]) {
                                select_select_field[i].removeAttribute('disabled')
                                document.getElementById('next-step').setAttribute('disabled', true)
                            } else {
                                document.getElementById('next-step').removeAttribute('disabled')
                            }
                            document.getElementById('post_ad_for_free').style.display = 'none';
                            document.getElementById('post_super_ad').style.display = 'flex';
                            document.getElementById('next-step').innerText = 'BUY AND POST AD';
                            document.getElementById('total_credits').innerText = '(' + data["credit"] + ' Credits)';
                            document.getElementById('total_amount').innerText = 'Rs ' + data["cost"];
                        })
                }
            })

            supertopplan[i].addEventListener('change', () => {

                if (supertopplan[i].checked == true) {
                    const Plan_i = new FormData()
                    Plan_i.append("id", price_plan[i].value)
                    Plan_i.append("sid", supertopplan[i].value)
                    GETDATA(Plan_i)
                } else {
                    const Plan_i = new FormData()
                    Plan_i.append("id", price_plan[i].value)
                    GETDATA(Plan_i)
                }
            })

            function GETDATA(plan) {
                fetch('<?= get_url() ?>get_plan_det/', {
                        method: "POST",
                        body: plan
                    }).then(response => response.json())
                    .then(data => {
                        document.getElementById('total_credits').innerText = '(' + data["credit"] + ' Credits)';
                        document.getElementById('total_amount').innerText = 'Rs ' + data["cost"];
                    })
            }


        })



        let count = 1

        function handleRadioButtons(radioButtons) {
            radioButtons.forEach((radio) => {
                radio.addEventListener('click', () => {
                    if (!radio.nextElementSibling.checked) {
                        radioButtons.forEach((r) => {
                            r.nextElementSibling.checked = false;
                            r.classList.remove('label');
                        });
                        radio.nextElementSibling.checked = true;
                        radio.classList.add('label');
                    } else {
                        radio.nextElementSibling.checked = false;
                        radio.classList.remove('label');
                    }
                });
            });
        }

        function Multipleselect(checkbutoon) {
            checkbutoon.forEach((check) => {
                check.addEventListener('click', () => {
                    if (!check.previousElementSibling.checked) {
                        check.classList.add('label');
                    } else {
                        check.classList.remove('label');
                    }
                })
            })
        }
        document.addEventListener('DOMContentLoaded', () => {
            const servicecheckbox = document.querySelectorAll('.service_')
            const Attentioncheckbox = document.querySelectorAll('.Attention')
            const place_of_servicecheckbox = document.querySelectorAll('.place_of_service')
            const paymentcheckbox = document.querySelectorAll('.payment')

            Multipleselect(servicecheckbox)
            Multipleselect(Attentioncheckbox)
            Multipleselect(place_of_servicecheckbox)
            Multipleselect(paymentcheckbox)
        })

        document.addEventListener('DOMContentLoaded', () => {
            const categoryRadios = document.querySelectorAll('[class="category"]');
            const boobsRadios = document.querySelectorAll('[class="boobs"]');
            const hairRadios = document.querySelectorAll('[class="hair"]');
            const bodyRadios = document.querySelectorAll('[class="curvy"]');

            handleRadioButtons(categoryRadios);
            handleRadioButtons(boobsRadios);
            handleRadioButtons(hairRadios);
        });

        const contactRadios = document.querySelectorAll('.contact');
        contactRadios.forEach(contact => {
            let ok = contact.querySelector('#confirm-contact')
            contact.addEventListener('click', () => {
                if (!contact.nextElementSibling.checked) {
                    contactRadios.forEach(contact2 => {
                        contact2.classList.remove('label');
                        contact2.querySelector('#confirm-contact').innerHTML = '<span style="color:grey"><i class="ri-checkbox-blank-circle-line"></i></span>'
                    })
                    contact.classList.add('label');
                    ok.innerHTML = '<span style="color:dodgerblue"><i class="ri-checkbox-circle-fill"></i></span>'
                }
            })
        })

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('open-private-area').addEventListener('click', () => {
                document.getElementById('private-area-background').style.display = 'grid'
            })
        })
    </script>



</body>

</html>