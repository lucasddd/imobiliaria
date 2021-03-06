<?php

namespace PPI2\Entidades;

use PPI2\Entidades\Cliente;
use PPI2\Entidades\TipoImovel;
use PPI2\Modelos\TipoImovelModelo;
use PPI2\Modelos\LocacaoModelo;

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
    private $locador;
    private $valorVenda;
    private $valorLocacao;
    private $qtQuartos;
    private $qtSuites;
    private $qtBanheiros;
    private $areaConstruida;
    private $obs;
    
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
    function setBairro($bairro){
        $this->bairro = $bairro;
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
        return $this->tipoImovel;
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
    function setLocador(Cliente $locador){
        $this->locador = $locador;
    }
    function getLocador(){
        return $this->locador;
    }
    function setValorVenda($valorVenda){
        $this->valorVenda = $valorVenda;
    }
    function getValorVenda(){
        return $this->valorVenda;
    }
    function setValorLocacao($valorLocacao){
        $this->valorLocacao = $valorLocacao;
    }
    function getValorLocacao(){
        return $this->valorLocacao;
    }
    function getQtQuartos(){
        return $this->qtQuartos;
    }
    function setQtQuartos($qtQuartos){
        $this->qtQuartos = $qtQuartos;
    }
    function getQtSuites(){
        return $this->qtSuites;
    }
    function setQtSuites($qtSuites){
        $this->qtSuites = $qtSuites;
    }
    function getQtBanheiros(){
        return $this->qtBanheiros;
    }
    function setQtBanheiros($qtBanheiros){
        $this->qtBanheiros = $qtBanheiros;
    }
    function getAreaConstruida(){
        return $this->areaConstruida;
    }
    function setAreaConstruida($areaConstruida){
        $this->areaConstruida = $areaConstruida;
    }
    function getObs(){
        return $this->obs;
    }
    function setObs($obs){
        $this->obs = $obs;
    }

    public function imovelPossuiLocacoes(){
        $locacaoModelo = new LocacaoModelo();
        return $locacaoModelo->getTodasLocacaoParaImovel($this->id);
    }
}
