<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Imovel;
use PPI2\Entidades\TipoImovel;
use PPI2\Entidades\Cliente;
use PDO;

class ImovelModelo {


    function listar() {

        try {
            $sql = 'select * from imoveis order by id desc';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function busca($palavra) {

        try {
            $sql = "select * from imoveis where id LIKE :id or 
            endereco LIKE :busca or bairro LIKE :busca order by id desc";
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':busca', "%".$palavra."%");
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function salvar(Cliente $cliente) {

        try {
            $sql = 'insert into imoveis (nome,cpf,rg,datanascimento,endereco,
                bairro,cidade,cep,telefone,status) values(upper(:nome),
                :cpf,:rg,:datanascimento,upper(:endereco),upper(:bairro),
                upper(:cidade),:cep,:telefone,1)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $cliente->getNome());
            $p_sql->bindValue(':cpf', $cliente->getCpf());
            $p_sql->bindValue(':rg', $cliente->getRg());
            $p_sql->bindValue(':datanascimento', $cliente->getDataNascimento());
            $p_sql->bindValue(':endereco', $cliente->getEndereco());
            $p_sql->bindValue(':bairro', $cliente->getBairro());
            $p_sql->bindValue(':cidade', $cliente->getCidade());
            $p_sql->bindValue(':cep', $cliente->getCep());
            $p_sql->bindValue(':telefone', $cliente->getTelefone());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function atualizar(Cliente $cliente) {

        try {
            $sql = 'update imoveis set nome = upper(:nome),cpf = :cpf,rg = :rg,
                datanascimento = :datanascimento,endereco = upper(:endereco),
                bairro = upper(:bairro),cidade = upper(:cidade),cep = :cep,
                telefone = :telefone where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $cliente->getId());
            $p_sql->bindValue(':nome', $cliente->getNome());
            $p_sql->bindValue(':cpf', $cliente->getCpf());
            $p_sql->bindValue(':rg', $cliente->getRg());
            $p_sql->bindValue(':datanascimento', $cliente->getDataNascimento());
            $p_sql->bindValue(':endereco', $cliente->getEndereco());
            $p_sql->bindValue(':bairro', $cliente->getBairro());
            $p_sql->bindValue(':cidade', $cliente->getCidade());
            $p_sql->bindValue(':cep', $cliente->getCep());
            $p_sql->bindValue(':telefone', $cliente->getTelefone());
            if ($p_sql->execute())
                return $cliente;
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function consultaCpf($cpf) {
        try {
            $sql = 'select * from imoveis where cpf = :cpf';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf',$cpf);
            $p_sql->execute();
            if ($p_sql->rowCount() > 0) {
                return $p_sql->fetch(PDO::FETCH_ASSOC);
            }
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function getImovel($id) {
        try {
            $sql = 'select * from imoveis where id = :id';
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
    function getImoveisPeloTipo($id) {
        try {
            $sql = 'select * from imoveis where proprietario_id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id',$id);
            $p_sql->execute();
            $imoveis = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listImoveis = array();
            foreach ($imoveis as $key => $imovel_) {
                $imovel = new Imovel();
                $imovel->setId($imovel_->id);
                $imovel->setEndereco($imovel_->endereco);
                $listImoveis[$key] = $imovel;
            }
            return $listImoveis;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function consultaCpfComExcessaoId($cpf,$id) {
        try {
            $sql = 'select * from imoveis where cpf = :cpf and id != :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':cpf',$cpf);
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
