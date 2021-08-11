<?php

session_start();
include_once './dao/DaoLogin.php';

require_once './model/Pessoa.php';

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$daoLogin = new DaoLogin();

$resp = new Pessoa();
$resp = $daoLogin->validarLogin($login, $senha);
if (gettype($resp) == "object") {
    if ($resp != null) {
        if (isset($_SESSION['loginp'])) {
            $_SESSION['loginp'] = $resp->getLogin();
            $_SESSION['idp'] = $resp->getIdPessoa();
            $_SESSION['nomep'] = $resp->getNome();
            $_SESSION['perfilp'] = $resp->getPerfil();
            $_SESSION['nr'] = rand(1,1000);
            setcookie("nr2", $_SESSION['nr']);
            header("Location: Inicio.php");
            exit;
        }
    } else {
        $_SESSION['msg'] = $resp;
        header("Location: index.php");
        exit;
    }

}

    