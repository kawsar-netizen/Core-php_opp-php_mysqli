<?php

include_once '../lib/database.php';
include_once '../helpers/format.php';

include_once '../PHPmailer/PHPMailer.php';
include_once '../PHPmailer/SMTP.php';
include_once '../PHPmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register{
 public $db;
 public $fr;
 
 public function __construct()
 {
    $this->db = new Database();
    $this->fr = new Format();
 }
 public function AddUser($data){

   function sendemail_varifi($name,$email,$v_token){
    $mail = new PHPMailer(true);
    $mail->isSMTP(); 
    $mail->SMTPAuth   = true;
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->Username   = 'kawsarkhanbd3@gmail.com'; 
    $mail->Password   = 'kawsarkhan94$#@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;  

    $mail->setFrom('kawsarkhanbd3@gmail.com', $name);
    $mail->addAddress($email);

    $mail->isHTML(true);  
    $mail->Subject = 'Email Varification From Admin';

    $email_template = "
    <h2>You have register with Admin</h2>
    <h5>Varify your email address to login please click the link below</h5>
    <a href='http://localhost/Core-php_oop-php_mysqli/admin/verifi_email.php?token=$v_token'>Click Here</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
   }

    $name = $this->fr->Validation($data['name']);
    $phone = $this->fr->Validation($data['phone']);
    $email = $this->fr->Validation($data['email']);
    $password = $this->fr->Validation($data['password']);
    $v_token = md5(rand());


    if(empty($name) || empty($phone) || empty($email) || empty($password)){
        $error = "Field Must Not Be Empty";
        return $error;
    }else{
        $e_qurey = "SELECT * FROM tbl_user WHERE email = '$email'";
        $check_email = $this->db->select($e_qurey);
        if($check_email > 0){
            $error = "This Email Is Alrady Exisit";
            return $error;
            header('Location:register.php');
            
        }else{
            $insert_qurey = "INSERT INTO tbl_user(name,email,phone,password,v_token) VALUES('$name',
            '$email','$phone','$password','$v_token')";
            
            $insert_row = $this->db->insert($insert_qurey);

            if($insert_row){
                $success = "Registration Successfully. Please check your email inbox for varify email..";
                return $success;
            }else{
                $error = "Registration Failed";
                return $error;
            }
        }
    
    }
 }
}

?>