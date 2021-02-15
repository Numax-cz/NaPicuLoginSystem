<?php include './other/session.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="LoginPanel">
        <div class="LoginMenu">
            
            <form action="Request/RequestLogin.php" method="post">
                <h2>Přihlášení</h2>
                <label>Uživatelské jméno</label><p id='NameError'></p>
                <input type="text" name="username">
                <label>Heslo</label><p id='PassError'></p>
                <input type="password" name="password" >
                <button class="btn" type="submit">Registrovat se</button>
            </form>
            <a href="register.php">Nemám účet</a>   
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    ZakazatOdeslani()
    const Jmeno = document.querySelector("input[name='username']")
    const Heslo = document.querySelector("input[name='password']")


    document.addEventListener('keyup', () => {
        if(Jmeno.value !== '' && Heslo.value !== '') { 
            PovolitOdeslani()
        } else { 
            ZakazatOdeslani()
        }
    })





    function PovolitOdeslani(){
        $(".btn[type='submit']").prop('disabled', false);
        document.querySelector("button").style.cursor = 'pointer'  
    }
    function ZakazatOdeslani() {
        $(".btn[type='submit']").prop('disabled', true);
        document.querySelector("button").style.cursor = 'not-allowed'  
    } 



</script>










    



