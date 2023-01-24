<?php
include_once '../lib/session.php';
Session::init();
include_once '../lib/database.php';
include_once '../helpers/format.php';

class AdminLogin{
    private $db;
    private $fr;
    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }
    public function LoginUser($email,$password){
        $email =  $this->fr->Validation($email);
        $password = $this->fr->Validation($password);
        if(empty($email) || empty($password)) {
            $error = "Field Must Not Be Empty";
            return $error;
        }else{
            $select = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
            $results = $this->db->select($select);
            if(mysqli_num_rows($results)  > 0){
                    $rows = mysqli_fetch_assoc($results);
                    if($rows['v_status'] == 1){
                         Session::set('login',true);
                         Session::set('name', $rows['name']);
                         header('location:index.php');
                    }else{
                        $error = "Please first varify your email";
                        return $error;
                    }
            }else{
                $error = "Invaild email and password";
                return $error;
            }
        }  
    }
}

?>