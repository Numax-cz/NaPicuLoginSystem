<?php
    $UserName = $_POST['username'];
    $Password = $_POST['password'];
    $PasswordAg = $_POST['password2'];

    

use app\config\Nastaveni;
require '../db.php';





if($connection){
    $PasswordChk = $Main->PasswordChecker($Password, $PasswordAg); //Kontrola hesla 
    $UsernameChk = $Main->NameChecker($UserName, $connection); //Kontrola jména 

    //Znovu kontrola zda jméno neexistuje a heslo a heslo2 bylo zadáno správně a v správném tvaru
    if($UsernameChk["uzivatel"]["existuje"] == false  && $PasswordChk["heslo"]["spravne"] == "access"){
        $Main->PasswordCreator($UserName, $Main->PasswordCrypt($Password), $connection);
        session_start();
        $_SESSION["login"] = $UserName;
        header("location: ../panel.php");
        die();
    }else{
        header("location: ../register.php");
    }
}

?>