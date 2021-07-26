<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CadastroPessoa
 *
 * @author 02520429135
 */
class CadastroPessoa {
    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> 
        <title>Formulário</title>
        <style>
            .btInput{
                padding: 10px 20px 10px 20px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-8 offset-2">
                    <div class="card-header bg-light text-center border">
                        Cadastro de Cliente
                    </div>
                    <div class="card-body border">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <label>Código</label> <br>

                                    <label> Nome Completo</label>
                                    <input class="form-control" type="text"
                                           name="nome">

                                    <label> Data de Nascimento</label>
                                    <input class="form-control" type="date"
                                           name="dtNasc">

                                    <label> Login </label>
                                    <input class="form-control" type="text"
                                           name="login">

                                    <label> Senha </label>
                                    <input class="form-control" type="password"
                                           name="senha">

                                    <label> Confirmar Senha </label>
                                    <input class="form-control" type="password"
                                           name="senha2">

                                </div>

                                <div class="col-md-6">
                                    <br>
                                    <label> Perfil</label>
                                    <select name="perfil" class="form-control">
                                        <option> [SELECIONE]</option>
                                        <option>Cliente</option>
                                        <option>Funcionário</option>
                                    </select>

                                    <label> E-mail</label>
                                    <input class="form-control" type="email"
                                           name="email">

                                    <label> CPF</label>
                                    <input class="form-control" type="text"
                                           name="cpf">


                                </div>

                            </div>
                            
                                        <div class="col-md-4  offset-md-4 btInput">
                                             <input type="submit" name="cadastrar"
                                               class="btn-success" value="Enviar">
                                             &nbsp; &nbsp;  
                                             <input type="reset" class="btn-light" 
                                                   value="Limpar">
                                        </div>
                                      </form>   
                                    </div>
                                </div>
                            </div>

                       
                    </div>
        
        <?php
        //envio dos dados para o BD
        if(isset($_POST['cadastrar'])){
            $nome = $_POST['nome'];
            $dtNasc = $_POST['dtNasc'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $perfil = $_POST['perfil'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            
            $pc = new PessoaController();
            echo "<p>".$pc ->inserirPessoa($nome, $dtNasc, $login, $senha, 
                    $perfil, $email, $cpf). "<p>";
        }

        ?>        
        <script src="js/bootstrap.js"</script>
        <script src="js/bootstrap.min.js" </script>
    </body>   

</html>



