<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\TipoCliente;
use PDO;

class TipoClienteModelo {


    function listar() {

        try {
            $sql = 'select * from tipo_cliente order by descricao';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function busca($palavra) {

        try {
            $sql = "select * from tipo_cliente where descricao LIKE :busca order by descricao";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':busca', "%".$palavra."%");
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function salvar(TipoCliente $tipoCliente) {

        try {
            $sql = 'insert into tipo_cliente (descricao) values(upper(:descricao))';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $tipoCliente->getDescricao());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function atualizar(TipoCliente $tipoCliente) {

        try {
            $sql = 'update tipo_cliente set descricao = upper(:descricao) where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $tipoCliente->getDescricao());
            $p_sql->bindValue(':id', $tipoCliente->getId());
            if ($p_sql->execute())
                return $tipoCliente->getId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function consultaDescricao($desc) {
        try {
            $sql = 'select * from tipo_cliente where upper(descricao) = upper(:desc)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':desc',$desc);
            $p_sql->execute();
            if ($p_sql->rowCount() > 0) {
                return $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function getTipoCliente($id) {
        try {
            $sql = 'select * from tipo_cliente where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id',$id);
            $p_sql->execute();
            if ($p_sql->rowCount() > 0) {
                return $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function consultaDescricaoComExcessaoId($desc,$id) {
        try {
            $sql = 'select * from tipo_cliente where descricao = upper(:desc) and id != :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':desc',$desc);
            $p_sql->bindValue(':id',$id);
            $p_sql->execute();
            if ($p_sql->rowCount() > 0) {
                return $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
