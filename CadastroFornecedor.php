

<?php 
include_once './controller/FornecedorController.php';
include_once './model/Fornecedor.php';
include_once './model/Mensagem.php';
$msg = new Mensagem();
$f = new Fornecedor();
$btEnviar = FALSE;
$btAtualizar = FALSE;
$btExcluir = FALSE;

session_start();

if((!isset($_SESSION['loginp']) || !isset($_SESSION['nomep'])) ||
    !isset($_SESSION['perfilp']) || !isset($_SESSION['nr']) ||
    $_SESSION['nr'] < 1 || ($_SESSION['nr'] != $_SESSION['confereNr'])) { 
    //Usuário não logado! Redireciona para a página de login 
    header("Location: DestroeSession.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Formulário Fornecedor</title>
        <style>
            .btInput{
                padding: 10px 20px 10px 20px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>
        
              <script>
   
    function mascara(t, mask){
 var i = t.value.length;
 var saida = mask.substring(1,0);
 var texto = mask.substring(i);
 if (texto.substring(0,1) != saida){
 t.value += texto.substring(0,1);
 
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
                <!--<a class="navbar-brand" href="#">Navbar</a>
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
                </div>-->
            </div>
        </nav>


        <div class="container-fluid">
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-header bg-dark text-center border
                         text-white"><strong>Cadastro de Fornecedor</strong>
                    </div>
                    <div class="card-body border">
                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarFornecedor'])) {
                            $nomeFornecedor = trim($_POST['nomeFornecedor']);
                            if ($nomeFornecedor != "") {
                                $logradouro = $_POST['logradouro'];
                                
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];
                                $cep = $_POST['cep'];
                                $representante = $_POST['representante'];
                                $email = $_POST['email'];
                                $telFixo = $_POST['telFixo'];
                                $telCel = $_POST['telCel'];

                                $fc = new FornecedorController();
                                unset($_POST['cadastrarFornecedor']);
                                $msg = $fc->inserirFornecedor($nomeFornecedor, $logradouro,
            $complemento, $bairro, $cidade, $uf, $cep, $representante, $email,
            $telFixo, $telCel);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroFornecedor.php'\">";
                            }
                        }

                        //método para atualizar dados do fornecedor no BD
                        if (isset($_POST['atualizarFornecedor'])) {
                            $nomeFornecedor = trim($_POST['nomeFornecedor']);
                            if ($nomeFornecedor != "") {
                                $idFornecedor = $_POST['idFornecedor'];
                                $logradouro = $_POST['logradouro'];
                                
                                $complemento = $_POST['complemento'];
                                $bairro = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $uf = $_POST['uf'];
                                $cep = $_POST['cep'];
                                $representante = $_POST['representante'];
                                $email = $_POST['email'];
                                $telFixo = $_POST['telFixo'];
                                $telCel = $_POST['telCel'];


                                $fc = new FornecedorController();
                                unset($_POST['atualizarFornecedor']);
                                $msg = $fc->atualizarFornecedor($idFornecedor, 
            $nomeFornecedor, $logradouro, $complemento, $bairro, $cidade,
             $uf, $cep, $representante, $email, $telFixo, $telCel);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroFornecedor.php'\">";
                            }
                        }



                        if (isset($_POST['excluir'])) {
                            if ($f != null) {
                                $idFornecedor = $_POST['ide'];

                                $fc = new FornecedorController();
                                unset($_POST['excluir']);
                                $msg = $fc->excluirFornecedor($idFornecedor);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroFornecedor.php'\">";
                            }
                        }

                        if (isset($_POST['excluirFornecedor'])) {
                            if ($f != null) {
                                $idFornecedor = $_POST['idFornecedor'];
                                unset($_POST['excluirFornecedor']);
                                $fc = new FornecedorController();
                                $msg = $fc->excluirFornecedor($idFornecedor);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroFornecedor.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $f = null;
                            unset($_GET['idFornecedor']);
                            header("Location: CadastroFornecedor.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $idFornecedor = $_GET['id'];
                            $fc = new FornecedorController();
                            $f = $fc->pesquisarFornecedorId($idFornecedor);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($f != null) {
                                                echo $f->getIdFornecedor();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idFornecedor" 
                                               value="<?php echo $f->getIdFornecedor(); ?>"><br>
                                               <?php
                                           }
                                           ?>     
                                    <label>Fornecedor</label>  
                                    <input class="form-control" type="text" 
                                           name="nomeFornecedor" 
                                           value="<?php echo $f->getNomeFornecedor(); ?>">

                                    <label>Logradouro</label>  
                                    <input class="form-control" type="text" id="rua"
                                           value="<?php echo $f->getLogradouro(); ?>" name="logradouro"> 

                

                                    <label>Complemento</label>  
                                    <input class="form-control" type="text" id="complemento"
                                           value="<?php echo $f->getComplemento(); ?>" name="complemento">

                                    <label>Bairro</label>  
                                    <input class="form-control" type="text" id="bairro"
                                           value="<?php echo $f->getBairro(); ?>" name="bairro">

                                    <label>Cidade</label>  
                                    <input class="form-control" type="text" id="cidade"
                                           value="<?php echo $f->getCidade(); ?>" name="cidade">

                                    <label>UF</label>  
                                    <input class="form-control" type="text" id="uf"
                                           value="<?php echo $f->getUf(); ?>" name="uf">

                                    <label>CEP</label>  <label id="cepErro" style="color:red;"></label>
                                    <input class="form-control" type="text"  id="cep" 
                                           value="<?php echo $f->getCep(); ?>" name="cep"
                                           onkeypress="mascara(this, '#####-###')" maxlength="9">

                                    <label>Representante</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $f->getRepresentante(); ?>" name="representante">

                                    <label>Email</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $f->getEmail(); ?>" name="email">

                                    <label>Telefone Fixo</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $f->getTelFixo(); ?>" name="telFixo">

                                    <label>Telefone Celular</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $f->getTelCel(); ?>" name="telCel">


                                    <input type="submit" name="cadastrarFornecedor"
                                           class="btn btn-success btInput" value="Enviar"
                                           <?php if($btEnviar == TRUE) echo "disabled"; ?>>
                                    <input type="submit" name="atualizarFornecedor"
                                           class="btn btn-secondary btInput" value="Atualizar"
                                           <?php if($btAtualizar == FALSE) echo "disabled"; ?>>
                                    <button type="button" class="btn btn-warning btInput" 
                                            data-bs-toggle="modal" data-bs-target="#ModalExcluir"
                                            <?php if($btExcluir == FALSE) echo "disabled"; ?>>
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
                                                    <input type="submit" name="excluirFornecedor"
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
                                    <th>Nome Fornecedor</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
                                    <th>UF</th>
                                    <th>CEP</th>
                                    <th>Representante</th>
                                    <th>Email</th>
                                    <th>Tel. Fixo</th>
                                    <th>Tel. Celular</th></tr>
                            </thead>
                            <tbody>
                                <?php
                                $fcTable = new FornecedorController();
                                $listaFornecedores = $fcTable->listarFornecedor();
                                $a = 0;
                                if ($listaFornecedores != null) {
                                    foreach ($listaFornecedores as $lf) {
                                        $a++;
                                        ?>
                                        <tr>
                                            <td><?php print_r($lf->getIdFornecedor()); ?></td>
                                            <td><?php print_r($lf->getNomeFornecedor()); ?></td>
                                            <td><?php print_r($lf->getLogradouro()); ?></td>
                                            <td><?php print_r($lf->getComplemento()); ?></td>
                                            <td><?php print_r($lf->getBairro()); ?></td>
                                            <td><?php print_r($lf->getCidade()); ?></td>
                                            <td><?php print_r($lf->getUf()); ?></td>
                                            <td><?php print_r($lf->getCep()); ?></td>
                                            <td><?php print_r($lf->getRepresentante()); ?></td>
                                            <td><?php print_r($lf->getEmail()); ?></td>
                                            <td><?php print_r($lf->getTelFixo()); ?></td>
                                            <td><?php print_r($lf->getTelCel()); ?></td>

                                            <td><a href="CadastroFornecedor.php?id=<?php echo $lf->getIdFornecedor(); ?>"
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
                                                        <label><strong>Deseja excluir o Fornecedor 
                                                                <?php echo $lf->getNomeFornecedor(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $lf->getIdFornecedor(); ?>">
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


    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
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

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                 $("#cepErro").val("");
                
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

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
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
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