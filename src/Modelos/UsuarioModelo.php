<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Usuario;
use PPI2\Entidades\TipoUsuario;
use PDO;

class UsuarioModelo {


    function listar() {

        try {
            $sql = 'select * from usuarios order by nome';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function cadastrar(Usuario $usuario) {

        try {
            $sql = 'insert into usuarios (nome) values(:nome)';
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
            $sql = 'select * from usuarios where id = :id order by nome';
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
            $sql = 'select id,nome,email,cpf,status,permissao_id from usuarios where email = lower(:email) and senha = md5(:senha) limit 1';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':email', $login);
            $p_sql->bindValue(':senha', $senha);
            $p_sql->execute();
            $usuario = $p_sql->fetchAll(PDO::FETCH_OBJ);
            if(isset($usuario[0])){
                return $usuario[0];
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
