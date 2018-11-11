<?php

namespace PPI2\Entidades;

class Cliente {
    
    private $id;
    private $nome;
    private $cpf;
    private $datanascimento;
    private $endereco;
    private $bairro;
    private $cidade;
    private $cep;
    private $telefone;
    private $rg;
    private $status;
    private $criadoEm;
    
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

    function setId($id){
        $this->id = $id;
    }
    
    function getNome(){
        return $this->nome;
    }
    function setNome($nome){
        $this->nome = $nome;
    }
    function getCpf(){
        return $this->cpf;
    }
    function setCpf($cpf){
        $this->cpf = $cpf;
    }
    function getDataNascimento(){
        return $this->datanascimento;
    }
    function setDataNascimento($datanascimento){
        $this->datanascimento = $datanascimento;
    }
    function getEndereco(){
        return $this->endereco;
    }
    function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    function getBairro(){
        return $this->bairro;
    }
    function setBairro($bairro){
        $this->bairro = $bairro;
    }
    function getCidade(){
        return $this->cidade;
    }
    function setCidade($cidade){
        $this->cidade = $cidade;
    }
    function getCep(){
        return $this->cep;
    }
    function setCep($cep){
        $this->cep = $cep;
    }
    function getTelefone(){
        return $this->telefone;
    }
    function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    function getRg(){
        return $this->rg;
    }
    function setRg($rg){
        $this->rg = $rg;
    }
    function getStatus(){
        return $this->status;
    }
    function setStatus($status){
        $this->status = $status;
    }
    function getCriadoEm(){
        return $this->criadoEm;
    }
    function setCriadoEm($criadoEm){
        $this->criadoEm = $criadoEm;
    }
}
