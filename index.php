<?php
include_once './controller/PessoaController.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-min.css">
        <link rel="stylesheet" href="css/css.css">
        <style>
            .espaco{padding: 10px}
            
        </style>
    </head>
    <body id="paginaIndex">
        
        <?php
        $msg = "";
        if (isset($_POST['enviar'])){
                       
            $login = trim($_POST['login']);
            $senhaSemCriptografia = $_POST['senha'];
            $senha = md5($senhaSemCriptografia);
            echo "Senha:".$senha."<br>";
            
            $pc = new PessoaController();
            unset($_POST['enviar']);
           echo "Check:".$check = $pc->procurarSenha($login,$senha)."<br>";
            if ($check == 1){
                echo "Logado";
                header("Location: Inicio.php");
                
            }else{
                $msg = "Senha ou login inválidos"; 
                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"5;
                URL='index.php'\">";
            }

        }
        
        
        ?>
        <div class="container" >
            <div class="row espaco">
                <div class="col-md-6 offset-md-3"
                     style="margin-top: 10%">
                <div class="card-header bg-dark  border espaco text-white"
                     > Validação de login </div>                 
                  <div class="card-body border">
                      <form method="POST" action="">
                          <div class="row espaco">
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
                                    <label style="color: red;"><?php echo $msg?></label> 
                                </div>    
                            </div>
                             
                      </form> 
                  </div>
                </div>
            </div>
    </div>

    <script src="js/bootstrap.js"> </script>
    <script src="js/bootstrap.min.js"> </script>
</body>
</html>
