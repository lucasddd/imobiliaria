<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Produto;
use PDO;

class ModeloProdutos {

    function __construct() {
        
    }

    function listarProdutos() {

        try {
            $sql = 'select * from produtos';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function cadastrar(Produto $produto) {

        try {
            $sql = 'insert into produtos (descricao, preco) values(:descricao, :preco)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $produto->getDescricao());
            $p_sql->bindValue(':preco', $produto->getPreco());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
