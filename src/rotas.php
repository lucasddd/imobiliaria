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

