<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head> 
        <title>Página Principal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-min.css">
        <link rel="stylesheet" href="css/css.css">
    </head>
    <body id="paginaInicio">
        <main>
            <header class="p-3 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                        </a>

                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <li><a href="./DestroeSession.php" class="nav-link px-2 text-white bg-danger rounded-2">SAIR</a></li>
                            <?php
                            if ($_SESSION['perfilp']== "Funcionário"){
                                
                            ?>
                            <li><a href="#" class="nav-link px-2 text-white">Administrativo</a></li>
                            <li><a href="#" class="nav-link px-2 text-white">RH</a></li>
                            <!--<li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                            <li><a href="#" class="nav-link px-2 text-white">About</a></li>-->
                            <?php
                            }
                            ?>
                        </ul>

                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                            <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                        </form>

                        <!--<div class="text-end">
                            <button type="button" class="btn btn-outline-light me-2">Login</button>
                            <button type="button" class="btn btn-warning">Sign-up</button>
                        </div>-->
                    </div>
                </div>
            </header> 

            <div style="background-image:url('img/amazon.jpg');height: 720px; background-size: 1200px; background-position: center; background-repeat: no-repeat; padding-top: 1px" >
                <div class="px-4 py-5 my-5 text-center" >
                    <!--<img class="d-block mx-auto mb-4" src="img/amazon.jpg" alt="" width="72" height="57">-->
                    <h1 class="display-5 fw-bold" style="padding-top: 150px">Welcome Amazon <?php $_SESSION['nomep']?></h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4"></p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <button type="button"  class="btn btn-primary btn-lg px-4 gap-3"><a href="CadastroPessoa.php" style="color: white; text-decoration: none">Usuário</a></button>
                             <?php
                            if ($_SESSION['perfilp']== "Funcionário"){
                                
                            ?>
                            <button type="button" class="btn btn-secondary btn-lg px-4"><a href="CadastroProduto.php" style="color: white; text-decoration: none">Produto</a></button>
                            <button type="button" class="btn btn-success btn-lg px-4"><a href="CadastroFornecedor.php" style="color: white; text-decoration: none">Fornecedor</a></button>
                            <?php
                            }
                            ?>
                        
                        </div>
                    </div>
                </div>
            </div>

        </main>  

        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>


