<?php

include_once './model/Mensagem.php';
include_once './model/Endereco.php';
include_once './controller/EnderecoController.php';
$msg = new Mensagem();
$end = new Endereco();
$ec = new EnderecoController();

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
       
        <title>Formulário</title>
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
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-header bg-dark text-center border
                         text-white"><strong>Cadastro de Endereço</strong>
                    </div>
                    <div class="card-body border">
                        <?php
                        //envio dos dados para o BD
                        if (isset($_POST['cadastrarProduto'])) {
                            $nomeProduto = trim($_POST['nomeProduto']);
                            if ($nomeProduto != "") {
                                $vlrCompra = $_POST['vlrCompra'];
                                $vlrVenda = $_POST['vlrVenda'];
                                $qtdEstoque = $_POST['qtdEstoque'];
                                $fornecedor = $_POST['idFornecedor'];

                                $pc = new ProdutoController();
                                unset($_POST['cadastrarProduto']);
                                $msg = $pc->inserirProduto($nomeProduto, $vlrCompra,
                                        $vlrVenda, $qtdEstoque, $fornecedor);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroProduto.php'\">";
                            }
                        }
                        
                        //método para atualizar dados do produto no BD
                        if (isset($_POST['atualizarProduto'])) {
                            $nomeProduto = trim($_POST['nomeProduto']);
                            if ($nomeProduto != "") {
                                $id = $_POST['idproduto'];
                                $vlrCompra = $_POST['vlrCompra'];
                                $vlrVenda = $_POST['vlrVenda'];
                                $qtdEstoque = $_POST['qtdEstoque'];
                                $fornecedor = $_POST['idFornecedor'];

                                $pc = new ProdutoController();
                                unset($_POST['atualizarProduto']);
                                $msg = $pc->atualizarProduto($id, $nomeProduto, 
                                        $vlrCompra, $vlrVenda, $qtdEstoque, $fornecedor);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroProduto.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluir'])) {
                            if ($pr != null) {
                                $id = $_POST['ide'];
                                
                                $pc = new ProdutoController();
                                unset($_POST['excluir']);
                                $msg = $pc->excluirProduto($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroProduto.php'\">";
                            }
                        }
                        
                        if (isset($_POST['excluirProduto'])) {
                            if ($pr != null) {
                                $id = $_POST['idproduto'];
                                
                                $pc = new ProdutoController();
                                unset($_POST['excluirProduto']);
                                $msg = $pc->excluirProduto($id);
                                echo $msg->getMsg();
                                echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"2;
                                    URL='CadastroProduto.php'\">";
                            }
                        }

                        if (isset($_POST['limpar'])) {
                            $pr = null;
                            unset($_GET['id']);
                            header("Location: CadastroProduto.php");
                        }
                        if (isset($_GET['id'])) {
                            $btEnviar = TRUE;
                            $btAtualizar = TRUE;
                            $btExcluir = TRUE;
                            $id = $_GET['id'];
                            $pc = new ProdutoController();
                            $pr = $pc->pesquisarProdutoId($id);
                        }
                        ?>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <strong>Código: <label style="color:red;">
                                            <?php
                                            if ($end != null) {
                                                echo $end->getIdEndereco();
                                                ?>
                                            </label></strong>
                                        <input type="hidden" name="idendereco" 
                                               value="<?php echo $end->getIdEndereco(); ?>"><br>
                                               <?php
                                           }
                                           ?>
                                        
                                    <label>CEP</label>  <label id="cepErro" style="color:red;"></label>
                                    <input class="form-control" type="text"  
                                           value="<?php echo $end->getCep(); ?>" name="cep"
                                           onkeypress="mascara(this, '#####-###')" maxlength="9">
                                    
                                    <label>Logradouro</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $end->getLogradouro(); ?>" name="logradouro">  
                                    
                                    <label>Complemento</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $end->getComplento(); ?>" name="complemento"> 
                                    
                                    <label>Bairro</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $end->getBairro(); ?>" name="bairro">
                                    
                                    <label>Cidade</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $end->getCidade(); ?>" name="cidade">
                                    
                                    <label>UF</label>  
                                    <input class="form-control" type="text" 
                                           value="<?php echo $end->getUf(); ?>" name="uf">
                                    
                                        
                                    <input type="submit" name="cadastrarEndereco"
                                           class="btn btn-success btInput" value="Enviar"
                                           <?php if($btEnviar == TRUE) echo "disabled"; ?>>
                                    
                                    <input type="submit" name="atualizarEndereco"
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
                                                    <input type="submit" name="excluirEndereco"
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
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
                                    <th>UF</th></tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                $ecTable = new EnderecoController();
                                $listaEnderecos = $ecTable->listarEnderecos();
                                $a = 0;
                                if ($listaEnderecos != null) {
                                    foreach ($listaEnderecos as $le) {
                                        $a++;
                                        ?>
                                        <tr>
                                            <td><?php print_r($le->getIdEndereco()); ?></td>
                                            <td><?php print_r($le->getCep()); ?></td>
                                            <td><?php print_r($le->getLogradouro()); ?></td>
                                            <td><?php print_r($le->getComplemento()); ?></td>
                                            <td><?php print_r($le->getBairro()); ?></td>
                                            <td><?php print_r($le->getCidade()); ?></td>
                                            <td><?php print_r($le->getUf()); ?></td>
                                            
                                            <td><a href="CadastroEndereco.php?id=<?php echo $le->getIdEndereco(); ?>"
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
                                                        <label><strong>Deseja excluir o endereço? 
                                                                <?php echo $le->getLogradouro(); ?>?</strong></label>
                                                        <input type="hidden" name="ide" 
                                                               value="<?php echo $le->getIdEndereco(); ?>">
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
