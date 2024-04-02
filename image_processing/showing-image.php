<?php
$con = mysqli_connect('localhost', 'root', '', 'skokra');
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
        $post = 'SELECT images from profiles_ad where adid = ?';
        $stmtt = mysqli_prepare($con, $post);
        $code =$customer_code . '_in' . $_POST['pi'];
        $stmtt->bind_param('s', $code); //Bind the customer code with post id
        $stmtt->execute(); // Execute the prepared query.

        $result2 = $stmtt->get_result();
        if ($result2->num_rows > 0) {
            $image = $result2->fetch_assoc();
            $output = '';
            $img = json_decode($image['images'], true);
            
            foreach ($img as $id=>$value) {
                $output .= '
                    <div class="preview-image-box">
                       
                        <div class="preview-tag"><i class="ri-star-fill"></i> Preview</div>
                        <div class="preview-image"><img src="http://localhost/skokra.com/secure-images/'.$value.'" id="skokracroped'.$id.'" width="100%" height="100%" alt="skokra image collection"></div>
                        <div class="edit-preview-img">
                            <div class="crop" onclick="CropTheImage('.$id.')"><i class="ri-crop-line"></i></div>
                            <div class="reupload" onclick="ReuploadImage(\''.$_POST['pi'].'\','.$id.')"><i class="ri-loop-left-line"></i></div>
                            <div class="delete" onclick="DeleteImage(\''.$_POST['pi'].'\','.$id.')"><i class="ri-delete-bin-5-line"></i></div>
                        </div>
                    </div>
                ';
            }
            echo json_encode(['output'=>$output]);
        }
    } else {
        echo json_encode(['status' => 209]);
    }
}
