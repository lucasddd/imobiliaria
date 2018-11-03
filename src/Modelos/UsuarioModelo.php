<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Usuario;
use PPI2\Entidades\TipoUsuario;
use PDO;

class UsuarioModelo {

    $table = 'usuarios';

    function __construct() {

    }

    function listar() {

        try {
            $sql = 'select * from '.$table.' order by nome';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function cadastrar(Usuario $usuario) {

        try {
            $sql = 'insert into '.$table.' (nome) values(:nome)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $usuario->getNome());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function permissao($usuario_id) {

        try {
            $sql = 'select * from '.$table.' where id = :id order by nome';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $usuario_id);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function login($login, $senha) {

        try {
            $sql = 'select * from '.$table.' where email = :email and senha = :senha limit 1';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':email', $login);
            $p_sql->bindValue(':senha', $senha);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
