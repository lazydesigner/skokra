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
            <div class="progress-bar"><i class="ri-thumb-up-fill"></i></div>
            <strong>Visibility</strong>
        </div>
        <div class="form-progress">
            <div class="progress-bar"><i class="ri-check-double-line"></i></div>
            <strong>Finish</strong>
        </div>
    </div>

    <form action="">
        <div class="step-two">
            <div class="container">
                <small><i class="ri-edit-box-line"></i> Edit Your Ad</small>
                <div class="form-container">
                    <div class="form-flex2">
                        <p><strong>Title : </strong>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero, sed.</p>
                    </div>
                    <div class="form-flex2" style="flex-wrap: nowrap;">
                        <p> <strong>Text : </strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam magni eveniet, et sapiente repudiandae laudantium voluptatibus molestiae in nam voluptates!</p>
                    </div>
                    <div class="form-flex2">
                        24 Years | Call Girld |<i class="ri-map-pin-line"></i> Lucknow
                    </div>
                </div>
            </div>
            <div class="container">
                <label for="">Your Photos</label>
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
                <button class="next-step" id="next-step-two">GO ON</button>
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

        let dropZone = document.getElementById('drag-and-drop-profile-photo');

        dropZone.addEventListener('click', () => {
            document.getElementById('draged-or-selected-profile-photo').click()
        })
        document.getElementById('draged-or-selected-profile-photo').addEventListener('change', (e) => {
            HandelImageUploading(e.target.files)
        })

        dropZone.addEventListener('dragover', PREVENTDefalut, false)
        dropZone.addEventListener('drop', PREVENTDefalut, false)
        dropZone.addEventListener('dragleave', PREVENTDefalut, false)

        function PREVENTDefalut(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            HandelImageUploading(e.dataTransfer.files)
        }, false)

        function HandelImageUploading(imageupload) {
            console.log(imageupload)
        }


       document.addEventListener('DOMContentLoaded',()=>{
        document.getElementById('open-private-area').addEventListener('click',()=>{
            document.getElementById('private-area-background').style.display = 'grid'
        })
       })
    </script>



</body>

</html>