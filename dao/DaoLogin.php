<?php

require_once '../bd/Conecta.php';
include_once '../model/Pessoa.php';


class DaoLogin {

    public function validarLoginDAO($login, $senha) {
        $conn = new Conecta();
        $pessoa = new Pessoa();
       
        $conecta = $conn->conectadb();
        if ($conecta) {
            try {
                $st = $conecta->prepare("SELECT * FROM pessoa where  "
                        . "login = ? and senha = ?  limit 1");
                $st->bindParam(1, $login);
                $st->bindParam(2, $senha);
               
                
                if ($st->execute()) {
                    if ($st->rowCount() > 0){
                    while ($linha = $st->fetch(PDO::FETCH_OBJ)) {

                        $pessoa->setIdPessoa($linha->idpessoa);
                        $pessoa->setNome($linha->nome);
                        $pessoa->setLogin($linha->login);
                        $pessoa->setPerfil($linha->perfil);
                        
                    }
                   return $pessoa;
                } else {
                    
                    return "<p style='color: red;'>'Usuário inexistente!'</p>";
                }
                }
            } catch (PDOException $ex) {
                
                return "<p style='color: red;'>'Erro no Banco de dados!'</p>".$ex;
            }
        } else {
            
            return "<p style='color: red;'>'Banco inoperante!'</p>";
        }
    }

}
