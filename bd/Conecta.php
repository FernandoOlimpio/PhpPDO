<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conecta
 *
 * @author 02520429135
 */
class Conecta {
    private $url = "localhost";
    private $user = "root";
    private $password = "senac";
    private $base = "dbphpoo1";
    
    
    public function conectadb(){
        
        try {
            $pdo = new PDO("mysql:host=localhost; dbname= dbphpoo1', root, senac");
        } catch (Exception $ex) {
            echo "<script> alert('Erro na conexão com o banco de dados.')</script>";
        }
        return $pdo;
        
        
    }
            
   
}
