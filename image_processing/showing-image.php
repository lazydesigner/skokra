<?php
session_start();
include '../backend/user_task.php';
// $con = mysqli_connect('localhost', 'root', '', 'skokra');
$con = mysqli_connect('localhost', 'u231955561_inskokra', 'Skokra@12com', 'u231955561_in_skokra');
if (!$con) {
    die('failed to connect');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['i'];
    $query = 'SELECT * FROM users WHERE email = ?';
    $stmt = mysqli_prepare($con, $query);
    $stmt->bind_param("s", $email);  // Bind the parameter (s - string)
    $stmt->execute();
    $result = $stmt->get_result();
    // $result->store_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_code = $row['customer_code']; // Fetch a result row as an associative array.
        $post = 'SELECT images, preview_image from profiles_ad where adid = ?';
        $stmtt = mysqli_prepare($con, $post);
        $code =$customer_code . '_in' . $_POST['pi'];
        $stmtt->bind_param('s', $code); //Bind the customer code with post id
        $stmtt->execute(); // Execute the prepared query.

        $result2 = $stmtt->get_result();
        if ($result2->num_rows > 0) {
            $image = $result2->fetch_assoc();
            $output = '';
            $img = json_decode($image['images'], true);
            $image_count = 0;

            foreach ($img as $id=>$value) {
                if($image_count == 0){
                    $pr = '<div class="preview-tag"><i class="ri-star-fill"></i> Preview</div>';
                    $l = '<div class="lock-img" id="lock-img" style="background-color:transparent"></div>';

                    if(isset($_POST['up_img'])){
                        $pre_img_view = $image['preview_image'];
                    }else{
                        $pre_img_view ='https://cdn.skokra.com/secure-images/'.$value.'';
                        if(Get_User_Details::Set_Preview_img($_POST['pi'] , 'https://cdn.skokra.com/secure-images/'.$value)){}else{}
                    }
                    
                }else{
                    $pr = '<div class="preview-tag" style="background-color:grey;"><i class="ri-star-fill"></i> Preview</div>';
                    $l = '<div class="lock-img" id="lock-img"><i class="ri-lock-2-line"></i></div>';
                }
                $output .= '
                    <div class="preview-image-box">                       
                       '.$pr.'
                        <div class="preview-image">'.$l.'<img src="'.$pre_img_view.'" class="skokracropedX" id="skokracroped'.$id.'" width="100%" height="100%" alt="skokra image collection"></div>
                        <div class="edit-preview-img">
                            <div class="crop" onclick="CropTheImage('.$id.')"><i class="ri-crop-line"></i></div>
                            <div class="reupload" onclick="ReuploadImage(\''.$_POST['pi'].'\','.$id.')"><i class="ri-loop-left-line"></i></div>
                            <div class="delete" onclick="DeleteImage(\''.$_POST['pi'].'\','.$id.')"><i class="ri-delete-bin-5-line"></i></div>
                        </div>
                    </div>
                ';
                $image_count +=1 ;
            }

        //     $output .= '<div class="drag-and-drop-profile-photo resized-drop-area" id="drag-and-drop-profile-photo">
        //     <input type="file" name="drag-and-drop-profile-photo" hidden id="draged-or-selected-profile-photo" multiple>
        //     <div>
        //         <p style="text-transform: uppercase;">you can upload upto 10 pictures </p>
        //         <p><i class="ri-camera-fill"></i></p>
        //         <p>Drag the picture here or click to select them</p>
        //     </div>
        // </div>';

            echo json_encode(['output'=>$output,'count'=>count($img)]);
        }
    } else {
        echo json_encode(['status' => 209]);
    }
}
