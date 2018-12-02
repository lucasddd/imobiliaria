<?php

namespace PPI2\Rotas;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();

$rotas->add('raiz', new Route('/',
        array('_controller' => 'PPI2\Controller\ControllerIndex',"method" => 'index')));

$rotas->add('login', new Route('/login',
        array('_controller' => 'PPI2\Controller\ControllerUsuario',
            "method" => 'validaLogin')));

$rotas->add('admin', new Route('/admin',
        array('_controller' => 'PPI2\Controller\ControllerIndex',
            "method" => 'index')));

$rotas->add('logout', new Route('/logout',
        array('_controller' => 'PPI2\Controller\ControllerUsuario',
            "method" => 'logout')));
/*      INICIO DAS ROTAS PARA MANUTENÇÃO DE TIPOS DE CLIENTES        */
$rotas->add('tiposCliente', new Route('/admin/tiposcliente',
        array('_controller' => 'PPI2\Controller\ControllerTipoCliente',
            "method" => 'index')));

$rotas->add('novoTipoCliente', new Route('/admin/tiposcliente/novo',
        array('_controller' => 'PPI2\Controller\ControllerTipoCliente',
            "method" => 'novo', 'suffix' => '')));

$rotas->add('salvarTipoCliente', new Route('/admin/tiposcliente/salvar',
        array('_controller' => 'PPI2\Controller\ControllerTipoCliente',
            "method" => 'salvar')));

$rotas->add('editTipoCliente', new Route('/admin/tiposcliente/editar/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerTipoCliente',
            "method" => 'editar','suffix' => '')));

$rotas->add('atualizarTipoCliente', new Route('/admin/tiposcliente/atualizar',
        array('_controller' => 'PPI2\Controller\ControllerTipoCliente',
            "method" => 'atualizar')));
/*      FIM DAS ROTAS PARA MANUTENÇÃO DE TIPOS DE CLIENTES        */
/*      INICIO DAS ROTAS PARA MANUTENÇÃO DE CLIENTES        */
$rotas->add('clientes', new Route('/admin/clientes',
        array('_controller' => 'PPI2\Controller\ControllerCliente',
            "method" => 'index')));

$rotas->add('novoCliente', new Route('/admin/cliente/novo',
        array('_controller' => 'PPI2\Controller\ControllerCliente',
            "method" => 'novo')));

$rotas->add('salvarCliente', new Route('/admin/cliente/salvar',
        array('_controller' => 'PPI2\Controller\ControllerCliente',
            "method" => 'salvar')));

$rotas->add('editCliente', new Route('/admin/cliente/editar/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerCliente',
            "method" => 'editar','suffix' => '')));

$rotas->add('atualizarCliente', new Route('/admin/cliente/atualizar',
        array('_controller' => 'PPI2\Controller\ControllerCliente',
            "method" => 'atualizar')));
/*      FIM DAS ROTAS PARA MANUTENÇÃO DE CLIENTES        */
/*      INICIO DAS ROTAS PARA MANUTENÇÃO DE TIPOS DE IMOVEIS        */
$rotas->add('tiposImovel', new Route('/admin/tiposimoveis',
        array('_controller' => 'PPI2\Controller\ControllerTipoImovel',
            "method" => 'index')));

$rotas->add('novoTipoImovel', new Route('/admin/tiposimoveis/novo',
        array('_controller' => 'PPI2\Controller\ControllerTipoImovel',
            "method" => 'novo', 'suffix' => '')));

$rotas->add('salvarTipoImovel', new Route('/admin/tiposimoveis/salvar',
        array('_controller' => 'PPI2\Controller\ControllerTipoImovel',
            "method" => 'salvar')));

$rotas->add('editTipoImovel', new Route('/admin/tiposimoveis/editar/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerTipoImovel',
            "method" => 'editar','suffix' => '')));

$rotas->add('atualizarTipoImovel', new Route('/admin/tiposimoveis/atualizar',
        array('_controller' => 'PPI2\Controller\ControllerTipoImovel',
            "method" => 'atualizar')));
/*      FIM DAS ROTAS PARA MANUTENÇÃO DE TIPOS DE IMOVEIS        */
/*      INICIO DAS ROTAS PARA MANUTENÇÃO DE IMOVEIS        */
$rotas->add('imoveis', new Route('/admin/imoveis',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'index')));

$rotas->add('novoImovel', new Route('/admin/imoveis/novo',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'novo', 'suffix' => '')));

$rotas->add('informecpf', new Route('/admin/imoveis/informecpf',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'informecpf', 'suffix' => '')));

$rotas->add('transferir_informecpf', new Route('/admin/imoveis/transferir_informecpf',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'transferir_informecpf', 'suffix' => '')));

$rotas->add('transferirImovel', new Route('/admin/imoveis/transferir',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'transferirImovel', 'suffix' => '')));

$rotas->add('salvarImovel', new Route('/admin/imoveis/salvar',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'salvar')));

$rotas->add('efetuarTransferencia', new Route('/admin/imoveis/efetuartransferencia',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'transferirProprietario')));

$rotas->add('editImovel', new Route('/admin/imoveis/editar/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'editar','suffix' => '')));

$rotas->add('showImovel', new Route('/admin/imoveis/show/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'show','suffix' => '')));

$rotas->add('atualizarImovel', new Route('/admin/imoveis/atualizar',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'atualizar')));

$rotas->add('removeImage', new Route('/admin/imoveis/removeimage',
        array('_controller' => 'PPI2\Controller\ControllerImovel',
            "method" => 'removeImage')));
/*      FIM DAS ROTAS PARA MANUTENÇÃO DE IMOVEIS        */
$rotas->add('esporte', new Route('/esportes/{suffix}',
        array('_controller' => 'PPI2\Controller\ControllerEsporte',"method" => 'msgInicial', 'suffix' => '')));

$rotas->add('produtos', new Route('/produtos',
        array('_controller' => 'PPI2\Controller\ControllerEsporte',
            "method" => 'listarProdutos')));
$rotas->add('formCadastro', new Route('/formularioCadastro',
        array('_controller' => 'PPI2\Controller\ControllerCadastro',
            "method" => 'show')));
$rotas->add('cadastroProduto', new Route('/cadastro',
        array('_controller' => 'PPI2\Controller\ControllerCadastro',
            "method" => 'cadastro')));
/* $rotas->add('esporte', new Route('/financas', array('_controller' => 'PPI2\Controller\ControllerFinancas', "method"=>'msgInicialFinancas')));
  $rotas->add('esporte', new Route('/produtos', array('_controller' => 'PPI2\Controller\ControllerProduto', "method"=>'listar')));
 */
return $rotas;

