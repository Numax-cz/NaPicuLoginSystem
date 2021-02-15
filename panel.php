<?php

session_start();
if(isset($_SESSION["login"])){


}else{
    header('location: login.php');
    die();
}

if($_SESSION["time"] + 60 * 24 < time()){ 
    header("location: Request/RequestLogout.php");  
    die();
}


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/panel2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <section id="sidebar">
        <div class="User"><?php echo $_SESSION["login"]?></div>
        <div class="sideBar-Menu">

            <li>
                <a href="#">Nastavení</a>
            </li>
            <li>
                <a href="#">Informace</a>
            </li>
            <li>
                <a href="#">Nevím</a>
            </li>
           
        </div>
        <div class="exit"><a href="#">Odhlásit se</a></div>
    </section>
    <section id="panel">
        <div class="panelserver">
            Nevím server

        </div>
        <div class="chatPole">

            <iframe id="chatiframe"></iframe>

        </div>
        
    </section>
</body>
</html>
<script>
    
    function chat(){
        var frame = document.getElementById("chatiframe").contentWindow.document;
        frame.open();
        frame.write('f')
        frame.close();
    }

    chat();

</script>

