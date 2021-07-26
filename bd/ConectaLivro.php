<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConectaLivro {
    private $endereco= "localhost";
    private $usuario= "root";
    private $senha= "senac";
    private $banco= "dblivro";
    
    public function conectadb() {
        try {
            $pdo = new PDO("mysql:host=localhost; dbname= dblivro, root, senac");
        } catch (Exception $ex) {
            echo "<script> alert('Erro na conexão com o banco de dados.')</script>";
        }
        return $pdo;
        
    }
    
}
