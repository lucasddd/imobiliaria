<?php

namespace PPI2\Entidades;

use PPI2\Entidades\Imovel;
use PPI2\Modelos\ImovelModelo;

class Locacao {

    private $id;
    private $imovel;
    private $dataLocacao;
    private $valorMensal;
    private $valorVenda;
    private $valorComissao;
    private $dataEncerramento;
    private $status;
    private $diaRepasse;
    private $diaVencimento;
    private $locador;
    
    function getId() {
        return $this->id;
    }

    function setId($id){
        $this->id = $id;
    }
    function getImovel(){
        return $this->imovel;
    }
    function setImovel(Imovel $imovel){
        $this->imovel = $imovel;
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
    function setValorMensal($valorMensal){
        $this->valorMensal = $valorMensal;
    }
    function getValorMensal(){
        return $this->valorMensal;
    }
    function getValorComissao(){
        return $this->valorComissao;
    }
    function setValorComissao($valorComissao){
        $this->valorComissao = $valorComissao;
    }
    function getDataEncerramento(){
        return $this->dataEncerramento;
    }
    function setDataEncerramento($dataEncerramento){
        $this->dataEncerramento = $dataEncerramento;
    }
    function getDataLocacao(){
        return $this->dataLocacao;
    }
    function setDataLocacao($dataLocacao){
        $this->dataLocacao = $dataLocacao;
    }
    function setStatus($status){
        $this->status = $status;
    }
    function getStatus(){
        return $this->status;
    }
    function setQtBanheiros($status){
        $this->status = $status;
    }
    function getDiaRepasse(){
        return $this->diaRepasse;
    }
    function setDiaRepasse($diaRepasse){
        $this->diaRepasse = $diaRepasse;
    }
    function getDiaVencimento(){
        return $this->diaVencimento;
    }
    function setDiaVencimento($diaVencimento){
        $this->diaVencimento = $diaVencimento;
    }
    
}
