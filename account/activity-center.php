<?php
session_start();

$path =  $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';

if (file_exists($path)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/user_task.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/backend/user_task.php';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['activity'] == 'del') {
        if (Get_User_Details::Delete_Post($_POST['post_'])) {
            echo json_encode(['success' => 'success']);
        } else {
            echo json_encode(['success' => 'failed', 'a' => $_SESSION['customer_code']]);
        }
    } elseif ($_POST['activity'] == 'sus') {
        if (Get_User_Details::Suspend_Post($_POST['post_'])) {
            echo json_encode(['success2' => 'success2']);
        } else {
            echo json_encode(['success' => 'failer']);
        }
    } elseif ($_POST['activity'] == 'unsus') {
        if (Get_User_Details::Un_Suspend_Post($_POST['post_'])) {
            echo json_encode(['success3' => 'success3']);
        } else {
            echo json_encode(['success' => 'failer']);
        }
    } elseif ($_POST['activity'] == 'preview') {
        if (Get_User_Details::Set_Preview_img($_POST['post_'], $_POST['i'])) {
            echo json_encode(['success4' => 'success4']);
        } else {
            echo json_encode(['success' => 'failer']);
        }
    } elseif ($_POST['activity'] == "dup") {
        if (Get_User_Details::Duplicate_Ad($_POST['post_'])) {
            echo json_encode(['success5' => 'success5']);
        } else {
            echo json_encode(['success' => 'failer']);
        }
    } elseif ($_POST['activity'] == 'statesd') {
        $cityf = Get_User_Details::Get_Cities_detail($_POST['state'])[0];
        $city = '<option value="">All the Cities</option>';
        
        if(is_string($cityf['cities'])){
            $cty = json_decode($cityf['cities'], true);
        }else{
            $x = json_encode($cityf['cities']);
            $cty = json_decode($x, true);
        }
        
        foreach($cty as $ct){
            $city .= '<option value="'.strtolower($ct).'">'.ucwords($ct).'</option>';
        }
        echo json_encode($city);
    }elseif ($_POST['activity'] == 'story') {
        $ad = Get_User_Details::Get_ad_detail($_POST['storyId']);
        echo json_encode($ad);
    }
} else {
    echo json_encode(['a' => 'a']);
}
