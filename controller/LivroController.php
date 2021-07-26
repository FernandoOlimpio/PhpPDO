<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/dao/DaoLivro.php';
include_once 'c:/xampp/htdocs/PhpMatutinoPDO/model/Livro.php';
class LivroController{
    
    public function inserirLivro($titulo, $autor, $editora, $qtdEstoque) {
        $livro= new Livro();
        $livro->setTitulo($titulo);
        $livro->setAutor($autor);
        $livro->setEditora($editora);
        $livro->setQtdEstoque($qtdEstoque);
        
        $daoLivro= new DaoLivro;
        return $daoLivro->inserir($livro);
        
    }
    
    //método para atualizar dados de livro no BD
    public function atualizarLivro($idLivro,$titulo, $autor, $editora, $qtdEstoque){
        $livro= new Livro();
        $livro->setIdLivro($idLivro);
        $livro->setTitulo($titulo);
        $livro->setAutor($autor);
        $livro->setEditora($editora);
        $livro->setQtdEstoque($qtdEstoque);
       
        $daoLivro= new DaoLivro;
        return $daoLivro->atualizar($livro);
    }
    
    //método para carregar a lista de livro que vem da DAO
    public function listarLivro() {
        $daoLivro= new DaoLivro();
        return $daoLivro->listar();
    }
    
    //método para excluir livro
    public function excluirLivro($id) {
        $daoLivro =  new DaoLivro;
        $daoLivro-> excluir($id);
        
    }
    
    //método para retornar objeto livro com os daods do BD
    public function pesquisarLivro($id) {
        $daoLivro = new DaoLivro();
        return $daoLivro->pesquisar($id);
    }
    
    //método para editar livro
    public function editarLivro($id) {
        $daoLivro = new DaoLivro();
        return $daoLivro->editar($id);
    }
    //método para limpar formulário
    public function limpar() {
        return $l = new Livro;
    }
    
    
}