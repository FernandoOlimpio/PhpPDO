<?php


include_once 'c:/xampp/htdocs/PhpMatutinoPDO/bd/Conecta.php';//sala
include_once 'c:/xampp/htdocs/PhpMatutinoPDO/model/Produto.php';//sala
include_once 'C:/xampp/htdocs/PhpMatutinoPDO/model/Mensagem.php';//sala
include_once 'C:/xampp/htdocs/PhpMatutinoPDO/model/Fornecedor.php';//sala
/*
include_once 'c:/xampp/htdocs/PhpPDO/bd/Conecta.php';//casa
include_once 'c:/xampp/htdocs/PhpPDO/model/Produto.php';//casa
include_once 'C:/xampp/htdocs/PhpPDO/model/Mensagem.php';//casa
include_once 'C:/xampp/htdocs/PhpPDO/model/Fornecedor.php';//casa
*/
class DaoProduto {

     public function inserirProdutoDAO(Produto $produto){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nomeProduto = $produto->getNomeProduto();
            $vlrCompra = $produto->getVlrCompra();
            $vlrVenda = $produto->getVlrVenda();
            $qtdEstoque = $produto->getQtdEstoque();
            $fornecedor = $produto->getFornecedor();
            try {
                $stmt = $conecta->prepare("insert into produto values "
                        . "(null,?,?,?,?,?)");
                $stmt->bindParam(1, $nomeProduto);
                $stmt->bindParam(2, $vlrCompra);
                $stmt->bindParam(3, $vlrVenda);
                $stmt->bindParam(4, $qtdEstoque);
                $stmt->bindParam(5, $fornecedor);
                $stmt->execute();
                $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }
    
    //método para atualizar dados da tabela produto
    public function atualizarProdutoDAO(Produto $produto){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $id = $produto->getIdProduto();
            $nomeProduto = $produto->getNomeProduto();
            $vlrCompra = $produto->getVlrCompra();
            $vlrVenda = $produto->getVlrVenda();
            $qtdEstoque = $produto->getQtdEstoque();
            $fornecedor = $produto->getFornecedor();
            try{
                $stmt = $conecta->prepare("update produto set "
                        . "nome = ?,"
                        . "vlrCompra = ?,"
                        . "vlrVenda = ?, "
                        . "qtdEstoque = ?, "
                        . "fkfornecedor = ?"
                        . "where id = ?");
                $stmt->bindParam(1, $nomeProduto);
                $stmt->bindParam(2, $vlrCompra);
                $stmt->bindParam(3, $vlrVenda);
                $stmt->bindParam(4, $qtdEstoque);
                $stmt->bindParam(5, $fornecedor);
                $stmt->bindParam(6, $id);
                
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                        . "Dados atualizados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }
    
    //método para carregar lista de produtos do banco de dados
    public function listarProdutosDAO(){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        if($conecta){
            try {
                $rs = $conecta->query("SELECT * FROM produto INNER JOIN fornecedor"
                        . " on produto.fkfornecedor = fornecedor.idfornecedor"
                        . "ORDER BY produto.id DESC");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto = new Produto();
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
                            
                            $forn = new Fornecedor();
                            $forn->setIdFornecedor($linha->idfornecedor);
                            $forn->setNomeFornecedor($linha->nomefornecedor);
                            $forn->setLogradouro($linha->logradouro);
                            
                            $forn->setComplemento($linha->complemento);
                            $forn->setBairro($linha->bairro);
                            $forn->setCidade($linha->cidade);
                            $forn->setUf($linha->uf);
                            $forn->setCep($linha->cep);
                            $forn->setRepresentante($linha->representante);
                            $forn->setEmail($linha->email);
                            $forn->setTelFixo($linha->telfixo);
                            $forn->setTelCel($linha->telcel);
                            
                            $produto->setFornecedor($forn);
                            
                            $lista[$a] = $produto;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;           
            return $lista;
        }
    }
    
    //método para excluir produto na tabela produto
    public function excluirProdutoDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete *from produto "
                        . "where id = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }
    
    //método para os dados de produto por id
    public function pesquisarProdutoIdDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $produto = new Produto();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from produto inner join "
                        . "fornecedor on produto.fkfornecedor = fornecedor.idfornecedor "
                        . "where produto.id = ?");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
                            
                            $forn = new Fornecedor();
                            $forn->setIdFornecedor($linha->idfornecedor);
                            $forn->setNomeFornecedor($linha->nomefornecedor);
                            $forn->setLogradouro($linha->logradouro);
                         
                            $forn->setComplemento($linha->complemento);
                            $forn->setBairro($linha->bairro);
                            $forn->setCidade($linha->cidade);
                            $forn->setUf($linha->uf);
                            $forn->setCep($linha->cep);
                            $forn->setRepresentante($linha->representante);
                            $forn->setEmail($linha->email);
                            $forn->setTelFixo($linha->telfixo);
                            $forn->setTelCel($linha->telcel);
                            
                            $produto->setFornecedor($forn);
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;
        }else{
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PhpMatutinoPDO/CadastroProduto.php'\">"; 
        }
        return $produto;
    }

}
