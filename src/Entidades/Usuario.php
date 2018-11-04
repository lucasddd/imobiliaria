<?php

namespace PPI2\Entidades;

class Usuario {
    
    private $id;
    private $nome;
    private $senha;
    private $email;
    private $cpf;
    private $status;
    private $permissao;
    
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

    function getNome() {
        return $this->nome;
    }
    function getEmail() {
        return $this->email;
    }
    function getCpf() {
        return $this->cpf;
    }
    function getStatus() {
        return $this->status;
    }
    function getPermissao() {
        return $this->permissao;
    }
    function getSenha() {
        return $this->senha;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setNome($nome) {
        return $this->nome = $nome;
    }
    function setEmail($email) {
        return $this->email = $email;
    }
    function setCpf($cpf) {
        return $this->cpf = $cpf;
    }
    function setStatus($status) {
        return $this->status = $status;
    }
    function setPermissao($permissao) {
        return $this->permissao = $permissao;
    }
    function setSenha($senha) {
        return $this->senha = $senha;
    }
}
