<?php


class Produto {
    
    private $idProduto;
    private $nomeProduto;
    private $vlrCompra;
    private $vlrVenda;
    private $qtdEstoque;
    private $fornecedor; //variavel que vai receber o objeto fornecedor.
    /*
    public function fornecedorDados(){
        return $fornecedor = new Fornecedor();
    }
    */
   function getFornecedor() {
       return $this->fornecedor;
   }

   function setFornecedor($fornecedor) {
       $this->fornecedor = $fornecedor;
   }

       
    function getIdProduto() {
        return $this->idProduto;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

        
    function getNomeProduto() {
        return $this->nomeProduto;
    }

    function getVlrCompra() {
        return $this->vlrCompra;
    }

    function getVlrVenda() {
        return $this->vlrVenda;
    }

    function getQtdEstoque() {
        return $this->qtdEstoque;
    }

    function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    function setVlrCompra($vlrCompra) {
        $this->vlrCompra = $vlrCompra;
    }

    function setVlrVenda($vlrVenda) {
        $this->vlrVenda = $vlrVenda;
    }

    function setQtdEstoque($qtdEstoque) {
        $this->qtdEstoque = $qtdEstoque;
    }



}
