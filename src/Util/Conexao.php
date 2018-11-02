<?php
namespace PPI2\Util;
use PDO;
class Conexao {
    
    private static $instancia;
    
    private function __construct() {
        
    }
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            self::$instancia = new PDO("mysql:host=localhost;dbname=projeto", 'root', 'mensch8a');
            self::$instancia->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instancia->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instancia;
    }
    
    public function close(){
        if(isset(self::$instancia)){
            self::$instancia = null;
        }
    }
}
