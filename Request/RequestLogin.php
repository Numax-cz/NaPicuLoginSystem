<?php
use app\config\Nastaveni;
require '../db.php';
$UserName = $_POST['username'];
$Password = $_POST['password'];




if($connection){






    if($Main->UserDataLogin($UserName, $Password, $connection) == 1){
        
        session_start();
        $_SESSION["login"] = $UserName;
        $_SESSION["time"] = time();
        header("location: ../panel.php");
        die();  
    }else{
        header("location: ../login.php");
        die();
    }


}





?>