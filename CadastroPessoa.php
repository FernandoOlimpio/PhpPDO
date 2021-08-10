<?php
include_once './model/Mensagem.php';
include_once './model/Endereco.php';
include_once './model/Pessoa.php';
include_once './controller/PessoaController.php';

$msg = new Mensagem();
$pes = new Pessoa();
$endereco =new Endereco();
$pes->setEndereco($endereco);

$btEnviar = FALSE;
$btAtualizar = FALSE;
$btExcluir = FALSE;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">


        <title>Formulário Pessoa</title>
        <style>
            .btInput{
                padding: 10px 20px 10px 20px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>

        <script>
            function mascara(t, mask) {
                var i = t.value.length;
                var saida = mask.substring(1, 0);
                var texto = mask.substring(i);
                if (texto.substring(0, 1) != saida) {
                    t.value += texto.substring(0, 1);

                }
            }

        </script>
    </head>

    <body> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <ul class="navbar-nav"> 
                    <li class="nav-item">
                    <a class="navbar-brand btn btn-primary" href="Inicio.php" >Voltar</a>
                    </li>
                <li class="nav-item">
                            <a class="navbar-brand btn btn-warning"  href="index.php">Sair</a>
                        </li>
                        
                </ul>
                
              <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Sair</a>
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
                </div>-->
            </div>
        </nav>



        <label id="cepErro" style="color:red;"></label>
        <div class="container-fluid">
            <div class="row" style="margin-top: 30px">
                <div class="col-md-4">
                    <div class="card-header bg-light text-center border">
                        Cadastro Usuário
                    </div>
                    <div class="card-body border">

                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarPessoa'])) {
                            $nome = trim($_POST['nome']);
                            if ($nome != "") {
                                $dtNasc = $_POST['dtNasc'];
                                $login = $_POST['login'];
                                $senhaDigitada = $_POST['senha'];
                                $senha = md5($senhaDigitada);
                                $perfil = $_POST['perfil'];
                                $email = $_POST['email'];
                                $cpf = $_POST['cpf'];

                                $cep = $_POST['cep'];
                                $logradouro = $_POST['logradouro'];
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];

                                $pesc = new PessoaController();
                                unset($_POST['cadastrarPessoa']);
                                $msg = $pesc->inserirPessoa($nome, $dtNasc, $login, 
                                        $senha, $perfil, $email, $cpf, $cep,
                                        $logradouro, $complemento, $bairro, 
                                        $cidade, $uf);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                 URL='CadastroPessoa.php'\">";
                            }
                        }

                        //método para atualizar dados do pessoa no BD
                        if (isset($_POST['atualizarPessoa'])) {
                            $nome = trim($_POST['nome']);
                            if ($nome != "") {
                                $id = $_POST['idpessoa'];
                                $dtNasc = $_POST['dtNasc'];
                                $login = $_POST['login'];
                                $senha = $_POST['senha'];
                                $perfil = $_POST['perfil'];
                                $email = $_POST['email'];
                                $cpf = $_POST['cpf'];

                                $cep = $_POST['cep'];
                                $logradouro = $_POST['logradouro'];
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];

                                $pesc = new PessoaController();
                                unset($_POST['atualizarPessoa']);
                                $msg = $pesc->atualizarPessoa($id, $nome, $dtNasc, $login, $senha, $perfil, $email, $cpf, $cep,
                                        $logradouro, $complemento, $bairro, $cidade, $uf);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroPessoa.php'\">";
                            }
                        }

                        if (isset($_POST['excluir'])) {
                            if ($pes != null) {
                                $id = $_POST['ide'];

                                $pesc = new PessoaController();
                                unset($_POST['excluir']);
                                $msg = $pesc->excluirPessoa($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroPessoa.php'\">";
                            }
                        }

                        if (isset($_POST['excluirPessoa'])) {
                            if ($pes != null) {
                                $id = $_POST['idpessoa'];

                                $pesc = new PessoaController();
                                unset($_POST['excluirPessoa']);
                                $msg = $pesc->excluirPessoa($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroPessoa.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $pes = null;
                            unset($_GET['id']);
                            header("Location: CadastroPessoa.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $id = $_GET['id'];
                            $pesc = new PessoaController();
                            $pes = $pesc->pesquisarPessoaId($id);
                        }
                        ?> 
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <strong>Código: <label style="color:red;">
                                        <?php
                                        if ($pes != null) {
                                            echo $pes->getIdPessoa();
                                            ?>
                                            </label></strong>
                                        <input type="hidden" name="idpessoa" 
                                               value="<?php echo $pes->getIdPessoa(); ?>"><br>
                                                <?php
                                            }
                                            ?>

                                    <label> Nome Completo</label>
                                    <input class="form-control" type="text"
                                           value="<?php echo $pes->getNome(); ?>" name="nome">

                                    <label> Data de Nascimento</label>
                                    <input class="form-control" type="date"
                                           value="<?php echo $pes->getDtNasc(); ?>" name="dtNasc">

                                    <label> Login </label>
                                    <input class="form-control" type="text"
                                           value="<?php echo $pes->getLogin(); ?>" name="login">

                                    <label> Senha </label>
                                    <input class="form-control" type="password"
                                             id="senha" name="senha">

                                    <label> Confirmar Senha </label>
                                    <input onblur="validaPassword()" class="form-control" type="password" id="senha2" name="senha2" 
                                            >
                                    <script>
                                       var senha = document.getElementById("senha")
                                      , senha2 = document.getElementById("senha2");

                                        function validaPassword(){
                                      if(senha.value != senha2.value) {
                                        senha2.setCustomValidity("Senhas diferentes!");
                                      } else {
                                        senha2.setCustomValidity('');
                                      }
                                    }

                                    senha.onchange = validatePassword;
                                    senha2.onkeyup = validatePassword;
                                    </script>
                                    
                                    <label> Perfil</label>
                                    <select  class="form-control" name="perfil">
                                        <option> [SELECIONE]</option>
                                        <option 
                                          <?php
                                          
                                        if($pes->getPerfil()=="Cliente"){
                                        echo "selected = 'selected'";
                                        }
                                          
                                        ?>
                                          >Cliente</option>
                                        
                                        
                                        <option 
                                             <?php
                                        if($pes->getPerfil()=="Funcionário"){
                                        echo "selected = 'selected'";
                                        }
                                        ?>   
                                         >Funcionário</option>
                                       
                                    </select>

                                    <label> E-mail</label>
                                    <input class="form-control" type="email"
                                           value="<?php echo $pes->getEmail(); ?>"  name="email">

                                    <label> CPF</label>
                                    <input class="form-control" type="text"
                                           value="<?php echo $pes->getCpf(); ?>" name="cpf">

                                    <label>CEP</label> 
                                    <label id="valCep" style="color: red; font-size: 11px;"></label>
                                    <input class="form-control" type="text"  id="cep"
                                           value="<?php echo $pes->getEndereco()->getCep(); ?>" name="cep"
                                           onkeypress="mascara(this, '#####-###')" maxlength="9">

                                    <label>Logradouro</label>  
                                    <input class="form-control" type="text" id="rua"
                                           value="<?php echo $pes->getEndereco()->getLogradouro(); ?>" name="logradouro">  

                                    <label>Complemento</label>  
                                    <input class="form-control" type="text" id="complemento"
                                           value="<?php echo $pes->getEndereco()->getComplemento(); ?>" name="complemento"> 

                                    <label>Bairro</label>  
                                    <input class="form-control" type="text" id="bairro"
                                           value="<?php echo $pes->getEndereco()->getBairro(); ?>" name="bairro">

                                    <label>Cidade</label>  
                                    <input class="form-control" type="text" id="cidade"
                                           value="<?php echo $pes->getEndereco()->getCidade(); ?>" name="cidade">

                                    <label>UF</label>  
                                    <input class="form-control" type="text" id="uf"
                                           value="<?php echo $pes->getEndereco()->getUf(); ?>" name="uf">


                                    <input type="submit" name="cadastrarPessoa"
                                           class="btn btn-success btInput" value="Enviar"
                                        <?php if ($btEnviar == TRUE) echo "disabled"; ?>>

                                    <input type="submit" name="atualizarPessoa"
                                           class="btn btn-secondary btInput" value="Atualizar"
                                        <?php if ($btAtualizar == FALSE) echo "disabled"; ?>>   

                                    <button type="button" class="btn btn-warning btInput" 
                                            data-bs-toggle="modal" data-bs-target="#ModalExcluir"
                                            <?php if ($btExcluir == FALSE) echo "disabled"; ?>>
                                        Excluir
                                    </button>

                                    <!-- Modal para excluir -->
                                    <div class="modal fade" id="ModalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" 
                                                        id="exampleModalLabel">
                                                        Confirmar Exclusão</h5>
                                                    <button type="button" 
                                                            class="btn-close" 
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Deseja Excluir?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="excluirPessoa"
                                                           class="btn btn-success "
                                                           value="Sim">
                                                    <input type="submit" 
                                                           class="btn btn-light btInput" 
                                                           name="limpar" value="Não">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- fim do modal para excluir -->
                                    &nbsp;&nbsp;
                                    <input type="submit" 
                                           class="btn btn-light btInput" 
                                           name="limpar" value="Limpar">
                                </div>




                        </form>   
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-responsive"
                               style="border-radius: 3px; overflow:hidden;">
                            <thead class="table-dark">
                                <tr><th>Código</th>
                                    <th>Nome</th>
                                    <th>Dt.Nasc.</th>
                                    <th>Login</th>
                                    <th>Senha</th>
                                    <th>Perfil</th>
                                    <th>E-mail</th>
                                    <th>CPF</th>
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
                                    <th>UF</th>
                                    <th>Ações</th></tr>
                            </thead>

                            <tbody>
                                           <?php
                                            $pescTable = new PessoaController();
                                            $listaPessoas = $pescTable->listarPessoas();
                                            $a = 0;
                                            
                                            
                                            if ($listaPessoas != null) {
                                                foreach ($listaPessoas as $lpes) {
                                                    $a++;
                                                     
                                                    ?>
                                        <tr>
                                            <td><?php print_r($lpes->getIdPessoa()); ?></td>
                                            <td><?php print_r($lpes->getNome()); ?></td>
                                            <td><?php print_r($lpes->getDtNasc()); ?></td>
                                            <td><?php print_r($lpes->getLogin()); ?></td>
                                            <td><?php print_r($lpes->getSenha()); ?></td>
                                            <td><?php print_r($lpes->getPerfil()); ?></td>
                                            <td><?php print_r($lpes->getEmail()); ?></td>
                                            <td><?php print_r($lpes->getCpf()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getCep()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getLogradouro()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getComplemento()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getBairro()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getCidade()); ?></td>
                                            <td><?php print_r($lpes->getEndereco()->getUf()); ?></td>

                                            <td><a href="CadastroPessoa.php?id=<?php echo $lpes->getIdPessoa(); ?>"
                                                   class="btn btn-light">
                                                    <img src="img/edita.png" width="32"></a>
                                                </form>
                                                <button type="button" 
                                                        class="btn btn-light" data-bs-toggle="modal" 
                                                        data-bs-target="#exampleModal<?php echo $a; ?>">
                                                    <img src="img/delete.png" width="32"></button></td>
                                        </tr>
                                        <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $a; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" 
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <label><strong>Deseja excluir Pessoa? 
                                                            <?php echo $lpes->getNome(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $lpes->getIdPessoa(); ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="excluir" class="btn btn-primary">Sim</button>
                                                            <button type="reset" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Não</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </div>   


    <script src="js/bootstrap.js"</script>
    <script src="js/bootstrap.min.js" </script>
    <script src="js/JQuery.js"></script>
    <script src="js/JQuery.min.js"></script>

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

         myModal.addEventListener('shown.bs.modal', function () {
             myInput.focus()
            })
    </script>

    <!-- Controle de endereço ViaCep -->
    <script>

        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#cepErro").val("");

            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function () {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");


                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);

                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                //alert("CEP não encontrado.");
                                document.getElementById("valCep").innerHTML = "* CEP não encontrado";
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        //alert("Formato de CEP inválido.");
                        document.getElementById("valCep").innerHTML = "* Formato inválido";
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</body>   

</html>



