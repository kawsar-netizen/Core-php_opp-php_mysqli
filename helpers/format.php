<?php
 class Format{
    public function Validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
 }

?>