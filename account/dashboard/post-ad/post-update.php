<?php 
session_start();
$POST_INSERT = 'yes'; //to hide  add post button in this page
include '../../../routes.php';

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

    </style>
</head>

<body>

    <?php include '../dash-nav.php' ?>
    <div class="post-insert-heading">
        <h1>Edit your Ad</h1>
    </div>


    <form id="form" action="<?= get_url() ?>xv" method="POST">
        <div class="step-one">
            <div class="container">
                <div class="top-form-field">
                    <strong>Your Ad</strong>
                    <small>*Required fields</small>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">*Select category</label>
                        <select name="category" id="category">
                            <option value="call-girls">Call Girls</option>
                            <option value="massages">Massages</option>
                            <option value="male-escorts">Male Escorts</option>
                            <option value="transsexual">Transsexual</option>
                            <option value="adult-meetings">Adult Meetings</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">*Select city</label>
                        <select name="city" id="city">
                        </select>
                    </div>
                    <div class="form-group form-flex">
                        <span>
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address">
                        </span>
                        <span>
                            <label for="postal_code">Postal Code</label>
                            <input type="number" name="postal_code" id="postal_code">
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="Area/District/Neighbourhood">Area/District/Neighbourhood</label>
                        <input type="text" name="area" id="Area/District/Neighbourhood">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <strong>Your Data</strong>
                    <small>*Required fields</small>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">*Age</label>
                        <input type="number" name="age">
                    </div>
                    <div class="form-group">
                        <label for="city">*Title</label>
                        <textarea name="title" id="" cols="30" rows="5" placeholder="Give your ad a good title"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">*Description</label>
                        <textarea name="description" id="" cols="30" rows="8" placeholder="Use this space to describe yourself, your body, your skills and what you like..."></textarea>
                    </div>
                </div>
            </div>
            <div class="container">
            <div class="top-form-field">
                <label for=""><strong>Your Photos</strong></label>
            </div>
                <div class="form-container">
                    <div class="form-group">
                        <div class="preview-drap-or-selected-image">

                            <div class="preview-image-box">
                                <div class="preview-tag"><i class="ri-star-fill"></i> Preview</div>
                                <div class="preview-image"><img src="" alt=""></div>
                                <div class="edit-preview-img">
                                    <div class="crop"><i class="ri-crop-line"></i></div>
                                    <div class="reupload"><i class="ri-loop-left-line"></i></div>
                                    <div class="delete"><i class="ri-delete-bin-5-line"></i></div>
                                </div>
                            </div>

                            <div class="drag-and-drop-profile-photo resized-drop-are" id="drag-and-drop-profile-photo">
                                <input type="file" name="drag-and-drop-profile-photo" id="draged-or-selected-profile-photo">
                                <div>
                                    <p style="text-transform: uppercase;">you can upload upto 10 pictures </p>
                                    <p><i class="ri-camera-fill"></i></p>
                                    <p>Drag the picture here or click to select them</p>
                                </div>
                            </div>
                        </div>
                        <small class="information-about-profile-image" style="text-align: center;">if you don't choose any preview photos, first photo inserted in photo gallery will be selected as default preview photo</small>
                    </div>

                    <div class="form-group">
                        <small class="Only-one-picture-visible-for-free-add" style="color:darkblue;"><i class="ri-information-line"></i> Only one picture visible for free add</small>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>About You</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Ethnicity</label>
                        <div class="form-flex">
                            <label for="african" class="category">
                                <div>African</div>
                            </label>
                            <input type="radio" name="african" id="african" value="African">

                            <label for="indian" class="category" id="indian">
                                <div>Indian</div>
                            </label>
                            <input type="radio" name="african" id="indian" value="Indian">

                            <label for="asian" class="category" id="asian">
                                <div>Asian</div>
                            </label>
                            <input type="radio" name="african" id="asian" value="Asian">

                            <label for="arab" class="category" id="arab">
                                <div>Arab</div>
                            </label>
                            <input type="radio" name="african" id="arab" value="Arab">

                            <label for="latin" class="category" id="latin">
                                <div>Latin</div>
                            </label>
                            <input type="radio" name="african" id="latin" value="Latin">

                            <label for="caucasian" class="category" id="caucasian">
                                <div>Caucasian</div>
                            </label>
                            <input type="radio" name="african" id="caucasian" value="Caucasian">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Nationality</label>
                        <select name="nationality" id="nationality">
                            <option value="0">Select Nationality</option>
                            <option value="indian">Indian</option>
                            <option value="russian">Russian</option>
                            <option value="australian">Australian</option>
                            <option value="american">American</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Breast</label>
                        <div class="form-flex">
                            <label for="natural-boobs" class="boobs">
                                <div>Natural Boobs</div>
                            </label>
                            <input type="radio" name="boobs" id="natural-boobs" value="Natural Boobs">

                            <label for="busty" class="boobs" id="busty">
                                <div>Busty</div>
                            </label>
                            <input type="radio" name="boobs" id="busty" value="Busty">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Hair</label>
                        <div class="form-flex">
                            <label for="blond-hair" class="hair">
                                <div>Blond Hair</div>
                            </label>
                            <input type="radio" name="hair" id="blond-hair" value="Blond Hair">

                            <label for="brown-hair" class="hair">
                                <div>Blond Hair</div>
                            </label>
                            <input type="radio" name="hair" id="brown-hair" value="Blond Hair">
                            <label for="black-hair" class="hair">
                                <div>Black Hair</div>
                            </label>
                            <input type="radio" name="hair" id="black-hair" value="Black Hair">

                            <label for="red-hair" class="hair">
                                <div>Red Hair</div>
                            </label>
                            <input type="radio" name="hair" id="red-hair" value="Red Hair">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Body Type</label>
                        <div class="form-flex">
                            <label for="slim" class="body-type">
                                <div>Slim</div>
                            </label>
                            <input type="radio" name="body-type" id="slim" value="slim">

                            <label for="curvy" class="body-type">
                                <div>Curvy</div>
                            </label>
                            <input type="radio" name="body-type" id="curvy" value="curvy">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Services</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Services</label>
                        <div class="form-flex">
                            <input type="checkbox" name="services[]" id="service1" value="Oral">
                            <label class="service_" for="service1">
                                <div>Oral</div>
                            </label><input type="checkbox" name="services[]" id="service2" value="Anal">
                            <label class="service_" for="service2">
                                <div>Anal</div>
                            </label><input type="checkbox" name="services[]" id="service3" value="BDSM">
                            <label class="service_" for="service3">
                                <div>BDSM</div>
                            </label><input type="checkbox" name="services[]" id="service4" value="GirlFriend Experience">
                            <label class="service_" for="service4">
                                <div>Girlfriend experience</div>
                            </label><input type="checkbox" name="services[]" id="service5" value="Videocall">
                            <label class="service_" for="service5">
                                <div>Videocall</div>
                            </label><input type="checkbox" name="services[]" id="service6" value="Threesome">
                            <label class="service_" for="service6">
                                <div>Threesome</div>
                            </label><input type="checkbox" name="services[]" id="service7" value="Role play">
                            <label class="service_" for="service7">
                                <div>Role play</div>
                            </label><input type="checkbox" name="services[]" id="service8" value="Porn actressess">
                            <label class="service_" for="service8">
                                <div>Porn actresses</div>
                            </label><input type="checkbox" name="services[]" id="service9" value="Erotic massage">
                            <label class="service_" for="service9">
                                <div>Erotic massage</div>
                            </label><input type="checkbox" name="services[]" id="service10" value="French kiss">
                            <label class="service_" for="service10">
                                <div>French kiss</div>
                            </label><input type="checkbox" name="services[]" id="service11" value="Sexting">
                            <label class="service_" for="service11">
                                <div>Sexting</div>
                            </label><input type="checkbox" name="services[]" id="service12" value="Body ejaculation">
                            <label class="service_" for="service12">
                                <div>Body ejaculation</div>
                            </label><input type="checkbox" name="services[]" id="service13" value="Fetish">
                            <label class="service_" for="service13">
                                <div>Fetish</div>
                            </label><input type="checkbox" name="services[]" id="service14" value="Tantric massage">
                            <label class="service_" for="service14">
                                <div>Tantric massage</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Attention to</label>
                        <div class="form-flex">
                            <input type="checkbox" id="attention_men" name="attention_to[]" value="Men">
                            <label class="Attention" for="attention_men">
                                <div>Men</div>
                            </label>
                            <input type="checkbox" id="Attention_women" name="attention_to[]" value="Women">
                            <label class="Attention" for="Attention_women">
                                <div>Women</div>
                            </label>
                            <input type="checkbox" id="Attention_couple" name="attention_to[]" value="Couples">
                            <label class="Attention" for="Attention_couple">
                                <div>Couples</div>
                            </label>
                            <input type="checkbox" id="Attention_disabled" name="attention_to[]" value="disabled">
                            <label class="Attention" for="Attention_disabled">
                                <div>Disabled</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">Place of service</label>
                        <div class="form-flex">
                            <input type="checkbox" id="place_of_service_home" name="place_of_service[]" value="At Home" />
                            <label class="place_of_service" for="place_of_service_home">
                                <div>At Home</div>
                            </label>
                            <input type="checkbox" id="place_of_service_party" name="place_of_service[]" value="Event And Parties">
                            <label class="place_of_service" for="place_of_service_party">
                                <div>Event And Parties</div>
                            </label>
                            <input type="checkbox" id="place_of_service_hotel" name="place_of_service[]" value="Hotel / Motel">
                            <label class="place_of_service" for="place_of_service_hotel">
                                <div>Hotel / Motel</div>
                            </label>
                            <input type="checkbox" id="place_of_service_clubs" name="place_of_service[]" value="clubs">
                            <label class="place_of_service" for="place_of_service_clubs">
                                <div>Clubs</div>
                            </label>
                            <input type="checkbox" id="place_of_service_outcall" name="place_of_service[]" value="OutCall">
                            <label class="place_of_service" for="place_of_service_outcall">
                                <div>Outcall</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Pricing</strong><br>
                        <small style="color:darkblue;"><i class="ri-information-line"></i> Tags are only visible on promoted ads.</small></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">Price per hour</label>
                        <select name="price" id="price">
                            <option value="0">Select Price</option>
                            <option value="indian">From Rs 1000</option>
                            <option value="indian">From Rs 2000</option>
                            <option value="indian">From Rs 3000</option>
                            <option value="indian">From Rs 4000</option>
                            <option value="indian">From Rs 5000</option>
                            <option value="indian">From Rs 6000</option>
                            <option value="indian">From Rs 7000</option>
                            <option value="indian">From Rs 8000</option>
                            <option value="indian">From Rs 9000</option>
                            <option value="indian">From Rs 10000</option>
                            <option value="indian">From Rs 11000</option>
                            <option value="indian">> 12000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Payment methods</label>
                        <div class="form-flex">
                            <input type="checkbox" value="cash" name="payment-method[]" id="cash">
                            <label class="payment" for="cash">
                                <div>Cash</div>
                            </label>
                            <input type="checkbox" value="credit-card" name="payment-method[]" id="credit-card">
                            <label class="payment" for="credit-card">
                                <div>Credit Card</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="top-form-field">
                    <span><strong>Your Contacts</strong></span>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <label for="category">How Would you like to be contacted?</label>
                        <div class="form-flex">
                            <label for="phone" class="contact label">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><span style="color:dodgerblue"><i class="ri-checkbox-circle-fill"></i></span></p> Only phone
                                </div>
                            </label>
                            <input type="radio" name="contact" id="phone" value="phone" checked>
                            <label for="email-phone" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Email and Phone
                                </div>
                            </label>
                            <input type="radio" name="contact" value="email-phone" id="email-phone">
                            <label for="eamil" class="contact">
                                <div style="display: flex;align-items: center;gap:3%">
                                    <p id="confirm-contact"><i class="ri-checkbox-blank-circle-line"></i></p> Only Email
                                </div>
                            </label>
                            <input type="radio" name="contact" value="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Email Address</label>
                        <input type="text" name="user-email">
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Phone Number</label>
                        <input type="number" name="ad-phone-number" id="">
                    </div>
                    <div class="form-group">
                        <div class="form-flex">
                            <label class="switch">
                                <input type="checkbox" value="true" name="whatsapp-emable">
                                <span class="slider"></span>
                            </label>Whatsapp
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <button class="next-step" id="next-step"><i class="ri-lock-unlock-fill"></i> ACTIVATE A PROMO AND UNLOCK IMAGES</button>
                <button class="next-step" id="next-step">GO ON</button>
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

        // document.getElementById('next-step').addEventListener('click',(e)=>{
        //     e.preventDefault()
        //     const formdata = document.getElementById('form')
        //     const data = new FormData(formdata)

        //     // Checking that all fields
        //     // are filled out before moving to next step
        //     for (let pair of data.entries()) {
        //         if(pair[0] == 'services[]'){
        //             const services = [];
        //             services.push(pair[1]);
        //         }else{

        //         }
        //     }
        // })
    </script>



</body>

</html>