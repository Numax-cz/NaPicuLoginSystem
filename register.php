<?php
    include './other/session.php'


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="LoginPanel">
        <div class="LoginMenu">
            
            <form action="Request/RequestRegister.php" method="post">
                <h2>Registrace</h2>
                <label>Uživatelské jméno</label><p id='NameError'></p>
                <input type="text" name="username">
                <label>Heslo</label><p id='PassError'></p>
                <input type="password" name="password" >
                <label>Heslo znovu</label><p id='PassError2'></p>
                <input type="password" name="password2">
                <button class="btn" type="submit">Registrovat se</button>
            </form>
            <a href="login.php">Už mám účet</a>   
        </div>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(".btn[type='submit']").prop('disabled', true);


const Jmeno = document.querySelector("input[name='username']")
const Heslo = document.querySelector("input[name='password']")
const HesloRe = document.querySelector("input[name='password2']")

$(function () {
    document.addEventListener('keyup', ()=> {
        $.ajax({
        type: 'post',
        url: 'Request/NameAvailable.php',
        data: $('FORM').serialize(),
        success: function (data) {
            console.log(data);
            var json = $.parseJSON(data);
    

            if(json[0].heslo.spravne == 'error'){
                document.getElementById('PassError').innerText = json[0].heslo.zprava;
                document.getElementById('PassError').style.display ='block'
                Heslo.style.borderBottom = '2px solid #e84118'
            }else if(json[0].heslo.spravne == 'autherror'){
                document.getElementById('PassError2').innerText = json[0].heslo.zprava;
                document.getElementById('PassError2').style.display ='block'
                HesloRe.style.borderBottom = '2px solid #e84118'
            }
            else{
                document.getElementById('PassError').style.display ='none'
                document.getElementById('PassError2').style.display ='none'
                Heslo.style.borderBottom = '2px solid #4cd137'
                HesloRe.style.borderBottom = '2px solid #4cd137'
            }




            if(json.uzivatel.existuje == true && Jmeno.value.length > 0){
                Jmeno.style.borderBottom  = '2px solid #e84118'
                document.getElementById('NameError').innerText = json.uzivatel.zprava;
                document.getElementById('NameError').style.display ='block'
            }else{ 
                Jmeno.style.borderBottom  = '2px solid #4cd137'
                document.getElementById('NameError').style.display ='none'
            }

            if (Jmeno.value == ''){Jmeno.style.borderBottom = '2px solid white'; document.getElementById('NameError').innerText = ''} 
            if (Heslo.value == ''){Heslo.style.borderBottom = '2px solid white'; document.getElementById('PassError').innerText = ''}
            if (HesloRe.value == ''){HesloRe.style.borderBottom = '2px solid white'; document.getElementById('PassError2').innerText = ''}
            if(json[0].heslo.spravne == 'access' && json.uzivatel.existuje == false){ PovolitOdeslani()} else{ZakazatOdeslani()}



        }
        });
        return false;
    });
});




function PovolitOdeslani(){
    $(".btn[type='submit']").prop('disabled', false);
    document.querySelector("button").style.cursor = 'pointer'  
}
function ZakazatOdeslani() {
    $(".btn[type='submit']").prop('disabled', true);
    document.querySelector("button").style.cursor = 'not-allowed'  
}   








    



</script>

