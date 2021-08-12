<?php
session_start();
include_once '../dao/DaoLogin.php';
include_once '../model/Pessoa.php';

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $senhaAux = $_POST['senha'];
    $senha = md5($senhaAux);
}
$daoLogin = new DaoLogin();

$resp = new Pessoa();
$resp = $daoLogin->validarLoginDAO($login, $senha);
if (gettype($resp) == "object") {
    if ($resp != null) {
        if (!isset($_SESSION['login'])) { //se sessão login não existir, seta as sessões e entra na página principal.
            $_SESSION['loginp'] = $resp->getLogin();
            $_SESSION['idp'] = $resp->getIdPessoa();
            $_SESSION['nomep'] = $resp->getNome();
            $_SESSION['perfilp'] = $resp->getPerfil();

            header("Location: ../Inicio.php");
            exit;
        }
    }
} else { // login e/ou senha errados; acesso negado.

    $_SESSION['msg'] = $resp;
     //if (isset($_SESSION['login'])){
      //$_SESSION['loginp']=null;
      //$_SESSION['idp']=null;
      //$_SESSION['nomep']=null;
      //$_SESSION['perfilp']=null;
      //}
     
    header("Location: ../index.php");
    exit;
}




    