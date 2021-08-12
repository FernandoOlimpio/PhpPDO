<?php

include_once '../dao/DaoLogin.php';
include_once '../model/Pessoa.php';


$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$daoLogin = new DaoLogin();

$resp = new Pessoa();
$resp = $daoLogin->validarLoginDAO($login, $senha);
if (gettype($resp) == "object") {
    if ($resp != null) {
        if (isset($_SESSION['login'])) {
            $_SESSION['loginp'] = $resp->getLogin();
            $_SESSION['idp'] = $resp->getIdPessoa();
            $_SESSION['nomep'] = $resp->getNome();
            $_SESSION['perfilp'] = $resp->getPerfil();
           
            
            
            header("Location: ../index.php");
            exit;
        }
    }
}else {
            
        $_SESSION['msg'] = $resp;
        if (isset($_SESSION['login'])){
            $_SESSION['loginp']=null;
            $_SESSION['idp']=null;
            $_SESSION['nomep']=null;
            $_SESSION['perfilp']=null;
        }
        
        header("Location: ../index.php");
        exit;
    
}


    