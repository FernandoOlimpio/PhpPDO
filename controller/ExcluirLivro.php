<?php

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/controller/LivroController.php';

$id = $_REQUEST['ide'];
$lc = new LivroController();
$lc->excluirLivro($id);



