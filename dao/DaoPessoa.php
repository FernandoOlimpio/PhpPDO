<?php

include_once './model/Pessoa.php';
include_once './bd/Conecta.php';
include_once './model/Mensagem.php';
include_once './model/Endereco.php';

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
                //processo para pegar o idendereco da tabela endereco, conforme 
                //o cep e o logradouro informado.
                $st = $conecta->prepare("select idendereco from endereco where cep = ? " //quando tem parametro a passar usa-se o prepare, aundo nao tem usa-se query
                        . "and logradouro = ? and complemento = ?");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                $linhaEndereco = $st->execute();
                if ($linhaEndereco) {
                    if($st->rowCount() >0){
                    $linhaEndereco = $st->fetch(PDO::FETCH_OBJ);
                    $fkEnd = $linhaEndereco->idendereco; //o endereço existindo, é jogado o idendereço na variavel fkEnd para setar em pessoa.

                    $st1 = $conecta->prepare("INSERT INTO pessoa values(null,?,?,?,?,?,?,?,?)");
                    $st1->bindParam(1, $nome);
                    $st1->bindParam(2, $dtNasc);
                    $st1->bindParam(3, $login);
                    $st1->bindParam(4, $senha);
                    $st1->bindParam(5, $perfil);
                    $st1->bindParam(6, $email);
                    $st1->bindParam(7, $cpf);
                    $st1->bindParam(8, $fkEnd);

                    $st1->execute();
                    $msg->setMsg("<p style='color: green;'>"
                            . "Dados Cadastrados com sucesso</p>");
                }
                }else {
                    $st2 = $conecta->prepare("INSERT INTO endereco values(null,?,?,?,?,?,?)");
                    $st2->bindParam(1, $cep);
                    $st2->bindParam(2, $logradouro);
                    $st2->bindParam(3, $complemento);
                    $st2->bindParam(4, $bairro);
                    $st2->bindParam(5, $cidade);
                    $st2->bindParam(6, $uf);

                    $st2->execute();

                    $st3 = $conecta->prepare("SELECT idendereco from endereco where cep = ? "
                            . "and logradouro=? and complemento = ?");
                    $st3->bindParam(1, $cep);
                    $st3->bindParam(2, $logradouro);
                    $st3->bindParam(3, $complemento);
                    $linhaEndereco = $st3->execute();
                    if($st3->execute()){
                            if($st3->rowCount() > 0){
                                $linhaEndereco = $st3->fetch(PDO::FETCH_OBJ);
                    $fkEnd = $linhaEndereco->idendereco;
                            }
                    }

                    $st4 = $conecta->prepare("INSERT INTO pessoa values(null,?,?,?,?,?,?,?,?)");
                    $st4->bindParam(1, $nome);
                    $st4->bindParam(2, $dtNasc);
                    $st4->bindParam(3, $login);
                    $st4->bindParam(4, $senha);
                    $st4->bindParam(5, $perfil);
                    $st4->bindParam(6, $email);
                    $st4->bindParam(7, $cpf);
                    $st4->bindParam(8, $fkEnd);

                    $st4->execute();
                    $msg->setMsg("<p style='color: green;'>"
                            . "Dados Cadastrados com sucesso</p>");
                }
            } catch (Exception $ex) {
                $msg->setMsg(ex);
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                    . "Erro na conexão com o banco de dados.</p>");
        }

        $conn = null;
        return $msg;
    }

    public function atualizarPessoaDAO(Pessoa $pessoa) {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {

            $idPessoa = $pessoa->getIdPessoa();
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
                        . "and logradouro = ? and complemento = ?");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                $linhaEndereco = $st->execute();
                $fkEnd = "";
                if ($linhaEndereco) {
                    if($st->rowCount() > 0){
                                
                    $linhaEndereco = $st->fetch(PDO::FETCH_OBJ);
                    $fkEnd = $linhaEndereco->idendereco;

                    $st1 = $conecta->prepare("update pessoa set"
                            . "nome = ?,"
                            . "dtNasc = ?,"
                            . "login = ?,"
                            . "senha = ?,"
                            . "perfil = ?,"
                            . "email = ?,"
                            . "cpf = ?,"
                            . "fkendereco = ?"
                            . "where idpessoa = ?");

                    $st1->bindParam(1, $nome);
                    $st1->bindParam(2, $dtNasc);
                    $st1->bindParam(3, $login);
                    $st1->bindParam(4, $senha);
                    $st1->bindParam(5, $perfil);
                    $st1->bindParam(6, $email);
                    $st1->bindParam(7, $cpf);
                    $st1->bindParam(8, $fkEnd);
                    $st1->bindParam(9, $idPessoa);

                    $st1->execute();
                    $msg->setMsg("<p style='color: blue;'>"
                            . "Dados atualizados com sucesso</p>");
                }
                }else {

                    $st2 = $conecta->prepare("INSERT INTO endereco values(null,?,?,?,?,?,?)");
                    $st2->bindParam(1, $cep);
                    $st2->bindParam(2, $logradouro);
                    $st2->bindParam(3, $complemento);
                    $st2->bindParam(4, $bairro);
                    $st2->bindParam(5, $cidade);
                    $st2->bindParam(6, $uf);

                    $st2->execute();

                    $st2 = $conecta->prepare("SELECT idendereco from endereco where cep = ? "
                            . "and logradouro=? and complemento = ?");
                    $st2->bindParam(1, $cep);
                    $st2->bindParam(2, $logradouro);
                    $st2->bindParam(3, $complemento);
                    $linhaEndereco = $st2->execute();
                    if ($linhaEndereco) {
                    if($st2->rowCount() > 0){
                                
                    $linhaEndereco = $st2->fetch(PDO::FETCH_OBJ);
                    $fkEnd = $linhaEndereco->idendereco;

                    $st3 = $conecta->prepare("UPDATE pessoa set"
                            . "nome = ?,"
                            . "dtNasc = ?,"
                            . "login = ?,"
                            . "senha = ?,"
                            . "perfil = ?,"
                            . "email = ?,"
                            . "cpf = ?,"
                            . "fkendereco = ?"
                            . "where idpessoa = ?");

                    $st3->bindParam(1, $nome);
                    $st3->bindParam(2, $dtNasc);
                    $st3->bindParam(3, $login);
                    $st3->bindParam(4, $senha);
                    $st3->bindParam(5, $perfil);
                    $st3->bindParam(6, $email);
                    $st3->bindParam(7, $cpf);
                    $st3->bindParam(8, $fkEnd);
                    $st3->bindParam(9, $idPessoa);

                    $st3->execute();
                    $msg->setMsg("<p style='color: blue;'>"
                            . "Dados atualizados com sucesso</p>");
                }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        } else {
            $msg->setMsg("<p style='color: red;'>"
                    . "Erro na conexão com o banco de dados.</p>");
        }

        $conn = null;
        return $msg;
    }

    public function listarPessoasDAO() {
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $rs = $conecta->query("SELECT *from pessoa INNER JOIN endereco"
                        . "on pessoa.fkendereco = endereco.idendereco");

                $lista = array();

                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            
                            $pessoa = new Pessoa();
                            $pessoa->setIdPessoa($linha->idpessoa);
                            $pessoa->setNome($linha->nome);
                            $pessoa->setDtNasc($linha->dtNasc);
                            $pessoa->setLogin($linha->login);
                            $pessoa->setSenha($linha->senha);
                            $pessoa->setPerfil($linha->perfil);
                            $pessoa->setEmail($linha->email);
                            $pessoa->setCpf($linha->cpf);
                            
                            $endereco = new Endereco();
                            $endereco->setCep($linha->cep);
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);
                            
                            $pessoa->setEndereco($endereco);
                            $lista[$a] = $pessoa;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
            return $lista;
        }
    }
    
    

}
