<?php

class Endereco{
    
    private $idEndereco;
    private $cep;
    private $logradouro;
    private $complento;
    private $bairro;
    private $cidade;
    private $uf;
    
    function getIdEndereco() {
        return $this->idEndereco;
    }

    function getCep() {
        return $this->cep;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getComplento() {
        return $this->complento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }

    function setIdEndereco($idEndereco) {
        $this->idEndereco = $idEndereco;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setComplento($complento) {
        $this->complento = $complento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }


}

