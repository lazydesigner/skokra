<?php
session_start();
include '../routes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['image']['error'] === 0) {

        $maxFileSize = 100 * 1024; // 100KB in bytes
        if ($_FILES["image"]["size"] <= $maxFileSize) {}

        $watermarkImagepath = get_url() . 'assets/images/SKOKRA+LOGO+NEW+(2).webp.png';
        $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp") {
            echo json_encode(['error_msg' => 'File Type Image is Required']);
        } else {
            $target = '../uploads/';

            move_uploaded_file($_FILES['image']['tmp_name'], $target . basename($_FILES['image']['name']));

            // creating image resource from image data
            $image = imagecreatefromstring(file_get_contents($target . basename($_FILES['image']['name'])));
            #creating empty canva
            $NewImage = imagecreatetruecolor(imagesx($image), imagesy($image));

            imagecopy($NewImage, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagejpeg($NewImage, $target . basename($_FILES['image']['name']), 100);
            imagedestroy($image);
            imagedestroy($NewImage);

            // opening the jpeg image
            // Adding watermark to an image
            $sourceImage = imagecreatefromjpeg($target . basename($_FILES['image']["name"]));
            $watermarkImage = imagecreatefrompng($watermarkImagepath);

            $sourceImagewidth = imagesx($sourceImage);
            $sourceImageheight = imagesy($sourceImage);
            $watermarkImagewidth = imagesx($watermarkImage);
            $watermarkImageheight = imagesy($watermarkImage);

            $positionX = ($sourceImagewidth - $watermarkImagewidth) / 2;
            $positionY = ($sourceImageheight - $watermarkImageheight) / 2;

            imagecopy($sourceImage, $watermarkImage, $positionX, $positionY, 0, 0, $watermarkImagewidth, $watermarkImageheight);
            imagejpeg($sourceImage, $target . basename($_FILES['image']['name']));
            imagedestroy($sourceImage);
            imagedestroy($watermarkImage);

            // converting image to webp 

            $destinationPath = $target . uniqid('skokra_') . '.webp';

            $image = imagecreatefromstring(file_get_contents($target . basename($_FILES['image']['name'])));
            imagewebp($image, $destinationPath, 90);
            imagedestroy($image);
            if (file_exists($destinationPath)) {
                unlink($target . basename($_FILES['image']['name']));
                
                if (isLocalhost()) {
                    $con = mysqli_connect('localhost', 'root', '', 'skokra');
                }else{
                    $con = mysqli_connect('localhost', 'u231955561_inskokra', 'Skokra@12com', 'u231955561_in_skokra');
                }
                
                if (!$con) {
                    die('failed to connect'.mysqli_connect_error());
                }
                $array_of_image = [];
                $array_of_image[] = basename($destinationPath);

                $query = 'SELECT * FROM users WHERE email = ?';
                $stmt = mysqli_prepare($con, $query);
                $stmt->bind_param("s", $_POST['e']);  // Bind the parameter (s - string)
                $stmt->execute();
                $result = $stmt->get_result();
                // $result->store_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $customer_code = $row['customer_code'];

                    // Selecting Profile Image from database
                        $selectimg = 'SELECT images FROM profiles_ad WHERE adid = ? ';
                        $select_result = mysqli_prepare($con, $selectimg);
                        $code =$customer_code . '_in' . $_POST['pi'];
                        $select_result->bind_param('s', $code);
                        $select_result->execute();
                        $selected_img = $select_result->get_result();
                        $selected_row = $selected_img->fetch_assoc();

                        if($selected_row['images'] != null){
                            $converting_selected_row = json_decode($selected_row['images'],true);

                            if(isset($_POST['i'])){
                                $converting_selected_row[$_POST['i']] = basename($destinationPath);
                            }else{
                                $converting_selected_row[] = basename($destinationPath);
                            }

                            

                            $img = json_encode($converting_selected_row);
                        }else{
                            $img = json_encode($array_of_image);
                        }

                        // Selecting Profile Image from database


                    $save_image = "UPDATE `profiles_ad` SET `images` = ? WHERE `adid` = ? ";
                $res = mysqli_prepare($con, $save_image);
                $code =$customer_code . '_in' . $_POST['pi'];
                $res->bind_param('ss', $img, $code);
                $res->execute();
                if ($res) {
                    if ($res->affected_rows > 0) {
                        echo json_encode(['status' => true, 'message' => 'Image Uploaded Successfully', 'data' => basename($destinationPath)]);
                    } else {
                        unlink($destinationPath);
                        echo json_encode(['status' => false, 'message' => 'Image Not Uploaded Successfully', 'data' => $img,'a'=>$code,'c'=>mysqli_error($con)]);
                    }
                } else {
                    unlink($destinationPath);
                    echo json_encode(['status' => false, 'message' => 'Image Uploaded Unsuccessfully', 'data' => $destinationPath]);
                }
                }

                
            } else {
                echo json_encode(['status' => false, 'message' => 'Image Uploaded Unsuccessfully', 'data' => $destinationPath]);
            }
        }

        // echo json_encode($_FILES['image']);

        // $temp_name = $_FILES["image"]["tmp_name"];
    } else {
        echo json_encode(['error' => 'no image found']);
    }
} else {
    echo json_encode(['error' => 'no image found 2']);
}
