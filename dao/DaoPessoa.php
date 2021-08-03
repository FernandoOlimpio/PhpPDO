<?php

include_once './model/Pessoa.php';

class DaoPessoa {

    public function inserirPessoaDAO(Pessoa $pessoa) {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

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
                $st = $conecta->prepare("select idendereco from endereco where cep = ? " //quando tem parametro a passar usa-se o prepare, aundo nao tem usa-se query
                        . "logradouro = ?");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $linhaEndereco = $st->execute();
                if ($linhaEndereco) {
                    $fkEnd = $linhaEndereco->idendereco; //o endereço existindo, é jogado o idendereço na variavel fkEnd para setar em pessoa.

                    $st = $conecta->prepare("INSERT INTO pessoa values(null,?,?,?,?,?,?,?,?)");
                    $st->bindParam(1, $nome);
                    $st->bindParam(2, $dtNasc);
                    $st->bindParam(3, $login);
                    $st->bindParam(4, $senha);
                    $st->bindParam(5, $perfil);
                    $st->bindParam(6, $email);
                    $st->bindParam(7, $cpf);
                    $st->bindParam(8, $fkEnd);
                    
                    $st->execute();
                    $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
                } else {
                    $st = $conecta->prepare("INSERT INTO endereco values(null,?,?,?,?,?,?)");
                    $st->bindParam(1, $cep);
                    $st->bindParam(2, $logradouro);
                    $st->bindParam(3, $complemento);
                    $st->bindParam(4, $bairro);
                    $st->bindParam(5, $cidade);
                    $st->bindParam(6, $uf);
                    
                    $st->execute();
                    
                    $st = $conecta->prepare("SELECT idendereco from endereco where cep = ? "
                            . "and logradouro=?");
                    /*$st->bindParam(1, $cep);
                    $st->bindParam(2, $logradouro);
                    $linhaEndereco = $st->execute();*/
                    $fkEnd = $st->execute();
                    
                    $st = $conecta->prepare("INSERT INTO pessoa values(null,?,?,?,?,?,?,?,?)");
                    $st->bindParam(1, $nome);
                    $st->bindParam(2, $dtNasc);
                    $st->bindParam(3, $login);
                    $st->bindParam(4, $senha);
                    $st->bindParam(5, $perfil);
                    $st->bindParam(6, $email);
                    $st->bindParam(7, $cpf);
                    $st->bindParam(8, $fkEnd);
                    
                    $st->execute();
                    $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
                    
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        
        $conn = null;
        return $msg;
        
    }

}
