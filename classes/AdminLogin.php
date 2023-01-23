<?php
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
    public function UserLogin($email,$password){
        $email =  $this->fr->Validation('name');
    }
}

?>