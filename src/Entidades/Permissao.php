<?php

namespace PPI2\Entidades;

class Permissao {
    
    private $id;
    private $permissao;
    
    function __construct($permissao) {
        $this->permissao = $permissao;
    }
    
    function getId() {
        return $this->id;
    }

    function getPermissao() {
        return $this->permissao;
    }

    function setPermissao($permissao) {
        return $this->permissao = $permissao;
    }
}
