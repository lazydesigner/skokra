<?php
// DELETE FILE WHEN IT IS NOT IN USED
$login_page = 'yes';
include './routes.php';
include './backend/user_task.php';

// print_r(Get_User_Details::Scheduled_Ad_Time('00:00:00', '09:00:00'));
// print_r(Get_User_Details::Show_Super_Top_Ads())


// /usr/bin/php /home/u231955561/domain/skokra.com/public_html/schedule-time_for_ad.php
// wget -O /dev/null https://in.skokra.com/cron/cron-one.php
// wget -O /dev/null https://in.skokra.com/cron/cron-two.php
// wget -O /dev/null https://in.skokra.com/cron/cron-three.php
// wget -O /dev/null https://in.skokra.com/cron/cron-four.php
// wget -O /dev/null https://in.skokra.com/cron/cron-five.php
// wget -O /dev/null https://in.skokra.com/cron/cron-six.php
// wget -O /dev/null https://in.skokra.com/cron/cron-seven.php 
 

echo 'Running...<br>';

function runFunctionNearDefinedTime($definedTime, callable $functionToRun, $i) {
    // Convert defined time to a timestamp
    $definedTimestamp = strtotime($definedTime);
    
    // Get current timestamp
    $currentTimestamp = time();
    
    // Calculate the difference in seconds between current time and defined time
    $differenceInSeconds = $definedTimestamp - $currentTimestamp;
    
    // Check if the difference is less than or equal to 60 seconds (1 minute)
    if ($differenceInSeconds <= 60 && $differenceInSeconds > 0) {
        // If so, execute the function
        if($i == 0){
            $s = '09:00:00';
            $e = '12:00:00';
        }elseif($i == 1){
            $s = '12:00:00';
            $e = '15:00:00';
        }elseif($i == 2){
            $s = '15:00:00';
            $e = '18:00:00';
        }elseif($i == 3){
            $s = '18:00:00';
            $e = '20:00:00';
        }elseif($i == 4){
            $s = '20:00:00';
            $e = '22:00:00';
        }elseif($i == 5){
            $s = '22:00:00';
            $e = '00:00:00';
        }elseif($i == 6){
            $s = '00:00:00';
            $e = '09:00:00';
        }
        call_user_func($functionToRun, $s, $e);
    }
}

// Define the function to run when the time is near
function myFunctionToRun($s, $e) {
    if(Get_User_Details::Scheduled_Ad_Time($s, $e)){
        echo "Working";
    }else{
        echo 'Not Working';
    }
}

$array_of_time = ['08:59:00', '11:59:00', '14:59:00', '17:59:00', '19:59:00', '21:59:00', '23:59:00'];

// Define the time you want to check

foreach( $array_of_time as $i => $value ){
    runFunctionNearDefinedTime($value, 'myFunctionToRun',$i);
}

// Call the function to check if the defined time is near





?>
