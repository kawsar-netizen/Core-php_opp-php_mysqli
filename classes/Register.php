<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';

class Register{
 public $db;
 public $fr;
 
 public function __construct()
 {
    $this->db = new Database();
    $this->fr = new Format();
 }
 public function AddUser($data){
    $name = $this->fr->Validation($data['name']);
    $phone = $this->fr->Validation($data['phone']);
    $email = $this->fr->Validation($data['email']);
    $password = $this->fr->Validation($data['password']);
    $v_token = md5(rand());

    // $e_qurey = "SELECT * FROM tbl_user WHERE email = '$email'";
    // $check_email = $this->db->select($e_qurey);

    // if($check_email>0){
    //     $error = "This Email Is Alrady Exisit";
    //     return $error;
    //     header('location:register.php');
    // }

    if(empty($name) || empty($phone) || empty($email) || empty($password)){
        $error = "Field Must Not Be Empty";
        return $error;
    }
 }
}

?>