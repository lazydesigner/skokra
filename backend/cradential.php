<?php
include 'connection.php';

class User
{
    private $con;
    private $Username;
    private $Password;
    private $NormalPassword;
    private $Terms;
    private $customercode;

    public function __construct(PDO $con)
    {
        $this->con = $con;
    }

    public function setUsername($username)
    {
        $this->Username = $username;
    }
    public function setPassword($password)
    {
        $this->Password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function setnormalPassword($password)
    {
        $this->NormalPassword = $password;
    }

    public function setCustomerCode($email){
            $username = strstr($email, '@', true);
        
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = '';
            $length = 5;
            $length2 = 5;
            
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            for ($j = 0; $j < $length2; $j++) {
                $code .= strtoupper($username[rand(0, strlen($username) - 1)]);
            }
            
            $this->customercode =  $code;
        
    }
    
    public function setTerms($terms)
    {
        $this->Terms = $terms;
    }
    public function save()
    {
        $query = $this->con->prepare("INSERT INTO `users` (`email`, `password`,`terms_and_conditions`,`customer_code`) VALUES (:username, :password, :terms, :customer_code)");
        $query->bindParam(":username", $this->Username);
        $query->bindParam(":password", $this->Password);
        $query->bindParam(":terms", $this->Terms);
        $query->bindParam(":customer_code", $this->customercode);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function CheckUsername($con2, $username)
    {
        $checkifuserexist = $con2->prepare("SELECT email FROM users WHERE email = :username");
        $checkifuserexist->bindParam(":username", $username);
        if ($checkifuserexist->execute()) {
            if ($checkifuserexist->fetch(PDO::FETCH_ASSOC)) {
                return false; // Username exists
            } else {
                return true; // Username does not exist
            }
        } else {
            return false;
        }
    }

    public function Loginuser(){
        $loginuser = $this->con->prepare("SELECT * FROM users WHERE email = :username");
        $loginuser->bindParam(":username", $this->Username);
        // $loginuser->bindParam(":password", $this->Password);

        if($loginuser->execute()){
            $row = $loginuser->fetch(PDO::FETCH_ASSOC); 
            if($row){
                if (password_verify($this->NormalPassword, $row['password'])) {
                    $_SESSION['user_id'] = $row['email'];
                    return true;
                }else{
                    return false;
                }               
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



}

class User_Signup
{
    public static function Signup($u, $p,$t)
    {

        $username = $u;
        $password = $p;
        $terms = $t;

        $database2 = new DatabaseConnection();
        $con2 = $database2->getConnection();

        if (User::CheckUsername($con2, $username)) {
            //Create new user and save to 
            $database = new DatabaseConnection();
            $con = $database->getConnection();
            $user = new User($con);

            $user->setUsername($username);
            $user->setPassword($password);
            $user->setCustomerCode($username);
            $user->setTerms($terms);

            if ($user->save()) {
                return json_encode(['status'=>200,'msg'=>'success']);
            } else {
                return json_encode(['status'=>500,'msg'=>'error']);
            }
        } else {
            return json_encode(['status'=>200,'msg'=>'exist']);
        }
    }

    public static function Login($u,$p)
    {
        $username = $u;
        $password = $p;

        $database2 = new DatabaseConnection();
        $con2 = $database2->getConnection();

        if(!User::CheckUsername($con2, $username)){
            $user = new User($con2);

            $user->setUsername($username);
            $user->setnormalPassword($password);
            if($user->Loginuser()){
                return json_encode(['status'=>200, 'msg'=>'success']);
            }else{
                return json_encode(['status'=>204, 'msg'=>'error']);
            }
        }else{
            return json_encode(['status'=>204, 'msg'=>'exist']);
        }

    }

}


