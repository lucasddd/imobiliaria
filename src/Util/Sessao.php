<?php

namespace PPI2\Util;

/**
 * Description of Sessao
 *
 * @author iftm
 */
class Sessao {
    function __construct() {
        
    }

    function start(){
        return session_start();
    }
    
    function add($chave, $valor){
        $_SESSION['ppi2'][$chave] = $valor;
    }
    
    function get($chave){
        if(isset($_SESSION['ppi2'][$chave]))
            return $_SESSION['ppi2'][$chave];
        return '';
    }
    
    function rem($chave){
        if(isset($_SESSION['ppi2'][$chave]))
            session_unset($_SESSION['ppi2'][$chave]);
    }
    
    function del(){
        if(isset($_SESSION['ppi2']))
            session_unset($_SESSION['ppi2']);
        session_destroy();
        
    }
    
    function existe($chave){
        if(isset($_SESSION['ppi2'][$chave]))
            return true;
        return false;
        
    }
}
