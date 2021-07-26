<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/dao/DaoProduto.php';
include_once 'c:/xampp/htdocs/PhpMatutinoPDO/model/Produto.php';

class ProdutoController {
    public function inserirProduto($nomeProduto, $vlrCompra, $vlrVenda, $qtdEstoque) {
        $produto = new Produto();
        $produto->setNomeProduto($nomeProduto);
        $produto->setVlrCompra($vlrCompra);
        $produto->setVlrVenda($vlrVenda);
        $produto->setQtdEstoque($qtdEstoque);
        
        $daoProduto = new DaoProduto();
        return $daoProduto-> inserir($produto);
        
    }
    
    //Método para carregar a lista de produtos que vem da DAO
    public function listarProdutos() {
        $daoProduto = new DaoProduto();
        return $daoProduto-> listarProdutosDao();
        
    }
}