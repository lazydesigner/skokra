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
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/account/post-insert.css">
    <link rel="stylesheet" href="<?= get_url() ?>assets/css/footer.css">
    <meta name="robots" content="noindex, nofollow">
    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
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

    <form action="">
        <div class="step-three">
            <div class="container flex-container">
                <div class="form-container">
                    <label for=""><span class="color-top-up-image"><i class="ri-share-forward-fill"></i> Top</span><strong>Top ad</strong></label><br>
                    <small>Put your ad (Ad Id:your ad id) on the top whenever you want</small>

                    <div class="show-super-top-ad-example"><i class="ri-eye-fill"></i> show example</div>
                    <div class="super-top-learn-more">
                        <p>XXL visibility with the new SuperTop ad</p>
                        <a href="">learn more!</a>
                    </div>
                    <div class="book-ad-time-slot">
                        <div class="time-slot time-slot-one">
                            <div class="form-flex">
                                <div><i class="ri-checkbox-blank-circle-line"></i></div>
                                <div>
                                    <strong>5X1</strong><br>
                                    <p>5 top-ups a day for 1 day</p>
                                    <b>Rs 141.00 (3 credits)</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Day</label><br>
                                <select name="" id="">
                                    <option value="">option 1</option>
                                    <option value="">option 2</option>
                                    <option value="">option 3</option>
                                    <option value="">option 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="time-slot time-slot-two">
                            <div class="form-flex">
                                <div><i class="ri-checkbox-blank-circle-line"></i></div>
                                <div>
                                    <strong>5X1</strong><br>
                                    <p>5 top-ups a day for 1 day</p>
                                    <b>Rs 141.00 (3 credits)</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Day</label><br>
                                <select name="" id="">
                                    <option value="">option 1</option>
                                    <option value="">option 2</option>
                                    <option value="">option 3</option>
                                    <option value="">option 4</option>
                                </select>
                            </div>

                        </div>
                        <div class="time-slot time-slot-three">
                            <div class="form-flex">
                                <div><i class="ri-checkbox-blank-circle-line"></i></div>
                                <div>
                                    <strong>5X1</strong><br>
                                    <p>5 top-ups a day for 1 day</p>
                                    <b>Rs 141.00 (3 credits)</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Day</label><br>
                                <select name="" id="">
                                    <option value="">option 1</option>
                                    <option value="">option 2</option>
                                    <option value="">option 3</option>
                                    <option value="">option 4</option>
                                </select>
                            </div>

                        </div>
                        <div class="time-slot time-slot-four">
                            <div class="form-flex">
                                <div><i class="ri-checkbox-blank-circle-line"></i></div>
                                <div>
                                    <strong>10X1</strong><br>
                                    <p>10 top-ups a day for 1 day</p>
                                    <b>Rs 188.00 (4 credits)</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Neight</label><br>
                                <small>12 a.m - 9 a.m</small>
                            </div>
                        </div>
                        <div class="time-slot time-slot-five">
                            <div class="form-flex">
                                <div><i class="ri-checkbox-blank-circle-line"></i></div>
                                <div>
                                    <strong>10X7</strong><br>
                                    <p>10 top-ups a day for 7 day</p>
                                    <b>Rs 940.00 (20 credits)</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Neight</label><br>
                                <small>12 a.m - 9 a.m</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <p style="font-size: 1.5rem;font-weight:bold;margin-top:0">Promotions</p>
                    <label for=""><small>no promotion selected</small></label>
                    <button  class="next-step" style="width: 100%;">POST AD FOR FREE</button>
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
        let count = 1

        // document.getElementById('progress').addEventListener('click',()=>{
        //     // CREATE A BUTTON WITH NAME PROGRESS
        //     count++
        //     let active = document.querySelectorAll('.progress-bar')
        //     for(i=0;i<count;i++){
        //         if(i != 4){
        //             active[i].classList.add("active-progress")
        //             if(i==3){
        //                 document.getElementById('progress').disabled = 'true'
        //             }
        //         }
        //     }
        // })

        
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

       document.addEventListener('DOMContentLoaded',()=>{
        document.getElementById('open-private-area').addEventListener('click',()=>{
            document.getElementById('private-area-background').style.display = 'grid'
        })
       })
    </script>



</body>

</html>