<?php

namespace PPI2\Modelos;

use PPI2\Util\Conexao;
use PPI2\Entidades\Locacao;
use PPI2\Modelos\ClienteModelo;
use PPI2\Modelos\TipoImovelModelo;
use PPI2\Modelos\ImovelModelo;
use PDO;

class LocacaoModelo {


    function listar() {

        try {
            $sql = 'select * from locacoes order by id desc';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->execute();
            $locacoes = $p_sql->fetchAll(PDO::FETCH_OBJ);
            $listLocacoes = array();
            $clienteModelo = new ClienteModelo();
            $tipoModelo = new TipoImovelModelo();
            $imovelModelo = new ImovelModelo();
            foreach ($locacoes as $key => $locacao_) {
                $locacao = new Locacao();
                $imovel = $imovelModelo->getImovel($locacao_->imovel_id);
                $locador = $clienteModelo->getClientePeloId($locacao_->locador_id);
                $imovel->setLocador($locador);
                $locacao->setLocador($locador);
                $locacao->setImovel($imovel);
                $locacao->setId($locacao_->id);
                $locacao->setDataLocacao($locacao_->data_locacao);
                $locacao->setValorMensal($locacao_->valor_mensal);
                $locacao->setValorVenda($locacao_->valor_venda);
                $locacao->setValorComissao($locacao_->valor_comissao);
                $locacao->setDataEncerramento($locacao_->data_encerramento);
                $locacao->setStatus($locacao_->status);
                $locacao->setDiaVencimento($locacao_->dia_vencimento);
                $locacao->setDiaRepasse($locacao_->dia_repasse);
                $listLocacoes[$key] = $locacao;
            }
            return $listLocacoes;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }
    function busca($palavra) {

        try {
            $sql = "select i.id, i.endereco, i.bairro,
            i.tipo_locacao_id, i.foto1,i.foto2,i.foto3,i.proprietario_id, i.valor_locacao, i.valor_venda, 
            i.area_construida, i.qt_quartos,i.qt_banheiros, i.qt_suites,i.obs,
            c.nome,c.cpf,t.descricao from locacoes as i, clientes as c, tipo_imovel as t where 
            c.id = i.proprietario_id and t.id = i.tipo_locacao_id and (c.nome like :busca or 
                c.cpf like :busca or i.endereco like :busca or i.bairro like :busca or 
                i.valor_locacao like :busca or t.descricao like :busca) ORDER BY id desc";

$p_sql = Conexao::getInstancia()->prepare($sql);
$p_sql->bindValue(':busca', "%".$palavra."%");
$p_sql->execute();
$locacoes = $p_sql->fetchAll(PDO::FETCH_OBJ);
$listLocacoes = array();
$clienteModelo = new ClienteModelo();
$tipoModelo = new TipoImovelModelo();
foreach ($locacoes as $key => $locacao_) {
    $imovel = new Imovel();
    $imovel->setId($locacao_->id);
    $imovel->setEndereco($locacao_->endereco);
    $imovel->setBairro($locacao_->bairro);
    $imovel->setQtBanheiros($locacao_->qt_banheiros);
    $imovel->setQtQuartos($locacao_->qt_quartos);
    $imovel->setQtSuites($locacao_->qt_suites);
    $imovel->setObs($locacao_->obs);
    $imovel->setAreaConstruida($locacao_->area_construida);
    $imovel->setValorLocacao($locacao_->valor_locacao);
    $imovel->setValorVenda($locacao_->valor_venda);
    $imovel->setFoto1($locacao_->foto1);
    $imovel->setFoto2($locacao_->foto2);
    $imovel->setFoto3($locacao_->foto3);
    $locatario = new Cliente();
    $locatario = $clienteModelo->getClientePeloId($locacao_->proprietario_id);
    $imovel->setLocatario($locatario);
    $tipo = new TipoImovel();
    $tipo = $tipoModelo->getTipoImovelPeloId($locacao_->tipo_locacao_id);
    $imovel->setTipoImovel($tipo);
    $listLocacoes[$key] = $imovel;
}
return $listLocacoes;
} catch (Exception $ex) {
    return 'deu erro na conexão:' . $ex;
}
}

function salvar(Locacao $locacao) {

    try {
        $sql = 'insert into locacoes (locador_id,valor_mensal,valor_comissao,
            imovel_id,dia_vencimento,dia_repasse) values(
    :locador_id,:valor_mensal,:valor_comissao,:imovel_id,:dia_vencimento,:dia_repasse)';
$p_sql = Conexao::getInstancia()->prepare($sql);
$p_sql->bindValue(':locador_id', $locacao->getLocador()->getId());
$p_sql->bindValue(':valor_mensal', $locacao->getValorMensal());
$p_sql->bindValue(':valor_comissao', $locacao->getValorComissao());
$p_sql->bindValue(':imovel_id', $locacao->getImovel()->getId());
$p_sql->bindValue(':dia_vencimento', $locacao->getDiaVencimento());
$p_sql->bindValue(':dia_repasse', $locacao->getDiaRepasse());
if ($p_sql->execute())
    return Conexao::getInstancia()->lastInsertId();
return null;
} catch (Exception $ex) {
    return 'deu erro na conexão:' . $ex;
}
}
function atualizar(Imovel $imovel) {

    try {
        $sql = 'update locacoes set endereco = upper(:endereco),
        bairro = upper(:bairro),tipo_locacao_id = :tipo_locacao_id,
        foto1 = :foto1,foto2 = :foto2, foto3 = :foto3,
        proprietario_id = :proprietario_id, valor_venda = :valor_venda,
        valor_locacao = :valor_locacao,qt_suites = :qt_suites,qt_banheiros = :qt_banheiros,
        qt_quartos = :qt_quartos,obs = :obs, area_construida = :area_construida where id = :id';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id', $imovel->getId());
        $p_sql->bindValue(':endereco', $imovel->getEndereco());
        $p_sql->bindValue(':bairro', $imovel->getBairro());
        $p_sql->bindValue(':tipo_locacao_id', $imovel->getTipoImovel()->getId());
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
            return $imovel;
        return null;
    } catch (Exception $ex) {
        return 'deu erro na conexão:' . $ex;
    }
}
function deleteImageFromImovel($id,$indice){
    //print_r('id = '.$id.' indice = '.$indice);
    //die();
    try {
        $sql = 'update locacoes set '.$indice.' = NULL where id = :id';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id', $id);
        if ($p_sql->execute())
            return true;
        return null;
    } catch (Exception $ex) {
        return 'deu erro na conexão:' . $ex;
    }
}
function transferirImovel($idImovel,$newLocatario){
    //print_r('id = '.$id.' indice = '.$indice);
    //die();
    try {
        $sql = 'update locacoes set proprietario_id = :new_proprietario where id = :id';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id', $idImovel);
        $p_sql->bindValue(':new_proprietario', $newLocatario);
        if ($p_sql->execute())
            return true;
        return null;
    } catch (Exception $ex) {
        return 'deu erro na conexão:' . $ex;
    }
}
function getLocacao($id) {
    try {
        $sql = 'select * from locacoes where id = :id';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id',$id);
        $p_sql->execute();
        if ($p_sql->rowCount() > 0) {
            $locacao_ = $p_sql->fetchAll(PDO::FETCH_OBJ)[0];
            $locacao = new Locacao();
            $clienteModelo = new ClienteModelo();
            $imovelModelo = new ImovelModelo();
            $imovel = $imovelModelo->getImovel($locacao_->imovel_id);
            $locador = $clienteModelo->getClientePeloId($locacao_->locador_id);
            $imovel->setLocador($locador);
            $locacao->setLocador($locador);
            $locacao->setImovel($imovel);
            $locacao->setId($locacao_->id);
            $locacao->setDataLocacao($locacao_->data_locacao);
            $locacao->setValorMensal($locacao_->valor_mensal);
            $locacao->setValorVenda($locacao_->valor_venda);
            $locacao->setValorComissao($locacao_->valor_comissao);
            $locacao->setDataEncerramento($locacao_->data_encerramento);
            $locacao->setStatus($locacao_->status);
            $locacao->setDiaVencimento($locacao_->dia_vencimento);
            $locacao->setDiaRepasse($locacao_->dia_repasse);
            return $locacao;
        }
        return null;
    } catch (Exception $ex) {
        return 'deu erro na conexão:' . $ex;
    }
}
function getLocacaoPeloImovelId($id) {
    try {
        //status = 1 LOCADO;
        $sql = 'select * from locacoes where imovel_id = :id and status = 1';
        $p_sql = Conexao::getInstancia()->prepare($sql);
        $p_sql->bindValue(':id',$id);
        $p_sql->execute();
        if ($p_sql->rowCount() > 0) {
            $locacao_ = $p_sql->fetchAll(PDO::FETCH_OBJ)[0];
            $locacao = new Locacao();
            $clienteModelo = new ClienteModelo();
            $imovelModelo = new ImovelModelo();
            $imovel = $imovelModelo->getImovel($locacao_->imovel_id);
            $locador = $clienteModelo->getClientePeloId($locacao_->locador_id);
            $imovel->setLocador($locador);
            $locacao->setLocador($locador);
            $locacao->setImovel($imovel);
            $locacao->setId($locacao_->id);
            $locacao->setDataLocacao($locacao_->data_locacao);
            $locacao->setValorMensal($locacao_->valor_mensal);
            $locacao->setValorVenda($locacao_->valor_venda);
            $locacao->setValorComissao($locacao_->valor_comissao);
            $locacao->setDataEncerramento($locacao_->data_encerramento);
            $locacao->setStatus($locacao_->status);
            $locacao->setDiaVencimento($locacao_->dia_vencimento);
            $locacao->setDiaRepasse($locacao_->dia_repasse);
            return $locacao;
        }
        return null;
    } catch (Exception $ex) {
        return 'deu erro na conexão:' . $ex;
    }
}
}