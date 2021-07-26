<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'c:/xampp/htdocs/PhpMatutinoPDO/bd/ConectaLivro.php';
include_once 'c:/xampp/htdocs/PhpMatutinoPDO/model/Livro.php';

class DaoLivro {

    public function inserir(Livro $livro) {

        $conn = new ConectaLivro();
        if ($conn->conectadb()) {
            $titulo = $livro->getTitulo();
            $autor = $livro->getAutor();
            $editora = $livro->getEditora();
            $qtdEstoque = $livro->getQtdEstoque();

            $sql = "insert into livro values(null, '$titulo', '$autor', '$editora',
                    '$qtdEstoque')";

            if (mysqli_query($conn->conectadb(), $sql)) {
                $msg = "<p style='color:green;'>Dados gravados com sucesso.</p>";
            } else {
                $msg = "<p style='color:red;'>Erro ao gravar.</p>";
            }
        } else {
            $msg = "<p style='color: red;'> Erro de DB.</p>";
        }
        mysqli_close($conn->conectadb());
        return $msg;
    }
    
    //método para atualizar dados da tabela livro
    public function atualizar(Livro $livro) {

        $conn = new ConectaLivro();
        if ($conn->conectadb()) {
            $idLivro = $livro->getIdLivro();
            $titulo = $livro->getTitulo();
            $autor = $livro->getAutor();
            $editora = $livro->getEditora();
            $qtdEstoque = $livro->getQtdEstoque();

            $sql = "update livro set titulo = '$titulo', autor ='$autor', "
                    . "editora = '$editora','qtdestoque = $qtdEstoque')";

            if (mysqli_query($conn->conectadb(), $sql)) {
                $msg = "<p style='color:green;'>Dados gravados com sucesso.</p>";
            } else {
                $msg = "<p style='color:red;'>Erro ao gravar.</p>";
            }
        } else {
            $msg = "<p style='color: red;'> Erro de DB.</p>";
        }
        mysqli_close($conn->conectadb());
        return $msg;
    }

    public function listar() {
        $conn = new ConectaLivro();
        if ($conn->conectadb()) {
            $sql = "select * from livro";
            $result = mysqli_query($conn->conectadb(), $sql);
            $row = mysqli_fetch_array($result);    //array
            $lista = array();
            $a = 0;
            
            if ($row) {
                do {
                    $livro = new Livro();
                    $livro->setIdLivro($row['idlivro']);
                    $livro->setTitulo($row['titulo']);
                    $livro->setAutor($row['autor']);
                    $livro->setEditora($row['editora']);
                    $livro->setQtdEstoque($row['qtdestoque']);
                    $lista[$a] = $livro;
                    $a++;
                } while ($row = mysqli_fetch_array($result));
                
            }
            mysqli_close($conn->conectadb());
                return $lista;
        }
    }

    //método para excluir produto na tela livro
    public function excluir($id) {
        $conn = new ConectaLivro();
        $conecta = $conn->conectadb();
        if ($conecta) {
            $sql = "delete from livro where idlivro ='$id'";
            mysqli_query($conecta, $sql);
            header("Location: ../CadastroLivro.php");
            mysqli_close($conecta);
            exit;
        } else {
            echo "<script> alert('banco inoperante')</script>";
            echo "META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                URL='../PhpMatutinoPDO/cadastroLivro.php'\">";
        }
    }

    //método para pesquisar os dados de livro por id
    public function pesquisar($id) {
        $conn = new ConectaLivro();
        $conecta = $conn->conectadb();
        $livro = new Livro();
        if ($conecta) {
            $sql = "select *from livro where idlivro ='$id'";
            $result = mysqli_query($conecta, $sql);
            $linha = mysqli_fetch_assoc($result);
            
            if ($linha) {
                do {
                    $livro->setIdLivro($linha['idlivro']);
                    $livro->setTitulo($linha['titulo']);
                    $livro->setAutor($linha['autor']);
                    $livro->setEditora($linha['editora']);
                    $livro->setQtdEstoque($linha['qtdestoque']);
                } while ($linha = mysqli_fetch_assoc($result));
            }
            
            mysqli_close($conecta);
            
        } else {
            echo "<script> alert('banco inoperante')</script>";
            echo "META HTTP-EQUIV='REFRESH' CONTENT=\"0;
                URL='../PhpMatutinoPDO/cadastroLivro.php'\">";
        }
        return $livro;
    }

}
