<?php 

namespace app\config;

class Nastaveni{ 
    protected $data;
    
    public function selectDatabase($key){ 
        $this->data = require "Config/config.php";
        foreach ($this->data as $x){
            $data = $x[$key];
        }
        return $data;      
    }
    public function NameChecker($name, $database){ // Vrátí array existuje true/false + zprava
        $DelkaJmena = 3;
        $MaxDelkaJmena = 20;
        $uzivatel = mysqli_real_escape_string($database, $name);
        $query = "SELECT * FROM login WHERE username= '".$uzivatel."'";
        $result = mysqli_query($database, $query);
        $duplicate = mysqli_num_rows($result); //Vrátí 0 nebo 1 a více

        if($duplicate == 0 && strlen($name) >= $DelkaJmena && strlen($name) <= $MaxDelkaJmena){
            $ArrayUzivatel = array("uzivatel" => ["existuje" => false]);
        }
        else if($duplicate > 0){ //Kontrola zda jméno není duplikované 
            $ArrayUzivatel = array("uzivatel" => ["existuje" => true, "zprava" => "*Uživatelské jméno již existuje"]);
        }
        else if(strlen($name) < $DelkaJmena){ //Kontrola zda jméno je delší jak uvedené číslo
            $ArrayUzivatel = array("uzivatel" => ["existuje" => true, "zprava" => "*Alespoň 3 znaky"]);
        }
        else if(strlen($name) > $MaxDelkaJmena){ //Kontrola zda jméno není delší jak uvedené číslo
            $ArrayUzivatel = array("uzivatel" => ["existuje" => true, "zprava" => "*Uživatelské jméno je dlouhé"]);
        }  
        return $ArrayUzivatel;
    }
    public function PasswordCreator($name, $password, $database){ // Zapsání jména a hesla do vybrané databáze
        $username = mysqli_real_escape_string($database, $name);
        $query = "INSERT INTO login (username, password, permission) VALUES ('$name','$password', 'User')";
        $dbp = mysqli_query($database,$query); 
    }
    public function PasswordChecker($heslo, $hesloauth){ //Kontrola zda heslo a hesloauth jsou ve správném tvaru 
        $Heslo = array("heslo" => ["spravne" => "", "zprava" => ""]);
        if ($heslo !== ''){
            if(!preg_match("/[0-9A-Za-z-@#$%]/", $heslo)){ //Kontrola zda heslo neobsahuje nepovolené znaky např. " ".
                $Heslo = array("heslo" => ["spravne" => 'error', "zprava" => "*Tyto znaky nejsou povoleny"]);
            }else {
                if(strlen($heslo) > 0 && strlen($heslo) < 6){ //Kontrola zda heslo je dostatečně dlouhé
                    $Heslo = array("heslo" => ["spravne" => 'error', "zprava" => "*Heslo je krátké!"]);
                }
                else if(strlen($heslo) > 100){ //Kontrola zda je heslo není delší jak 100 znaků
                    $Heslo = array("heslo" => ["spravne" => 'error', "zprava" => "*Heslo je moc dlouhé!"]);
                }else{
                    $Heslo = array("heslo" => ["spravne" => 'passaccess', "zprava" => "je to good"]);
                    if($heslo == $hesloauth && $hesloauth !== ''){ $Heslo = array("heslo" => ["spravne" => 'access', "zprava" => ""]);}
                    if($heslo !== $hesloauth && $hesloauth !== ''){$Heslo = array("heslo" => ["spravne" => 'autherror', "zprava" => "*Hesla nejsou stejná"]);}
                }
            }
        }
        return $Heslo;
    }
    function PasswordCrypt($heslo){ //Zašifruje heslo v sha512
        $sha512 = '$6$rounds=5969$mamraddetitotojesuperl$';
        $PassCrypt = crypt($heslo, $sha512);
        return $PassCrypt;
    }

    function UserDataLogin($jmeno, $heslo, $database){ // Zkontroluje zda jsou zadané údaje správné
        $sha512 = '$6$rounds=5969$mamraddetitotojesuperl$';
        $passwordcrypt= crypt($heslo, $sha512); 
        $sql = "SELECT * FROM login WHERE username='".$jmeno."' AND password='".$passwordcrypt."'";
        $resutl = mysqli_query($database,$sql);
        return mysqli_num_rows($resutl);
        
    }


}

$Main= new Nastaveni;

$db = $Main->selectDatabase("DatabaseMain");  //Výběr databáze

$connection = mysqli_connect($db["host"], $db["user"], $db["password"], $db["name"]); //Napojení na databázku :)





    

?>