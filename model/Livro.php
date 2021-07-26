<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Livro{
    
    private $idLivro;
    private $titulo;
    private $autor;
    private $editora;
    private $qtdEstoque;
    
    function getIdLivro() {
        return $this->idLivro;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getEditora() {
        return $this->editora;
    }

    function getQtdEstoque() {
        return $this->qtdEstoque;
    }

    function setIdLivro($idLivro) {
        $this->idLivro = $idLivro;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setEditora($editora) {
        $this->editora = $editora;
    }

    function setQtdEstoque($qtdEstoque) {
        $this->qtdEstoque = $qtdEstoque;
    }


}