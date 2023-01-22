<?php
include_once '../lib/session.php';
Session::init();
include_once '../lib/database.php';
$db = new Database();

if(isset($_GET['token'])){
   $token = $_GET['token'];
   $query =  "SELECT v_token,v_status FROM tbl_user WHERE $v_token = '$token'";
   $result = $this->db->select($query);

   if($result != false){
    $row = mysqli_fetch_assoc($result);

    if($row['v_status'] == 0){
        $click_token = $row['v_token'];
        $update_status = "UPDATE tbl_user SET v_status = '1' WHERE v_token ='$click_token'";
        $update_result = $db->update($update_status);
        if($update_result){
            $_SESSION['status'] = "Your Account has been verifyed successfully";
            header('location:login.php');
        }else{
            $_SESSION['status'] = "Varification Fild!";
            header('location:login.php');
        }
    }else{
        $_SESSION['status'] = "This email is already verifyed please login!";
        header('location:login.php');
    }
   }else{
    $_SESSION['status'] = "This Token Dose Not Exsist!";
    header('location:login.php');
   }

  
}else{
    $_SESSION['status'] =  "Not Allowed";
    header('location:login.php');
}


?>