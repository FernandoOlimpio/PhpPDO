<?php
session_start();
include_once '../dao/DaoLogin.php';
include_once '../model/Pessoa.php';

/*
 cÃ³digo de seguranÃ§a 
 verifica se a requisiÃ§Ã£o da pÃ¡gina foi atravÃ©s de formulÃ¡rio e pelo mÃ©todo post,
 e se utilizou as variÃ¡veis esperadas */
if (!empty($_POST) AND !isset($_POST) AND (empty($_POST['login']) 
	OR empty($_POST['senha']))) {
	//destroi as sessÃµes e redireciona para a pÃ¡gina inicial.
	header("Location: ../DestroeSession.php"); exit;
}

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
            $_SESSION['nr'] = rand(1, 100);
            $_SESSION['confereNr'] = $_SESSION['nr'];
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




    