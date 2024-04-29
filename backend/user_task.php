<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';

if (file_exists($path)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/skokra.com/backend/connection.php';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/connection.php';
}

class Get_User_Details
{

    public static function Get_Customer_Code()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query_customer_code = $con->prepare("SELECT `user_id`,`customer_code` FROM users WHERE email = ?");

        if ($query_customer_code->execute([$_SESSION['email']])) {
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
            $_SESSION['customer_code'] = $res['customer_code'];
            $_SESSION['user_identification'] = $res['user_id'];
        } else {
            $_SESSION['customer_code'] =  "XXXXXXXXXX";
        }
    }
    public static function Get_Customer_Details()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query_customer_code = $con->prepare("SELECT * FROM users WHERE email = ?");

        if ($query_customer_code->execute([$_SESSION['email']])) {
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
            return $res;
        } else {
            header("Location: " . get_url() . "login");
        }
    }

    public static function verifyPhoneNumber($number)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $phone = $con->prepare('SELECT * FROM phone_verification WHERE  phone_number = :number');
        $phone->bindParam(':number', $number);
        if ($phone->execute()) {
            $phone_row = $phone->fetch(PDO::FETCH_ASSOC);
            if ($phone_row) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function addPhoneNumber($number)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $insertphonenumber = $con->prepare("INSERT INTO `phone_verification`(`phone_number`,`verification`) VALUE(?, ?)");
        if ($insertphonenumber->execute([$number, 1])) {
            if ($insertphonenumber->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function Recaptcha()
    {
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public static function OTP_Generator($phone_number)
    {
        if (isset($_SESSION['OTP_V'])) {
            unset($_SESSION['OTP_V']);
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
            if (self::SEND_SMS($phone_number, $OTP)) {
                return true;
            } else {
                return false;
            }
        } else {
            $OTP = rand(1000, 9999);
            $_SESSION['OTP_V'] = $OTP;
            if (self::SEND_SMS($phone_number, $OTP)) {
                return true;
            } else {
                return false;
            }
        }
    }


    public static function SEND_SMS($phone, $otp)
    {
        $fields = array(
            "variables_values" => "$otp",
            "route" => "otp",
            "numbers" => "$phone",
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: vWO4VFPtoZ3g1wSd6KBpT5n8GkuReNazifcbY7mMU0DxEHrLXC6m3fFdTe80JocVbIzKD5wg4p9OSANj",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            unset($_SESSION["OTP_V"]);
            return false;
        } else {
            $data = json_decode($response);
            $s = $data->return;
            if ($s == false) {
                unset($_SESSION["OTP_V"]);
                $err = $data->message;
                return false;
                // echo '{"msg":"'.$err.'"}';
            } else {
                $ses = $data->message;
                return true;
                // echo '{"msg":"1"}';
            }
        }
    }


    public static function AdInsert($category, $state, $city, $address, $area, $age, $title, $description, $african_ethnicity, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service, $price, $payment_method, $contact, $email, $ad_phone_number, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        //checking the user is already registered

        $query = "INSERT INTO profiles_ad(adid,category,city,address,area,age,title,description,african_ethnicity,nationality,boobs,hair,body_type,services,attention_to,place_of_service,price, payment_method,contact,email,ad_phone_number,whatsapp_enable,terms_and_condition,orgination_enable,website_name,orgination_name,website_url,user_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $adid = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $code = '';
        $length = 25;

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        $adid = $_SESSION['customer_code'] . '_in' . $code;
        $_SESSION['temprary_post_id'] = $code;

        $insertad = $con->prepare($query);
        $insertad->execute([$adid, $category, $state, $city, $address, $area, $age, $title, $description, $african_ethnicity, $nationality, $boobs, $hair, $body_type, $services, $attention_to, $place_of_service, $price, $payment_method, $contact, $email, $ad_phone_number, $whatsapp_enable, $terms_and_condition, $orgination_enable, $website_name, $orgination_name, $website_url, $_SESSION['user_identification']]);

        if ($insertad->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Check_Ad_Owner($post_id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT `ad_complete`  FROM profiles_ad WHERE adid = ? AND email = ?");
        $query->execute([$_SESSION['customer_code'] . '_in' . $post_id, $_SESSION['email']]);
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result['ad_complete'] == 1) {
                header('Location:' . get_url() . 'u/account/ads/');
            } else {
                return true;
            }
        } else {
            header('Location:' . get_url() . 'u/account/dashboard/');
        }
    }

    public static function Get_ad_detail($post_id)
    {

        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT * FROM profiles_ad WHERE adid = ?");
        $query->execute([$_SESSION['customer_code'] . '_in' . $post_id]);
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } else {
            header('Location:' . get_url() . 'u/account/dashboard/');
        }
        // if()
    }
    public static function Get_Full_ad_detail()
    {

        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT * FROM profiles_ad WHERE email = ? AND ad_complete = ? ");
        $query->execute([$_SESSION['email'], 1]);
        if ($query->rowCount() > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } else {
            return [];
        }
        // if()
    }
    // FOR EVERY ONE below TIME_FORMAT(end_time, '%H:%i:%s')
    public static function Get_Supertop_ads_detail($start, $end)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT * FROM profiles_ad WHERE top_ad = 1 AND starting_time >= ? AND end_time <= ? AND `ad_complete` = ?");
        $query->execute([$start, $end, 1]);
        if ($query->rowCount() > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                if ($row['n_d_a_s_c'] == 1 || $row['n_d_a_s_c'] < 1) {
                    $update_q = $con->prepare("UPDATE profiles_ad SET top_ad = 0, supertop_ad = 0, n_t_a_s_c_f = 0, n_d_a_s_c = 0 WHERE post_id = ?");
                    $update_q->execute([$row['post_id']]);
                } else {
                    $new_date = (int)$row['n_d_a_s_c'] - 1;
                    $update_q2 = $con->prepare("UPDATE profiles_ad SET n_d_a_s_c = ? WHERE post_id = ?");
                    $update_q2->execute([$new_date, $row['post_id']]);
                }
                $results[] = $row;
            }
            if (!empty($results)) {

                return $results;
            } else {
                return [];
            }
        } else {
            return [];
        }
        // if()
    }
    // FOR EVERY ONE above

    public static function scheduleAds($adList, $startTime, $endTime, $adRepeatLimit)
    {
        $totalAds = count($adList);
        $adCycleCount = $adRepeatLimit * $totalAds;

        // Calculate the time duration of each slot
        $slotDuration = ($endTime->getTimestamp() - $startTime->getTimestamp()) / $adCycleCount;

        // Initialize an array to store scheduled ads
        $scheduledAds = [];

        // Initialize an array to store the index of the next ad to be scheduled
        $nextAdIndex = 0;

        $currentTime = $startTime->getTimestamp();
        for ($i = 0; $i < $adCycleCount; $i++) {
            // Calculate the index of the current ad in the list
            $adIndex = $i % $totalAds;
            // Get the ad ID from the list
            $adId = $adList[$adIndex];

            // Schedule the ad at the current time
            $scheduledAds[] = [$adId, $currentTime];

            // Move to the next time slot
            $currentTime += $slotDuration;
        }
        return $scheduledAds;
    }

    public static function Scheduled_Ad_Time($s, $e)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $startTime = new DateTime($s);
        $endTime = new DateTime($e);
        $result = self::Get_Supertop_ads_detail($s, $e);
        if(count($result) != 0){
         
        // if($result['ad_shift'] == 'day')   { $rep = 5 ;}else{ $rep = 10; } 
           
        $adList = range(1, count($result)); 
        $scheduledAds = self::scheduleAds($adList, $startTime, $endTime, 5); 
        $InsertSchedule2 = $con->prepare("DELETE FROM  `ads_slot_time`");
        $InsertSchedule2->execute();
        foreach ($scheduledAds as  $scheduledAd) {
            $adid = $result[($scheduledAd[0] - 1)]['adid'];
            $scheduledtime = date('H:i', $scheduledAd[1]);

            $InsertSchedule = $con->prepare("INSERT INTO `ads_slot_time`(`ad_id`, `scheduled_time`) VALUES (?, ?)");
            $InsertSchedule->execute([$adid, $scheduledtime]);
            if ($InsertSchedule) {
                if ($InsertSchedule->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }}
    }

    public static function Get_Full_Paused_ad_detail()
    {

        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT * FROM profiles_ad WHERE email = ? AND suspend = ? AND ad_complete = ? ");
        $query->execute([$_SESSION['email'], 1, 1]);
        if ($query->rowCount() > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return false;
            }
        } else {
            return [];
        }
        // if()
    }

    public static function Get_Plane_table()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("SELECT * FROM `ad_plans`");
        $plan->execute();
        if ($plan->rowCount() > 0) {
            return $plan;
        }
    }

    public static function Update_User_Tokens($token, $purpose)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $query_customer_code = $con->prepare("SELECT `total_token_left`,`total_token_used` FROM users WHERE email = ?");

        if ($query_customer_code->execute([$_SESSION['email']])) {
            $res = $query_customer_code->fetch(PDO::FETCH_ASSOC);
        }
        if ($purpose == 'negative') {

            if ((int)$res['total_token_left'] <= 0) {
                return false;
                exit();
            } else {
                $new_token = (int)$res['total_token_left'] - (int)$token;
                $token_used = (int)$res['total_token_used'] + (int)$token;
            }
        } else {
            $new_token = (int)$res['total_token_left'] + (int)$token;
            $token_used = (int)$res['total_token_used'];
        }

        $query = "UPDATE users SET `total_token_left` = ?, `total_token_used` = ? WHERE  email = ?";
        $sql = $con->prepare($query);
        $sql->execute([$new_token, $token_used, $_SESSION['email']]);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Get_Single_Plane_table($id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("SELECT * FROM `ad_plans` WHERE `ad_plan_id` = ? ");
        $plan->execute([$id]);
        if ($plan->rowCount() > 0) {
            $data = $plan->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($data);
        }
    }

    public static function Update_Post_Ad(array $fields, $table, $post_id, $customer_code, $token)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $index = 0;
        $sql = "UPDATE " . $table . " SET  ";
        $values = [];
        foreach ($fields as $name => $value) {
            if ($index == (count($fields) - 1)) {
                $sql .= $name . " = ?";
            } else {
                $sql .= $name . " = ?,";
            }
            $values[] = $value;
            $index += 1;
        }
        $sql .= "WHERE `adid` = ? ";
        $values[] = "" . $customer_code . "_in" . $post_id;
        // print_r($values);
        if ($token == 0) {
            $query = $con->prepare($sql);
            $query->execute($values);
            if ($query) {
                if ($query->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            $deduct_token = self::Update_User_Tokens($token, 'negative');
            if ($deduct_token) {
                $query = $con->prepare($sql);
                $query->execute($values);
                if ($query) {
                    if ($query->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }


    public static function Delete_Post($post_id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("DELETE FROM `profiles_ad` WHERE adid = ? ");
        $plan->execute([$_SESSION['customer_code'] . '_in' . $post_id]);
        if ($plan->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Suspend_Post($post_id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("UPDATE `profiles_ad` SET suspend = 1 WHERE adid = ? ");
        $plan->execute([$_SESSION['customer_code'] . '_in' . $post_id]);
        if ($plan->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Un_Suspend_Post($post_id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("UPDATE `profiles_ad` SET suspend = 0 WHERE adid = ? ");
        $plan->execute([$_SESSION['customer_code'] . '_in' . $post_id]);
        if ($plan->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Set_Preview_img($post_id, $img)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $plan = $con->prepare("UPDATE `profiles_ad` SET preview_image = ? WHERE adid = ? ");
        $plan->execute([$img, $_SESSION['customer_code'] . '_in' . $post_id]);
        if ($plan->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Duplicate_Ad($post_id)
    {

        $database = new DatabaseConnection();
        $con = $database->getConnection();
        //checking the user is already registered

        $duplicate = $con->prepare('SELECT * FROM  profiles_ad WHERE adid=?');
        // $duplicate->bin(1,);
        $duplicate->execute([$_SESSION['customer_code'] . '_in' . $post_id]);

        if (!$duplicate || $duplicate->rowCount() == 0) {
            return false;
            exit();
        } else {
            $currentDate = new DateTime();
            $currentDate->modify('+15 days');
            $formattedDate = $currentDate->format('F j, Y');
            $result = $duplicate->fetchAll(PDO::FETCH_ASSOC);
            $values = [];

            $adid = '';
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $code = '';
            $length = 25;

            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            $adid = $_SESSION['customer_code'] . '_in' . $code;
            $values[] = $adid;
            $values[] = $result[0]['category'];
            $values[] = $result[0]['city'];
            $values[] = $result[0]['address'];
            $values[] = $result[0]['area'];
            $values[] = $result[0]['age'];
            $values[] = $result[0]['title'];
            $values[] = $result[0]['description'];
            $values[] = $result[0]['african_ethnicity'];
            $values[] = $result[0]['nationality'];
            $values[] = $result[0]['boobs'];
            $values[] = $result[0]['hair'];
            $values[] = $result[0]['body_type'];
            $values[] = $result[0]['services'];
            $values[] = $result[0]['attention_to'];
            $values[] = $result[0]['place_of_service'];
            $values[] = $result[0]['price'];
            $values[] = $result[0]['payment_method'];
            $values[] = $result[0]['contact'];
            $values[] = $result[0]['email'];
            $values[] = $result[0]['ad_phone_number'];
            $values[] = $result[0]['images'];
            $values[] = $result[0]['preview_image'];
            $values[] = $result[0]['whatsapp_enable'];
            $values[] = $result[0]['terms_and_condition'];
            $values[] = $result[0]['orgination_enable'];
            $values[] = $result[0]['website_name'];
            $values[] = $result[0]['orgination_name'];
            $values[] = $result[0]['website_url'];
            $values[] = $_SESSION['user_identification'];
            $values[] = $result[0]['date_of_insert'];
            $values[] = $formattedDate;
            $values[] = $result[0]['suspend'];
            $values[] = $result[0]['ad_complete'];

            $duplicate_query = $con->prepare("INSERT INTO `profiles_ad`(`adid`, `category`, `city`, `address`, `area`, `age`, `title`, `description`, `african_ethnicity`, `nationality`, `boobs`, `hair`, `body_type`, `services`, `attention_to`, `place_of_service`, `price`, `payment_method`, `contact`, `email`, `ad_phone_number`, `images`, `preview_image`, `whatsapp_enable`, `terms_and_condition`, `orgination_enable`, `website_name`, `orgination_name`, `website_url`, `user_id`, `date_of_insert`, `ad_expiry_date`,  `suspend`, `ad_complete`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

            $duplicate_query->execute($values);

            if (!$duplicate || $duplicate->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function Get_Single_Ad_Detail($id)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $query = $con->prepare('SELECT * FROM profiles_ad WHERE post_id = ?');
        $query->execute([$id]);
        if ($query->rowCount() > 0) {
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }


    public static function Price_plan()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();


        $query = $con->prepare("SELECT * FROM plan_price");
        $query->execute();
        if ($query->rowCount() > 0) {
            while ($rows = $query->fetchAll(PDO::FETCH_ASSOC)) {
                $result[] = $rows;
            }
            if ($result) {
                return $result;
            } else {
                return [];
            }
        }
    }

    public static function Get_states_detail()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query = $con->prepare("SELECT * FROM states");
        $query->execute();
        if (($query->rowCount()) > 0) {
            $result = [];
            while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } else {
            return [];
        }
    }
    public static function Get_Cities_detail($state)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        if ($state == 'all') {
            $query = $con->prepare("SELECT cities FROM states");
            $query->execute();
            if ($query->rowCount() > 0) {
                $r = [];
                while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
                    $r[] = $row;
                }
            }

            $ct = [];

            foreach ($r[0] as $s) {
                foreach ($s as $i) {
                    foreach (json_decode($i) as $j) {
                        $ct[] = $j;
                    }
                }
            }
            $ct2 = [];
            $ct2 = array('cities' => $ct);
            $ct3 = array(0 => $ct2);
            return $ct3;
        } else {
            $query = $con->prepare("SELECT cities FROM states WHERE LOWER(state) = LOWER(?)");
            $query->execute([str_replace('-', ' ', $state)]);
            if (($query->rowCount()) > 0) {
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return [];
            }
        }
    }

    public static function  getStateByCity($city)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $stmt = $con->prepare("SELECT * FROM states");
        // $stmt->bindParam(':city', $s);
        $stmt->execute();
        // print_r($stmt); 
        if ($stmt->rowCount() > 0) {
            while ($results = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                // print_r($result);
                foreach ($results as $result) {
                    $array = array_map('strtolower', json_decode($result['cities']));
                    if (in_array(strtolower($city), $array)) {
                        return $result['state'];
                        break;
                    } else {
                        // header('Location: '.get_url().'');
                    }
                }
            }
        } else {
            echo 'a';
        }
    }

    public static function checkifitsastateorcity($city){
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $stmt = $con->prepare("SELECT * FROM states WHERE LOWER(state) = LOWER(:city)");
        $ct = str_replace('-',' ', $city);
        $stmt->bindParam(':city', $ct);
        $stmt->execute();
        // print_r($stmt); 
        if ($stmt->rowCount() > 0) {
            return false;
        }else{
            return true;
        }
    }


    // BELOW FUNCTION ARE USED TO SHOW ADS IN USER END


    public static function Show_Super_Top_Ads()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();
        $results = [];
        // $superquery  = $con->prepare("SELECT * FROM profiles_ad WHERE top_ad = 1 AND supertop_ad = 1 AND ad_complete = 1");
        $superquery  = $con->prepare("SELECT DISTINCT ad_id
        FROM (
            SELECT *,
                CASE
                    WHEN scheduled_time <= NOW() THEN 1  -- Ads already scheduled and passed
                    ELSE 0  -- Ads scheduled in the future
                END AS passed,
                ABS(TIMESTAMPDIFF(SECOND, NOW(), scheduled_time)) AS time_diff
            FROM ads_slot_time
        ) AS subquery
        ORDER BY passed ASC, time_diff ASC");
        $superquery->execute();
        if ($superquery->rowCount() > 0) {
            while ($row = $superquery->fetch(PDO::FETCH_ASSOC)) {
                $superquery2  = $con->prepare("SELECT * FROM profiles_ad WHERE adid = ? AND top_ad = 1 AND supertop_ad = 1");
                $superquery2->execute([$row["ad_id"]]);
                if ($superquery2->rowCount() > 0) {
                    while ($row2 = $superquery2->fetchAll(PDO::FETCH_ASSOC)) {
                        $results[] = $row2;
                    }
                }
            }
            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public static function Show_Top_Ads()
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $results = [];
        // $superquery  = $con->prepare("SELECT * FROM profiles_ad WHERE top_ad = 1 AND supertop_ad = 0 AND ad_complete = 1");
        $superquery  = $con->prepare("SELECT DISTINCT ad_id
        FROM (
            SELECT *,
                CASE
                    WHEN scheduled_time <= NOW() THEN 1  -- Ads already scheduled and passed
                    ELSE 0  -- Ads scheduled in the future
                END AS passed,
                ABS(TIMESTAMPDIFF(SECOND, NOW(), scheduled_time)) AS time_diff
            FROM ads_slot_time
        ) AS subquery
        ORDER BY passed ASC, time_diff ASC");
        $superquery->execute();
        if ($superquery->rowCount() > 0) {
            while ($row = $superquery->fetch(PDO::FETCH_ASSOC)) {
                $superquery2  = $con->prepare("SELECT * FROM profiles_ad WHERE adid = ? AND top_ad = 1 AND supertop_ad = 0");
                $superquery2->execute([$row["ad_id"]]);
                if ($superquery2->rowCount() > 0) {
                    while ($row2 = $superquery2->fetchAll(PDO::FETCH_ASSOC)) {
                        $results[] = $row2;
                    }
                }
            }
            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public static function Show_Ads($city)
    {
        $database = new DatabaseConnection();
        $con = $database->getConnection();

        $query  = $con->prepare("SELECT * FROM profiles_ad WHERE (state = ? OR city = ?) AND top_ad = 0 AND supertop_ad = 0 AND ad_complete = 1");
        $query->execute([$city]);
        if ($query->rowCount() > 0) {
            while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }
}
