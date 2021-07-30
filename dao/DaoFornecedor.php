<?php
/*include_once 'C:/xampp/htdocs/PhpMatutinoPDO/bd/Conecta.php';//include sala
include_once 'C:/xampp/htdocs/PhpMatutinoPDO/model/Fornecedor.php';//include sala
include_once 'C:/xampp/htdocs/PhpMatutinoPDO/model/Mensagem.php';//include sala
*/
include_once 'C:/xampp/htdocs/PhpPDO/bd/Conecta.php'; //include casa
include_once 'C:/xampp/htdocs/PhpPDO/model/Fornecedor.php';//include casa
include_once 'C:/xampp/htdocs/PhpPDO/model/Mensagem.php';//include casa

class DaoFornecedor{
     public function inserirFornecedorDAO(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradouro = $fornecedor->getLogradouro();
            $numero = $fornecedor->getNumero();
            $complemento = $fornecedor->getComplemento();
            $bairro = $fornecedor->getBairro();
            $cidade = $fornecedor->getCidade();
            $uf = $fornecedor->getUf();
            $cep = $fornecedor->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telFixo = $fornecedor->getTelFixo();
            $telCel = $fornecedor->getTelCel();
            
            try {
                $stmt = $conecta->prepare("insert into fornecedor values "
                        . "(null,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $nomeFornecedor);
                $stmt->bindParam(2, $logradouro);
                $stmt->bindParam(3, $numero);
                $stmt->bindParam(4, $complemento);
                $stmt->bindParam(5, $bairro);
                $stmt->bindParam(6, $cidade);
                $stmt->bindParam(7, $uf);
                $stmt->bindParam(8, $cep);
                $stmt->bindParam(9, $representante);
                $stmt->bindParam(10, $email);
                $stmt->bindParam(11, $telFixo);
                $stmt->bindParam(12, $telCel);
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
    
    //método para atualizar dados da tabela fornecedor
    public function atualizarFornecedorDAO(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $idFornecedor = $fornecedor->getIdFornecedor();
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradouro = $fornecedor->getLogradouro();
            $numero = $fornecedor->getNumero();
            $complemento = $fornecedor->getComplemento();
            $bairro = $fornecedor->getBairro();
            $cidade = $fornecedor->getCidade();
            $uf = $fornecedor->getUf();
            $cep = $fornecedor->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telFixo = $fornecedor->getTelFixo();
            $telCel = $fornecedor->getTelCel();
            try{
                $stmt = $conecta->prepare("update fornecedor set "
                        . "nomefornecedor = ?,"
                        . "logradouro  = ?,"
                        . "numero  = ?, "
                        . "complemento  = ?, "
                        . "bairro = ?, "
                        . "cidade = ?, "
                        . "uf = ?,"
                        . "cep = ?, "
                        . "representante = ?,"
                        . "email = ?,"
                        . "telfixo = ?,"
                        . "telcel = ?,"
                        . "where idfornecedor = ?");
                
                $stmt->bindParam(1, $nomeFornecedor);
                $stmt->bindParam(2, $logradouro);
                $stmt->bindParam(3, $numero);
                $stmt->bindParam(4, $complemento);
                $stmt->bindParam(5, $bairro);
                $stmt->bindParam(6, $cidade);
                $stmt->bindParam(7, $uf);
                $stmt->bindParam(8, $cep);
                $stmt->bindParam(9, $representante);
                $stmt->bindParam(10, $email);
                $stmt->bindParam(11, $telFixo);
                $stmt->bindParam(12, $telCel);
                $stmt->bindParam(13, $idFornecedor);
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
    
    //método para carregar lista de fornecedors do banco de dados
    public function listarFornecedorDAO(){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        if($conecta){
            try {
                $rs = $conecta->query("select * from fornecedor");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $fornecedor = new Fornecedor();
                            $fornecedor->setIdFornecedor($linha->idfornecedor );
                            $fornecedor->setNomeFornecedor($linha->nomefornecedor );
                            $fornecedor->setLogradouro($linha->logradouro );
                            $fornecedor->setNumero($linha->numero );
                            $fornecedor->setComplemento($linha->complemento );
                            $fornecedor->setBairro($linha->bairro );
                            $fornecedor->setCidade($linha->cidade );
                            $fornecedor->setUf($linha->uf );
                            $fornecedor->setCep($linha->cep );
                            $fornecedor->setRepresentante($linha->representante );
                            $fornecedor->setEmail($linha->email );
                            $fornecedor->setTelFixo($linha->telfixo );
                            $fornecedor->setTelCel($linha->telcel );
                           
                            $lista[$a] = $fornecedor;
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
    
    //método para excluir fornecedor na tabela fornecedor
    public function excluirFornecedorDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from fornecedor "
                        . "where idfornecedor = ?");
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
    
    //método para os dados de fornecedor por id
    public function pesquisarFornecedorIdDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $fornecedor = new Fornecedor();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from fornecedor where "
                        . "idfornecedor = ?");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $fornecedor->setIdFornecedor($linha->idfornecedor);
                            $fornecedor->setNomeFornecedor($linha->nomefornecedor);
                            $fornecedor->setLogradouro($linha->logradouro );
                            $fornecedor->setNumero($linha->numero );
                            $fornecedor->setComplemento($linha->complemento );
                            $fornecedor->setBairro($linha->bairro);
                            $fornecedor->setCidade($linha->cidade);
                            $fornecedor->setUf($linha->uf);
                            $fornecedor->setCep($linha->cep);
                            $fornecedor->setRepresentante($linha->representante);
                            $fornecedor->setEmail($linha->email);
                            $fornecedor->setTelFixo($linha->telfixo);
                            $fornecedor->setTelCel($linha->telcel);
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
			 URL='../CadastroFornecedor.php'\">"; 
        }
        return $fornecedor;
    }
    
}
