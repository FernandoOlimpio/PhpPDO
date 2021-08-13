<?php
include_once './bd/Conecta.php';
include_once './model/Pessoa.php';
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
                        . "and logradouro = ? and complemento = ? limit 1");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                //$linhaEndereco = $st->execute();
                if ($st->execute()) {
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
                            . "and logradouro=? and complemento = ? limit 1");
                    $st3->bindParam(1, $cep);
                    $st3->bindParam(2, $logradouro);
                    $st3->bindParam(3, $complemento);
                    //$linhaEndereco = $st3->execute();
                    if($st3->execute()){
                            if($st3->rowCount() > 0){
                               while ($linhaEndereco = $st3->fetch(PDO::FETCH_OBJ)){
                    $fkEnd = $linhaEndereco->idendereco;
                               }
                            }
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
                    
                
                }
                
               $msg->setMsg("<p style='color: green;'>"
                            . "Dados Cadastrados com sucesso</p>"); 
                    
                
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
                $st = $conecta->prepare("SELECT idendereco FROM endereco where cep = ? " //quando tem parametro a passar usa-se o prepare, aundo nao tem usa-se query
                        . "and logradouro = ? and complemento = ? limit 1");

                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                
                $fkEnd = "";
                if ($st->execute()) {
                    if($st->rowCount() > 0){
                              
                   while($linhaEndereco = $st->fetch(PDO::FETCH_OBJ)){
                    $fkEnd = $linhaEndereco->idendereco;
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
                            . "and logradouro=? and complemento = ? limit 1");
                    $st3->bindParam(1, $cep);
                    $st3->bindParam(2, $logradouro);
                    $st3->bindParam(3, $complemento);
                    
                    if ($st3->execute()) {
                    if($st3->rowCount() > 0){
                                
                   $linhaEndereco = $st3->fetch(PDO::FETCH_OBJ);
                    $fkEnd = $linhaEndereco->idendereco;
                    }
                    
                    }
                   
                }
                }
                 
                
                $st4 = $conecta->prepare("UPDATE pessoa set "
                            ."nome = ?,"
                            . "dtNasc = ?,"
                            . "login = ?,"
                            . "senha = ?,"
                            . "perfil = ?,"
                            . "email = ?,"
                            . "cpf = ?,"
                            . "fkendereco = ?"
                            . "where idpessoa = ?");

                    $st4->bindParam(1, $nome);
                    $st4->bindParam(2, $dtNasc);
                    $st4->bindParam(3, $login);
                    $st4->bindParam(4, $senha);
                    $st4->bindParam(5, $perfil);
                    $st4->bindParam(6, $email);
                    $st4->bindParam(7, $cpf);
                    $st4->bindParam(8, $fkEnd);
                    $st4->bindParam(9, $idPessoa);
                    $st4->execute();
                   // $msg->setMsg("<p style='color: blue;'>"
                           // . "Dados atualizados com sucesso</p>");    
                $msg->setMsg($fkEnd);
            } catch (PDOException $ex) {
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
                $rs = $conecta->prepare("SELECT * FROM pessoa INNER JOIN endereco"
                        . " on pessoa.fkendereco = endereco.idendereco");
                $lista= array();
                
                $a = 0; 
                if($rs->execute()){
                    if($rs->rowCount() > 0){
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
            
             //$conn = null;
             return $lista;
             
        }
       
    }
    
    
    //método para excluir pessoa na tabela pessoa
    public function excluirPessoaDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if ($conecta) {
            try {
                $st = $conecta->prepare("delete from pessoa "
                    . "where idpessoa = ?");
                $st->bindParam(1, $id);
                $st->execute();
                
                $msg->setMsg("<p style='color: #d6bc71;'>"
                    . "Dados excluídos com sucesso.</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        } else {
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>");
        }
        $conn = null;
        return $msg;
    }

    //método para os dados de produto por id
    public function pesquisarPessoaIdDAO($id)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $pessoa = new Pessoa();
        if ($conecta) {
            try {
                $rs = $conecta->prepare("select * from pessoa inner join endereco "
                    . " on pessoa.fkendereco = endereco.idendereco where "
                    . "idpessoa = ? limit 1");
                $rs->bindParam(1, $id);
                if ($rs->execute()) {
                    if ($rs->rowCount() > 0) {
                        while ($linha = $rs->fetch(PDO::FETCH_OBJ)) {

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
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
            $conn = null;
        } else {
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PHPMatutino01/cadastroPessoa.php'\">";
        }
        return $pessoa;
    }
    
   /* public function procurarSenhaDAO($login, $senha)
    {
        
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $check = null;
        echo $senha;
        if ($conecta) {
            try {
                $st = $conecta->prepare("SELECT idpessoa FROM pessoa where " 
                        . "login = ? and senha = ? ");
                $st->bindParam(1, $login);
                $st->bindParam(2, $senha);
                if ($st->execute()) {

                    if ($st->rowCount() > 0) {
                        echo $st->rowCount();
                        $check =  true;
                    } else {
                        $check =  false;
                    }
                }
            } catch (Exception $ex) {
                echo $ex;
            }
            return $check;
            $conn = null;
        } else {


            echo "Sem conexão com o banco";
        }
    }
    */

}
