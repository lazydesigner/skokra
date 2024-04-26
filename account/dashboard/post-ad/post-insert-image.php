<?php


session_start();

$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
}else{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/user_task.php';
}


if (isset($_SESSION['url'])) {
    unset($_SESSION['url']);
}
if (!isset($_SESSION['user_identification']) || !isset($_SESSION['customer_code'])) {
    Get_User_Details::Get_Customer_Code();
}
$POST_INSERT = 'yes'; //to hide  add post button in this page
if (isset($_SESSION['temprary_post_id'])) {
    unset($_SESSION['temprary_post_id']);
}

include '../../../routes.php';
if (isset($_POST['next-step-two'])) {
    header('Location:' . get_url() . 'u/post-promote/' . $_GET['post_id']);
}
if (isset($stopthefurtherprocess)) {
    if ($stopthefurtherprocess == true) {
        $result = Get_User_Details::Get_ad_detail($_GET['post_id']);
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>SKOKRA - User Dashboard</title>
    <style>
        html,
        body {
            color: #36454F;
        }

        .preview-image-box-grid {
            display: grid;

            grid-template-columns: repeat(5, minmax(20%, 1fr));
            grid-auto-rows: 250px;
            justify-content: space-between;
            /* grid-template-rows: auto; */
            column-gap: 5px;
        }

        .crop-the-image-container {
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            place-items: center;
        }

        .preview-the-image {
            width: 400px;
            height: 400px;
            background-color: lightgrey;
        }

        .preview-the-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .multiline-ellipsis {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            /* start showing ellipsis when 3rd line is reached */
            white-space: pre-wrap;
            margin: 1% 0;
            /* let the text wrap preserving spaces */
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

    <form action="" method="POST">
        <div class="step-two">
            <div class="container">
                <a href="<?= get_url() ?>u/post-update/<?= $_GET['post_id'] ?>"><small><i class="ri-edit-box-line"></i> Edit Your Ad</small></a>
                <div class="form-container">
                    <div class="form-flex2">
                        <p class="multiline-ellipsis"><strong>Title : </strong><?= $result['title'] ?></p>
                    </div>
                    <div class="form-flex2" style="flex-wrap: nowrap;">
                        <p class="multiline-ellipsis"> <strong>Text : </strong><?= $result['description'] ?></p>
                    </div>
                    <div class="form-flex2">
                        <?= $result['age'] ?> Years | <?php $category = '';
                                                        $cat = explode('-', $result['category']);
                                                        for ($i = 0; $i < count($cat); $i++) {
                                                            if ($i == count($cat)) {
                                                                $category  .= ucfirst($cat[$i]);
                                                            } else {
                                                                $category .= ucfirst($cat[$i]) . ' ';
                                                            }
                                                        }
                                                        echo $category; ?> |<i class="ri-map-pin-line"></i> <?= $result['city'] ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <input type="file" name="drag-and-drop-profile-photo" hidden id="replace-the-selected-profile-photo">
                <label for="">Your Photos</label>
                <div class="form-container">
                    <div class="form-group">
                        <div class="preview-drap-or-selected-image">

                            <!-- display none is added to the below class -->
                            <div class="preview-image-box-grid" id="preview-image-box-grid">

                                <!-- resized-drop-area is the class to be added below to make it small and responsive -->
                            </div>
                            <div class="drag-and-drop-profile-photo " id="drag-and-drop-profile-photo">
                                <input type="file" name="drag-and-drop-profile-photo" hidden id="draged-or-selected-profile-photo" multiple>
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
                <button class="next-step" id="next-step-two" name="next-step-two">GO ON</button>
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

    <div class="crop-the-image-container" id="crop-the-image-container">
        <div>
            <div class="preview-the-image" id="preview-the-image">
                <img src="" id="preview_image_to_crop" alt="">
            </div>
            <button id='crop-button'>Crop</button>
            <button id="close_the_preview">Back</button>
        </div>
    </div>

    <div class="container"><?php include '../../../footer.php' ?></div>
    <?php include '../private-area.php' ?>

    <script>
        let count = 1


        const dropZone = document.getElementById('drag-and-drop-profile-photo');

        dropZone.addEventListener('click', () => {
            document.getElementById('draged-or-selected-profile-photo').click()
        })

        // function OnClick() {
        //     event.stopPropagation();
        //     document.getElementById('draged-or-selected-profile-photo').click();
        //     console.log('clicked for image selection');
        // }

        document.getElementById('draged-or-selected-profile-photo').addEventListener('change', (e) => {

            HandelImageUploading(e.target.files)
        })

        dropZone.addEventListener('dragover', PREVENTDefalut, false)
        // dropZone.addEventListener('drop', PREVENTDefalut, false)
        dropZone.addEventListener('dragleave', PREVENTDefalut, false)

        function PREVENTDefalut() {
            event.preventDefault();
            event.stopPropagation();
        }

        // function droptheimage() {
        //     event.preventDefault();
        //     event.stopPropagation();
        //     HandelImageUploading(event.dataTransfer.files)
        //     // event.dataTransfer.clearData();
        // }
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            HandelImageUploading(e.dataTransfer.files)
            e.dataTransfer.clearData()
        }, false)

        function HandelImageUploading(imageupload) {

            const image = new FormData()
            image.append('image', imageupload[0])
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            fetch('https://cdn.skokra.com/image-upload.php', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                // document.getElementById('draged-or-selected-profile-photo').value = '';
                document.getElementById('preview-image-box-grid').innerHTML = '';
                if (d['status'] == true) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                }
            })
        }

        // ShowPreviewImage('<?= $_SESSION['email'] ?>')

        function ShowPreviewImage(identifications) {
            const identification = new FormData()
            identification.append('i', identifications)
            identification.append('pi', '<?= $_GET['post_id'] ?>')
            fetch('<?= get_url() ?>show-image', {
                method: 'post',
                body: identification
            }).then(res => res.json()).then(data => { 

                // document.getElementById('drag-and-drop-profile-photo').classList.add('resized-drop-area')
                // document.getElementById('preview-image-box-grid').innerHTML = '';
                document.getElementById('preview-image-box-grid').innerHTML = data['output'];
                // document.getElementById('preview-image-box-grid').innerHTML += '<div class="drag-and-drop-profile-photo preview-image-box" onclick="OnClick()" ondragleave="PREVENTDefalut(this)" ondragover="PREVENTDefalut(this)" ondrop="droptheimage(this)" id="drag-and-drop-profile-photo"><input type="file" name="drag-and-drop-profile-photo" id="draged-or-selected-profile-photo" hidden multiple><div><p style="text-transform: uppercase;">you can upload upto 10 pictures </p><p><i class="ri-camera-fill"></i></p><p>Drag the picture here or click to select them</p></div></div>';
                AddPreview_image()
            })
        }
        let cropper;

        function CropTheImage(id) {

            let preview = document.getElementById('skokracroped' + id).src;

            document.getElementById('crop-the-image-container').style.display = 'grid'

            document.getElementById('preview_image_to_crop').src = '';

            document.getElementById('preview_image_to_crop').src = preview;


            CropFunction()

        }

        function CropFunction() {
            prev = document.getElementById('preview_image_to_crop')
            const cropperOptions = {
                aspectRatio: 1 / 1, // Aspect ratio of the crop box (square)
                viewMode: 2, // Displayed image covers the crop box
                dragMode: 'move', // Can only move the crop box
                autoCropArea: 1, // Always create a 100% crop box
                movable: false, // Disable dragging
                zoomable: false, // Disable zooming
                rotatable: false, // Disable rotating
                scalable: false // Disable scaling
            };
            cropper = new Cropper(prev, cropperOptions);
        }

        document.getElementById('crop-button').addEventListener('click', function(e) {
            e.preventDefault()
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Set width of the output image
                height: 200 // Set height of the output image
            });

            // Convert the canvas to base64 data URL
            const croppedImage = croppedCanvas.toDataURL();

            // Do something with the croppedImage, for example, upload it to the server
            // Here you can use AJAX to send the croppedImage to the server
            const img = new FormData()
            img.append('image', croppedImage)
            img.append('imageName', document.getElementById('preview_image_to_crop').src)
            fetch('<?= get_url() ?>croptheimage', {
                    method: 'POST',
                    body: img
                })
                .then(response => response.json())
                .then(data => {
                    if (data['status'] == 200) {
                        ShowPreviewImage('<?= $_SESSION['email'] ?>');
                        document.getElementById('crop-the-image-container').style.display = 'none';
                        cropper.destroy();
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('close_the_preview').addEventListener('click', () => {
            document.getElementById('crop-the-image-container').style.display = 'none';
            document.getElementById('preview_image_to_crop').src = '';
            cropper.destroy();
        })

        // DELETING THE IMAGE FUNCTION
        function DeleteImage(pi, i) {
            const image = new FormData()
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            image.append('i', i)
            fetch('<?= get_url() ?>delete-image', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                if (d['status'] == 200) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                } else {
                    alert('image not deleted')
                }
            })
        }
        // DELETING THE IMAGE FUNCTION

        // REUPLOADING THE IMAGE pi->post-id--i->id
        let image_i;

        function ReuploadImage(pi, i) {
            document.getElementById('replace-the-selected-profile-photo').click()
            image_i = i
        }
        document.getElementById('replace-the-selected-profile-photo').addEventListener('change', (e) => {
            const image = new FormData()
            image.append('image', e.target.files[0])
            image.append('e', '<?= $_SESSION['email'] ?>')
            image.append('pi', '<?= $_GET['post_id'] ?>')
            image.append('i', image_i)
            fetch('<?= get_url() ?>image-upload', {
                method: 'POST',
                body: image
            }).then(res => res.json()).then(d => {
                document.getElementById('draged-or-selected-profile-photo').value = '';
                document.getElementById('preview-image-box-grid').innerHTML = '';
                if (d['status'] == true) {
                    ShowPreviewImage('<?= $_SESSION['email'] ?>')
                }
            })
        })

        function AddPreview_image() {
            let preview_image_box = document.querySelectorAll('.preview-image-box')
            let preview_image = document.querySelectorAll('.preview-tag')
            let skokracroped = document.querySelectorAll('.skokracropedX')
            preview_image_box.forEach((imagex, i) => {
                imagex.addEventListener('click', (e) => {
                    let data = new FormData();
                    data.append('activity', 'preview');
                    data.append('post_', '<?= $_GET['post_id'] ?>');
                    data.append('i', skokracroped[i].src);
                    fetch('<?= get_url() ?>u/activity-center', {
                        method: 'POST',
                        body: data
                    }).then(response => response.json()).then(value => {
                        if (value['success4'] == 'success4') {
                            preview_image.forEach(img => {
                                img.style.backgroundColor = 'grey';
                            })
                            preview_image[i].style.backgroundColor = 'dodgerblue';
                        }
                    })

                })
            })
        }

        // REUPLOADING THE IMAGE

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('open-private-area').addEventListener('click', () => {
                document.getElementById('private-area-background').style.display = 'grid'
            })
        })
    </script>



</body>

</html>