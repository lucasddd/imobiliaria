<?php

namespace PPI2\Entidades;

class Produto {
    
    private $id;
    private $descricao;
    private $preco;
    
    function __construct($descricao, $preco) {
        $this->descricao = $descricao;
        $this->preco = $preco;
    }
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPreco() {
        return $this->preco;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }


    
}
