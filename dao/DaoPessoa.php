<?php

include_once './model/Pessoa.php';
class DaoPessoa{
    
    public function inserirPessoaDAO(Pessoa $pessoa) {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            
            $nome = $pessoa->getNome();
            $dtNasc = $pessoa->getDtNasc();
            $login = $pessoa->getLogin();
            $senha = $pessoa->getSenha();
            $perfil = $pessoa->getPerfil();
            $email = $pessoa->getEmail();
            $cpf = $pessoa->getCpf();
            
            $cep = $pessoa->getEndereco()->getCep();
            $logradouro = $pessoa->getEndereco()->getLogradouro();
            $complemento = $pessoa->getEndereco()->getComplemento();
            $bairro = $pessoa->getEndereco()->getBairro();
            $cidade = $pessoa->getEndereco()->getCidade();
            $uf = $pessoa->getEndereco()->getUf();
            
            try {
               $st = $conecta->prepare("select idendereco from endereco where cep = ? " //uando tem parametro a passar usa-se o prepare, aundo nao tem usa-se query
                        . "logradouro = ?");
                    
               $st->bindParam(1,$cep);
               $st->bindParam(2,$logradouro);
               $linhaEndereco= $st->execute();
               if ($linhaEndereco){
                   $fkEnd= $linhaEndereco->idendereco;
                   
               }
                
                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
                }
    }
    
}

