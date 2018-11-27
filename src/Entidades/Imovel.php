<?php

namespace PPI2\Entidades;

use PPI2\Entidades\Cliente;
use PPI2\Entidades\TipoImovel;

class Imovel {
    
    private $id;
    private $endereco;
    private $bairro;
    private $tipoImovel;
    private $foto1;
    private $foto2;
    private $foto3;
    private $situacao;
    private $criadoEm;
    private $locatario;
    
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
    function getEndereco(){
        return $this->endereco;
    }
    function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    function getBairro(){
        return $this->bairro;
    }
    function getSituacao(){
        return $this->situacao;
    }
    function setSituacao($situacao){
        $this->status = $situacao;
    }
    function getFoto1(){
        return $this->foto1;
    }
    function setFoto1($foto){
        $this->foto1 = $foto;
    }
    function getFoto2(){
        return $this->foto2;
    }
    function setFoto2($foto){
        $this->foto2 = $foto;
    }
    function getFoto3(){
        return $this->foto3;
    }
    function setFoto3($foto){
        $this->foto3 = $foto;
    }
    function getCriadoEm(){
        return $this->criadoEm;
    }
    function setCriadoEm($criadoEm){
        $this->criadoEm = $criadoEm;
    }
    function getTipoImovel(){
        $return $this->tipoImovel;
    }
    function setTipoImovel(TipoImovel $tipoImovel){
        $this->tipoImovel = $tipoImovel;
    }
    function getLocatario(){
        return $this->locatario;
    }
    function setLocatario(Cliente $locatario){
        $this->locatario = $locatario;
    }
}