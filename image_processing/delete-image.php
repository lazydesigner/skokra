<?php

$con = mysqli_connect('localhost', 'root', '', 'skokra');
if (!$con) {
    die('failed to connect');
}


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
    $code = $customer_code . '_in' . $_POST['pi'];
    $select_result->bind_param('s', $code);
    $select_result->execute();
    $selected_img = $select_result->get_result();
    $selected_row = $selected_img->fetch_assoc();

    if ($selected_row['images'] != null) {
        $converting_selected_row = json_decode($selected_row['images'], true);
        unlink('../uploads/' . $converting_selected_row[$_POST['i']] . '');
        unset($converting_selected_row[$_POST['i']]);

        if (isset($converting_selected_row[$_POST['i']])) {

            if (file_exists($converting_selected_row[$_POST['i']])) {
            } else {
                echo json_encode(['status' => 200,'a'=>$converting_selected_row[$_POST['i']],'c'=>'ok']);
                exit;
            }
        }else{
            $img = json_encode($converting_selected_row);
            $save_image = "UPDATE `profiles_ad` SET `images` = ? WHERE `adid` = ? ";
                $res = mysqli_prepare($con, $save_image);
                $code =$customer_code . '_in' . $_POST['pi'];
                $res->bind_param('ss', $img, $code);
                $res->execute();
                if ($res) {
                    if ($res->affected_rows > 0) {
                        echo json_encode(['status' => 200]);
                        exit;
                    }
                }                
        }
    }
}
