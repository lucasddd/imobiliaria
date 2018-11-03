<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Permissao;
use PDO;

class PermissaoModelo {

    $table = 'permissoes';

    function __construct() {
        
    }

    function listar() {

        try {
            $sql = 'select * from '.$table.' order by permissao';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function cadastrar(Permissao $permissao) {

        try {
            $sql = 'insert into '.$table.' (permissao) values(:permissao)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':permissao', $tipoUsuario->getPermissao());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
