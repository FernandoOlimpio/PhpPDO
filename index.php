<?php
session_start();

//$_SESSION['nr'] = -1;
//$_SESSION['confereNr'] = -2;
$_SESSION['msg'] = "";
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


    <!-- 
   <body id="paginaIndex">
       
     
       <div class="container" >
           <div class="row espaco">
               <div class="col-md-6 offset-md-3"
                    style="margin-top: 10%">
               <div class="card-header bg-dark  border espaco text-white"
                    > Validação de login </div>                 
                 <div class="card-body border">
                     <form method="POST" action="./controller/ValidaLogin.php">
                         <div class="row espaco">
    <?php /*

      if ($_SESSION['msg']!= ""){
      echo $_SESSION['msg'];
      //echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"5;
      //URL='DestroeSession.php'\">";
      $_SESSION['msg']= "";
      }
     */ ?>
                             <div class="col-md-8 offset-md-2">
                                 <label>Usuário</label>
                                 
                             </div>
                             
                         </div>
                         
                         <div class="row">
                             <div class="col-md-8 offset-md-2 " >
                                 <input class="form-control" type="text" 
                                        name="login">
                                 
                             </div>
                         </div>
                         
                         <div class="row espaco">
                             <div class="col-md-8 offset-md-2 ">
                                 <label>Senha</label>
                             </div>
                         </div>
                         <div class="row">
                               <div class="col-md-8 offset-md-2 ">
                                   <input class="form-control" type="text" 
                                          name="senha">
                               </div>    
                           </div>
                         <div class="row espaco" style="margin-top: 20px;">
                               <div class="col-md-8 offset-md-2 col-xl-12">
                                   <input class="btn btn-success" type="submit" name="enviar" value="Enviar"> 
                                   <input class="btn btn-light" type="reset" value="Limpar"><br>
                                 <!--<label style="color: red;"><?php //echo $_SESSION['msg'];  ?></label>--> 
    <!-- </div>   
 </div>
  
</form> 
</div>
</div>
</div>
</div>-->
    <!--FAZENDO UM NOVO LOGIN COM BOOTSTRAP-->
    <body class="body-index text-center">

        <main class="form-signin">
            <form method="POST" action="./controller/ValidaLogin.php">
                <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
                
                <?php
                if ($_SESSION['msg'] != ""){
                    $msg = $_SESSION['msg'];
                    echo "<script> alert('$msg')</script>"; 
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"5;
                    URL='DestroeSession.php'\">";
                $_SESSION['msg'] = "";
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
