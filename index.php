

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-min.css">
        <link rel="stylesheet" href="css/css.css">
        <style>
            .espaco{padding: 10px}
            
        </style>
    </head>
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
                              <?php
                                     if ($_SESSION['msg']!= ""){
                                         echo $_SESSION['msg'];
                                         echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='index.php'\">";
                                         $_SESSION['msg']= "";
                                     }
                              ?>
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
                                    <label style="color: red;"><?php echo $_SESSION['msg'];?></label> 
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
