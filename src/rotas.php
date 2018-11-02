<?php

namespace PPI2\Rotas;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();


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

