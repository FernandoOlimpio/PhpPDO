<?php

require_once './bd/Conecta.php';
require_once './model/Mensagem.php';

class DaoLogin {

    public function validarLogin($login, $senha) {
        $conn = new Conecta();
        $pessoa = new Pessoa();
        $msg = new Mensagem();
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
            } catch (Exception $ex) {
                
                return "".$ex;
            }
        } else {
            
            return "<p style='color: red;'>'Banco inoperante!'</p>";
        }
    }

}
