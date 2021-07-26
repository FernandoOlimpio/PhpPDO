<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/controller/ProdutoController.php';

class CadastroProduto {
    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
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
                        Cadastro de Produto
                    </div>
                    <div class="card-body border">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <label>Código:</label> <br>

                                    <label> Nome Produto</label>
                                    <input class="form-control" type="text"
                                           name="nomeProduto">

                                    <label> Valor de Compra</label>
                                    <input class="form-control" type="text"
                                           name="vlrCompra">

                                    <label> Valor de Venda </label>
                                    <input class="form-control" type="text"
                                           name="vlrVenda">

                                    <label> Qtd Estoque </label>
                                    <input class="form-control" type="number"
                                           name="qtdEstoque">

                                    <input type="submit" name="cadastrarProduto"
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
        <div class="row" style="margin-top: 30px;">
            <table class="table table-striped table-responsive">
                <thead class="table-dark">
                    <tr><th>Código</th>
                        <th>Nome</th>
                        <th>Compra (R$)</th>
                        <th>Venda (R$)</th>
                        <th>Estoque</th>
                        <th> Ações</th></tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'c:/xampp/htdocs/PhpMatutinoPDO/controller/ProdutoController.php';

                    $pcTable = new ProdutoController();
                    $listaProdutos = $pcTable->listarProdutos();
                    foreach ($listaProdutos as $lp) {
                        ?>

                        <tr> <?php // jeito de preencher tabela mesclando php e html?>
                            <td> <?php print_r($lp->getIdProduto());?></td>
                            <td> <?php print_r($lp->getNomeProduto());?></td>
                            <td> <?php print_r($lp->getVlrCompra());?></td>
                            <td> <?php print_r($lp->getVlrVenda());?></td>
                            <td> <?php print_r($lp->getQtdEstoque());?></td>
                            
                            <td><a class="btn btn-light"
                                   href="#?id=<?php echo $lp->getIdProduto();?>">
                                   Editar</a>
                                
                                <a class="btn btn-light"
                                   href="#id=<?php echo $lp->getIdProduto();?>">
                                   Excluir</a>
                            </td>
                        </tr>
                        <?php
                           /* print_r("<tr><td>" . $lp->getIdProduto() . "</td>");
                            print_r("<td>" . $lp->getNomeProduto() . "</td>");
                            print_r("<td>" . $lp->getVlrCompra() . "</td>");
                            print_r("<td>" . $lp->getVlrVenda() . "</td>");
                            print_r("<td>" . $lp->getQtdEstoque() . "</td></tr>");
                            jeito de preencher tabela com php separado*/
                             ?>
                            

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php
//envio dos dados para o BD
    include_once 'c:/xampp/htdocs/PhpMatutinoPDO/controller/ProdutoController.php';
    if (isset($_POST['cadastrarProduto'])) {
        $nomeProduto = $_POST['nomeProduto'];
        $vlrCompra = $_POST['vlrCompra'];
        $vlrVenda = $_POST['vlrVenda'];
        $qtdEstoque = $_POST['qtdEstoque'];


        $pc = new ProdutoController();
        echo $pc->inserirProduto();
    }
    ?>        
    <script src="js/bootstrap.js"</script>
    <script src="js/bootstrap.min.js" </script>
</body>   

</html>
