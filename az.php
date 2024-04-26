<?php
include './backend/user_task.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $i = explode('_',$_POST["id"]);
    $plan = Get_User_Details::Get_Single_Plane_table(intval($i[1]));  //get the details of a single plane from database using
    $plan = json_decode($plan, true);
    $plan = $plan[0];
    $cost_of_token = $plan['cost_of_token'];
    $credits = '';
    $price = '';
    if(isset($_POST['sid'])){
        $price = ($plan['super_top_ad']+$plan['number_of_credits']) * $cost_of_token;
        $credits = $plan['super_top_ad']+$plan['number_of_credits'];
    }else{
        $price = $plan['number_of_credits']*$cost_of_token;
        $credits = $plan['number_of_credits'];
    }


    echo json_encode(['cost'=>$price,'credit'=>$credits]);
}


?>
