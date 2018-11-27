<?php

namespace PPI2\Entidades;

use PPI2\Modelos\ImovelModelo;

class TipoImovel {
    
    private $id;
    private $descricao;
    
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
    
    function getImoveis(){
        $imovelModelo = new ImovelModelo();
        return $imovelModelo->getImoveisPeloTipo($this->id);
    }
}
