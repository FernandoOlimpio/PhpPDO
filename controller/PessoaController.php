<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PessoaController
 *
 * @author 02520429135
 */
class PessoaController {
    function inserirPessoa($nome, $dtNasc, $login, $senha, $perfil, $email, $cpf){
        $pessoa = new Pessoa();
        $pessoa ->setNome($nome);
        $pessoa ->setDtNasc($dtNasc);
        $pessoa ->setLogin($login);
        $pessoa ->setSenha($senha);
        $pessoa ->setPerfil($perfil);
        $pessoa ->setEmail($email);
        $pessoa ->setCpf($cpf);
                
                $daoPessoa = new DaoPessoa();
                return $daoPessoa ->inserir($pessoa);
    }
}
