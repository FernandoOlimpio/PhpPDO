<?php

include_once './dao/DaoPessoa.php';
include_once './model/Pessoa.php';
include_once './model/Endereco.php';
class PessoaController {

    function inserirPessoa($nome, $dtNasc, $login, $senha, $perfil, $email, $cpf,
            $cep, $logradouro, $complemento, $bairro, $cidade, $uf) {
        
        
        $pessoa = new Pessoa();
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);

        
        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setUf($uf);
        
        $pessoa->setEndereco($endereco);
        
       
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->inserirPessoaDao($pessoa);
    }
    
    public function atualizarPessoa($idPessoa,$nome, $dtNasc, $login, $senha, $perfil, $email, $cpf,
            $cep, $logradouro, $complemento, $bairro, $cidade, $uf) {
        
        $pessoa = new Pessoa();
        $pessoa->setIdPessoa($idPessoa);
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);
        
        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setUf($uf);
        
        $pessoa->setEndereco($endereco);
        
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->atualizarPessoaDAO($pessoa);
        
    }
    
    public function listarPessoas() {
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->listarPessoasDAO();
    }

}
