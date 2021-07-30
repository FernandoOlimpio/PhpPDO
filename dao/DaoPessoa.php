<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of daoGenerico
 *
 * @author 02520429135
 */

include_once '../bd/Conecta.php';
class daoPessoa {
    public $conn;
    
    
    function inserir(Pessoa $p){
        $conn = new Conecta();
       
            $sql = "insert into pessoa values (null,'".$p -> getNome()."', '".
                    $p ->getDtNasc()."','".$p ->getLogin()."','".$p ->getSenha()."',
                    '".$p -> getPerfil()."','".$p ->getEmail()."', '".$p ->getCpf()."')";
            if (mysqli_query($conn ->conectadb(), $sql)){
                $msg = "Dados cadastrados com sucesso!";
            }else{
                $msg = "Erro no cadastramento.";
                mysqli_close($conn->conectadb());
                return $msg;
            }
            
       
        
    }
    
}
