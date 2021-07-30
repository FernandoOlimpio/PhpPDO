<?php

include_once 'C:/xampp/htdocs/PhpMatutinoPDO/dao/DaoFornecedor.php';//sala
include_once 'C:/xampp/htdocs/PhpMatutinoPDO/model/Fornecedor.php';//sala
/*
include_once 'C:/xampp/htdocs/PhpPDO/dao/DaoFornecedor.php';//casa
include_once 'C:/xampp/htdocs/PhpPDO/model/Fornecedor.php';//casa
*/
class FornecedorController {
    
    public function inserirFornecedor($nomeFornecedor, $logradouro,
            $complemento, $bairro, $cidade, $uf, $cep, $representante, $email,
            $telFixo, $telCel){
        $fornecedor = new Fornecedor();
        $fornecedor->setNomeFornecedor($nomeFornecedor);
        $fornecedor->setLogradouro($logradouro);
        
        $fornecedor->setComplemento($complemento);
        $fornecedor->setBairro($bairro);
        $fornecedor->setCidade($cidade);
        $fornecedor->setUf($uf);
        $fornecedor->setCep($cep);
        $fornecedor->setRepresentante($representante);
        $fornecedor->setEmail($email);
        $fornecedor->setTelFixo($telFixo);
        $fornecedor->setTelCel($telCel);
        
        
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->inserirFornecedorDAO($fornecedor);
    }
    
    //método para atualizar dados de fornecedor no BD
    public function atualizarFornecedor($idFornecedor, $nomeFornecedor, $logradouro, 
            $complemento, $bairro, $cidade, $uf, $cep, $representante, $email,
            $telFixo, $telCel){
        $fornecedor = new Fornecedor();
        $fornecedor->setIdFornecedor($idFornecedor);
        $fornecedor->setNomeFornecedor($nomeFornecedor);
        $fornecedor->setLogradouro($logradouro);
        
        $fornecedor->setComplemento($complemento);
        $fornecedor->setBairro($bairro);
        $fornecedor->setCidade($cidade);
        $fornecedor->setUf($uf);
        $fornecedor->setCep($cep);
        $fornecedor->setRepresentante($representante);
        $fornecedor->setEmail($email);
        $fornecedor->setTelFixo($telFixo);
        $fornecedor->setTelCel($telCel);
        
        
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->atualizarFornecedorDAO($fornecedor);
    }
    
    //método para carregar a lista de fornecedores que vem da DAO
    public function listarFornecedor(){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->listarFornecedorDAO();
    }
    
    //método para excluir fornecedor
    public function excluirFornecedor($id){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->excluirFornecedorDAO($id);
    }
    
    //método para retornar objeto fornecedor com os dados do BD
    public function pesquisarFornecedorId($id){
        $daoFornecedor = new DaoFornecedor();
        return $daoFornecedor->pesquisarFornecedorIdDAO($id);
    }

    
    //método para limpar formulário
    public function limpar(){
        return $pr = new Fornecedor();
    }
}

