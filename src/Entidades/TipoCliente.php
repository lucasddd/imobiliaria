<?php

namespace PPI2\Entidades;

class TipoCliente {
    
    private $id;
    private $descricao;
    
    /*
    function __construct($nome,$email,$senha,$cpf,$status,$permissao) {
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->status = $status;
        $this->permissao = $permissao;
    }
    */
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }
    function setId($id){
        $this->id = $id;
    }
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}
