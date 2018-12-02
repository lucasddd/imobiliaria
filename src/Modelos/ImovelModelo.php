<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Imovel;
use PPI2\Entidades\TipoImovel;
use PPI2\Entidades\Cliente;
use PPI2\Modelos\ClienteModelo;
use PPI2\Modelos\TipoImovelModelo;
use PDO;

class ImovelModelo {


    function listar() {

        try {
            $sql = 'select * from imoveis order by id desc';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            $imoveis = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listImoveis = array();
            $clienteModelo = new ClienteModelo();
            $tipoModelo = new TipoImovelModelo();
            foreach ($imoveis as $key => $imovel_) {
                $imovel = new Imovel();
                $imovel->setId($imovel_->id);
                $imovel->setEndereco($imovel_->endereco);
                $imovel->setBairro($imovel_->bairro);
                $imovel->setValorLocacao($imovel_->valor_locacao);
                $imovel->setValorVenda($imovel_->valor_venda);
                $imovel->setFoto1($imovel_->foto1);
                $imovel->setFoto2($imovel_->foto2);
                $imovel->setFoto3($imovel_->foto3);
                $locatario = new Cliente();
                $locatario = $clienteModelo->getClientePeloId($imovel_->proprietario_id);
                $imovel->setLocatario($locatario);
                $tipo = new TipoImovel();
                $tipo = $tipoModelo->getTipoImovelPeloId($imovel_->tipo_imovel_id);
                $imovel->setTipoImovel($tipo);
                $listImoveis[$key] = $imovel;
            }
            return $listImoveis;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function busca($palavra) {

        try {
            $sql = "select i.id, i.endereco, i.bairro,
            i.tipo_imovel_id, i.foto1,i.foto2,i.foto3,i.proprietario_id, i.valor_locacao, i.valor_venda, 
            i.area_construida, i.qt_quartos,i.qt_banheiros, i.qt_suites,i.obs,
            c.nome,c.cpf,t.descricao from imoveis as i, clientes as c, tipo_imovel as t where 
            c.id = i.proprietario_id and t.id = i.tipo_imovel_id and (c.nome like :busca or 
                c.cpf like :busca or i.endereco like :busca or i.bairro like :busca or 
                i.valor_locacao like :busca or t.descricao like :busca) ORDER BY id desc";
            
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':busca', "%".$palavra."%");
            $p_sql->execute();
            $imoveis = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listImoveis = array();
            $clienteModelo = new ClienteModelo();
            $tipoModelo = new TipoImovelModelo();
            foreach ($imoveis as $key => $imovel_) {
                $imovel = new Imovel();
                $imovel->setId($imovel_->id);
                $imovel->setEndereco($imovel_->endereco);
                $imovel->setBairro($imovel_->bairro);
                $imovel->setValorLocacao($imovel_->valor_locacao);
                $imovel->setValorVenda($imovel_->valor_venda);
                $imovel->setFoto1($imovel_->foto1);
                $imovel->setFoto2($imovel_->foto2);
                $imovel->setFoto3($imovel_->foto3);
                $locatario = new Cliente();
                $locatario = $clienteModelo->getClientePeloId($imovel_->proprietario_id);
                $imovel->setLocatario($locatario);
                $tipo = new TipoImovel();
                $tipo = $tipoModelo->getTipoImovelPeloId($imovel_->tipo_imovel_id);
                $imovel->setTipoImovel($tipo);
                $listImoveis[$key] = $imovel;
            }
            return $listImoveis;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

    function salvar(Imovel $imovel) {

        try {
            $sql = 'insert into imoveis (endereco,bairro,tipo_imovel_id,
                foto1,foto2,foto3,situacao,proprietario_id,valor_venda,valor_locacao,
                qt_suites,qt_banheiros,qt_quartos,obs,area_construida) 
values(
    upper(:endereco),:bairro,:tipo_imovel_id,:foto1,
    :foto2,:foto3,1,:proprietario_id,:valor_venda,
    :valor_locacao,:qt_suites,:qt_banheiros,:qt_quartos,
    :obs,:area_construida
    )';
$p_sql = Conexao::getInstancia()->prepare($sql);
$p_sql->bindValue(':endereco', $imovel->getEndereco());
$p_sql->bindValue(':bairro', $imovel->getBairro());
$p_sql->bindValue(':tipo_imovel_id', $imovel->getTipoImovel()->getId());
$p_sql->bindValue(':foto1', $imovel->getFoto1());
$p_sql->bindValue(':foto2', $imovel->getFoto2());
$p_sql->bindValue(':foto3', $imovel->getFoto3());
$p_sql->bindValue(':proprietario_id', $imovel->getLocatario()->getId());
$p_sql->bindValue(':valor_venda', $imovel->getValorVenda());
$p_sql->bindValue(':valor_locacao', $imovel->getValorLocacao());
$p_sql->bindValue(':qt_suites', $imovel->getQtSuites());
$p_sql->bindValue(':qt_banheiros', $imovel->getQtBanheiros());
$p_sql->bindValue(':qt_quartos', $imovel->getQtQuartos());
$p_sql->bindValue(':obs', $imovel->getObs());
$p_sql->bindValue(':area_construida', $imovel->getAreaConstruida());
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

}
