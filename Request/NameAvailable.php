<?php
    use app\config\Nastaveni;
    require '../db.php';    
    $UserName = $_POST['username'];
    $Password = $_POST['password'];
    $PasswordAg = $_POST['password2'];
if($connection){
    $ArrayUzivatel = $Main->NameChecker($UserName, $connection);
    $x = $Main->PasswordChecker($Password, $PasswordAg);
    array_push($ArrayUzivatel, $x);
    print_r(json_encode($ArrayUzivatel));
}



?>




