<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\TipoImovel;
use PDO;

class TipoImovelModelo {


    function listar() {

        try {
            $sql = 'select * from tipo_imovel order by descricao';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            $tipoImoveis = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listTipoImoveis = array();
            foreach ($tipoImoveis as $key => $tipoImovel) {
                $tipoIm = new TipoImovel();
                $tipoIm->setId($tipoImovel->id);
                $tipoIm->setDescricao($tipoImovel->descricao);
                $listTipoImoveis[$key] = $tipoIm;
            }
            return $listTipoImoveis;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function busca($palavra) {

        try {
            $sql = "select * from tipo_imovel where descricao LIKE :busca order by descricao";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':busca', "%".$palavra."%");
            $p_sql->execute();
            $tipoImoveis = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listImoveis = array();
            foreach ($tipoImoveis as $key => $tipoImovel) {
                $tipoIm = new TipoImovel();
                $tipoIm->setId($tipoImovel->id);
                $tipoIm->setDescricao($tipoImovel->descricao);
                $listImoveis[$key] = $tipoIm;
            }
            return $listImoveis;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function salvar(TipoImovel $tipoImovel) {

        try {
            $sql = 'insert into tipo_imovel (descricao) values(upper(:descricao))';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $tipoImovel->getDescricao());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function atualizar(TipoImovel $tipoImovel) {

        try {
            $sql = 'update tipo_imovel set descricao = upper(:descricao) where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $tipoImovel->getDescricao());
            $p_sql->bindValue(':id', $tipoImovel->getId());
            if ($p_sql->execute())
                return $tipoImovel->getId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function consultaDescricao($desc) {
        try {
            $sql = 'select * from tipo_imovel where upper(descricao) = upper(:desc)';
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
    function getTipoImovel($id) {
        try {
            $sql = 'select * from tipo_imovel where id = :id';
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
    function getTipoImovelPeloId($id) {
        try {
            $sql = 'select * from tipo_imovel where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id',$id);
            $p_sql->execute();
            $p_sql->execute();
            $tipoImovel = null;
            if ($p_sql->rowCount() > 0) {
                $tipo = $p_sql->fetchAll(PDO::FETCH_OBJ)[0];
                $tipoImovel = new TipoImovel();
                $tipoImovel->setId($tipo->id);
                $tipoImovel->setDescricao($tipo->descricao);
            }
            return $tipoImovel;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function consultaDescricaoComExcessaoId($desc,$id) {
        try {
            $sql = 'select * from tipo_imovel where descricao = upper(:desc) and id != :id';
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
