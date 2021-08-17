<?php

session_start();
if (empty ($_SESSION['msg'])){
    $_SESSION['msg'] = "";
}
//$_SESSION['msg'] = "";
$_SESSION['nr'] = -1;
$_SESSION['confereNr'] = -2;
 
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-min.css">
        <link rel="stylesheet" href="css/css.css">
        <!--<style>
            .espaco{padding: 10px}

        </style>
        -->
    </head>


   
    <!--FAZENDO UM NOVO LOGIN COM BOOTSTRAP-->
    <body class="body-index text-center">
        

        <main class="form-signin">
            <form method="POST" action="./controller/ValidaLogin.php">
                <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
                
               
                <?php
                    
                if ($_SESSION['msg'] != null){
               
                    echo $_SESSION['msg'];
    
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                    URL='DestroeSession.php'\">";
                    
                     echo $_SESSION['msg'] = null;
                    
                }
                
                
                ?>


                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="login">
                    <label for="floatingInput">Usuário</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="senha">
                    <label for="floatingPassword">Senha</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembre-me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Enviar</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            </form>
        </main>


        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/JQuery.js"></script>
    <script src="js/JQuery.min.js"></script>
    </body>
</html>
