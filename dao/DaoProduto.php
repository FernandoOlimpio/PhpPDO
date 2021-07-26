<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/bd/Conecta.php';
include_once 'c:/xampp/htdocs/PhpMatutinoPDO/model/Produto.php';

class DaoProduto {

    public function inserir(Produto $produto) {
        $conn = new Conecta();
        if ($conn->conectadb()) {
            $nomeProduto = $produto->getNomeProduto();
            $vlrCompra = $produto->getVlrCompra();
            $vlrVenda = $produto->getVlrVenda();
            $qtdEstoque = $produto->getQtdEstoque();
            $stmt = $conn->prepare("insert into produto values (null,?, ?,"
                    . "?, ?)");
            
            $stmt-> bindParam(1,$nomeProduto);
            $stmt-> bindParam(1,$vlrCompra);
            $stmt-> bindParam(1,$vlrVenda);
            $stmt-> bindParam(1,$qtdEstoque);
            $stmt->execute();
             $msg = "<p style= 'color:green;'>"
                        . "Dados cadastrados com sucesso.</p>";
             
             
            if (mysqli_query($conn->conectadb(), $sql)) {
               
            } else {
                $msg = "<p style= 'color:red;'>"
                        . "Erro na inserção dos dados.</p>";
            }
        } else {
            $msg = "<p style= 'color:red;'>"
                    . "Erro na conexão com o banco de dados.</p>";
        }
        mysqli_close($conn->conectadb());
        return $msg;
    }

    //Método para carregar lista de produtos do banco de dados
    public function listarProdutosDao(){
        $conn = new Conecta();
        if ($conn->conectadb()) {
            $sql = "select * from produto";
            $query = mysqli_query($conn->conectadb(), $sql);
            $result = mysqli_fetch_array($query);
            $lista = array();
            $a = 0;
            if ($result) {


                do{
                    $produto = new Produto();
                    $produto->setIdProduto($result['id']);
                    $produto->setNomeProduto($result['nome']);
                    $produto->setVlrCompra($result['vlrCompra']);
                    $produto->setVlrVenda($result['vlrVenda']);
                    $produto->setQtdEstoque($result['qtdEstoque']);
                    $lista[$a] = $produto;
                    $a++;
                } while ($result = mysqli_fetch_array($query));
                mysqli_close($conn->conectadb());
                return $lista;
            }
        }
    }

}
