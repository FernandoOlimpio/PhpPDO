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
                //processo para pegar o idendereco da tabela endereco, conforme 
                //o cep e o logradouro informado.
                $st = $conecta->prepare("select idendereco from endereco where cep = ? " //quando tem parametro a passar usa-se o prepare, aundo nao tem usa-se query
                        . "and logradouro = ? and complemento = ?");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
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
                            . "and logradouro=? and complemento = ?");
                    $st->bindParam(1, $cep);
                    $st->bindParam(2, $logradouro);
                    $st->bindParam(3, $complemento);
                    $linhaEndereco = $st->execute();
                    $fkEnd = $linhaEndereco->idendereco;

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
                if ($linhaEndereco) {
                    $fkEnd = $linhaEndereco->idendereco;

                    $st = $conecta->prepare("update pessoa set"
                            . "nomepessoa = ?,"
                            . "dtNasc = ?,"
                            . "login = ?,"
                            . "senha = ?,"
                            . "perfil = ?,"
                            . "email = ?,"
                            . "cpf = ?,"
                            . "fkendereco = ?"
                            . "where idpessoa = ?");

                    $st->bindParam(1, $nome);
                    $st->bindParam(2, $dtNasc);
                    $st->bindParam(3, $login);
                    $st->bindParam(4, $senha);
                    $st->bindParam(5, $perfil);
                    $st->bindParam(6, $email);
                    $st->bindParam(7, $cpf);
                    $st->bindParam(8, $fkEnd);
                    $st->bindParam(9, $idPessoa);

                    $st->execute();
                    $msg->setMsg("<p style='color: blue;'>"
                            . "Dados atualizados com sucesso</p>");
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
                            . "and logradouro=? and complemento = ?");
                    $st->bindParam(1, $cep);
                    $st->bindParam(2, $logradouro);
                    $st->bindParam(3, $complemento);
                    $linhaEndereco = $st->execute();
                    $fkEnd = $linhaEndereco->idendereco;

                    $st = $conecta->prepare("UPDATE pessoa set"
                            . "nomepessoa = ?,"
                            . "dtNasc = ?,"
                            . "login = ?,"
                            . "senha = ?,"
                            . "perfil = ?,"
                            . "email = ?,"
                            . "cpf = ?,"
                            . "fkendereco = ?"
                            . "where idpessoa = ?");

                    $st->bindParam(1, $nome);
                    $st->bindParam(2, $dtNasc);
                    $st->bindParam(3, $login);
                    $st->bindParam(4, $senha);
                    $st->bindParam(5, $perfil);
                    $st->bindParam(6, $email);
                    $st->bindParam(7, $cpf);
                    $st->bindParam(8, $fkEnd);
                    $st->bindParam(9, $idPessoa);

                    $st->execute();
                    $msg->setMsg("<p style='color: blue;'>"
                            . "Dados atualizados com sucesso</p>");
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
                        . "on pessoa.idpessoa = endereco.idendereco");

                $lista = array();

                $a = 0;
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {
                            $endereco = new Endereco();
                            $endereco->setCep($linha->cep);
                            $endereco->setLogradouro($linha->logradouro);
                            $endereco->setComplemento($linha->complemento);
                            $endereco->setBairro($linha->bairro);
                            $endereco->setCidade($linha->cidade);
                            $endereco->setUf($linha->uf);

                            $pessoa = new Pessoa();
                            $pessoa->setIdPessoa($linha->idpessoa);
                            $pessoa->setNome($linha->nome);
                            $pessoa->setDtNasc($linha->dtNasc);
                            $pessoa->setLogin($linha->login);
                            $pessoa->setSenha($linha->senha);
                            $pessoa->setPerfil($linha->perfil);
                            $pessoa->setEmail($linha->email);
                            $pessoa->setCpf($linha->cpf);
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
