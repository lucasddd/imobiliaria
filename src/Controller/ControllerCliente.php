<?php

namespace PPI2\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use PPI2\Entidades\Cliente;
use PPI2\Modelos\ClienteModelo;
use PPI2\Util\Sessao;

class ControllerCliente {

  private $response;
  private $contexto;
  private $twig;
  private $sessao;

  public function __construct(Response $response, Request $contexto, Environment $twig, Sessao $sessao) {
    $this->response = $response;
    $this->contexto = $contexto;
    $this->twig = $twig;
    $this->sessao = $sessao;
  }
  public function index() {
    if ($this->sessao->existe('usuario')){
      $busca = $this->contexto->get('busca');
      $clientesModelo = new ClienteModelo();
      if(isset($busca)){
        $clientes = $clientesModelo->busca($busca);
      }else{
        $clientes = $clientesModelo->listar();
      }
      return $this->response->setContent($this->twig->render('clientes/index.php',['clientes' => $clientes]));
    }else{
      $destino = '/';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }
    return;
  }

  public function show() {
    if ($this->sessao->existe('usuario'))
      return $this->response->setContent($this->twig->render('cadastro.twig'));
    else{
      $destino = '/';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();

    } 
  }
  public function editar($id) {
    if ($this->sessao->existe('usuario')){
      if(!is_numeric($id) || $id < 1){
        $destino = '/admin/tiposcliente';
        $redirecionar = new RedirectResponse($destino);
        $redirecionar->send();
        return;   
      }
      $clientesModelo = new TipoClienteModelo();
      $tipoCliente = $clientesModelo->getTipoCliente($id);
      if($tipoCliente != null){
        return $this->response->setContent($this->twig->render('tiposcliente/editar.php',['tipocliente' => $tipoCliente]));
      }
      $destino = '/admin/tiposcliente';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
      return;
    } 
  }
  public function novo() {
    if ($this->sessao->existe('usuario'))
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => '']));
    else{
      $destino = '/';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();

    } 
  }
  public function salvar() {
    if ($this->sessao->existe('usuario')){
      $erros = [];
      $desc = trim($this->contexto->get('descricao'));
      if(strlen($desc) < 5 || strlen($desc) > 255){
        $erros['len'] = 'Tamanho do texto na descrição inválido.';
        $erros['len2'] = 'A palavra precisa ter entre 5 e 255 caractéres.';
        return $this->response->setContent($this->twig->render('tiposcliente/novo.php',['erros' => $erros]));
      }
      $clientesModelo = new TipoClienteModelo();
      $duplicidadeDescricao = $clientesModelo->consultaDescricao($desc);
      if(isset($duplicidadeDescricao)){
        $erros['duplicidade'] = 'A descricao "'.$desc.'" já esta cadastrada.';
        return $this->response->setContent($this->twig->render('tiposcliente/novo.php',['erros' => $erros]));
      }else{
        $tipoCliente = new TipoCliente();
        $tipoCliente->setDescricao($desc);
        $clientesModelo->salvar($tipoCliente);
        $destino = '/admin/tiposcliente';
        $redirecionar = new RedirectResponse($destino);
        $redirecionar->send();
      }
    }else{
      $destino = '/';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }
    return;
  }
  public function atualizar() {
    if ($this->sessao->existe('usuario')){
      $clientesModelo = new TipoClienteModelo();
      $erros = [];
      $id = $this->contexto->get('id');
      $tipoCliente = $clientesModelo->getTipoCliente($id);
      $desc = trim($this->contexto->get('descricao'));
      if(!is_numeric($id)){
        $erros['id'] = 'Id inválido';
      }
      if(strlen($desc) < 5 || strlen($desc) > 255){
        $erros['len'] = 'Tamanho do texto na descrição inválido.';
        $erros['len2'] = 'A palavra precisa ter entre 5 e 255 caractéres.';
      }
      if(!empty($erros)){
        $erros['chu'] = 'não sei';
        return $this->response->setContent($this->twig->render('tiposcliente/editar.php',['erros' => $erros,'tipocliente' => $tipoCliente]));
      }
      $duplicidadeDescricao = $clientesModelo->consultaDescricaoComExcessaoId($desc,$id);
      if(isset($duplicidadeDescricao)){
        $erros['duplicidade'] = 'A descricao "'.$desc.'" já esta cadastrada.';
        return $this->response->setContent($this->twig->render('tiposcliente/editar.php',['erros' => $erros,'tipocliente' => $tipoCliente]));
      }else{
        $tipoCliente = new TipoCliente();
        $tipoCliente->setDescricao($desc);
        $tipoCliente->setId($id);
        $clientesModelo->atualizar($tipoCliente);
        $destino = '/admin/tiposcliente';
        $redirecionar = new RedirectResponse($destino);
        $redirecionar->send();
      }
    }else{
      $destino = '/';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }
    return;
  }
  public function cadastro() {
        // validação
    $imagem = $this->contexto->files->get('imagem');
    echo $imagem->getClientOriginalName();
       // echo $imagem->getClientMimeType();
       /* if($imagem->getSize() > 2000000){
            echo '<br>muito grande';
            
        }else{
            echo '<br>tamanho válido';
          }*/

// falta mover patra concretizar o upload

       /* 
          $descricao = $this->contexto->get('descricao');
          $preco = $this->contexto->get('preco');
          // depois de validado
          $produto = new Produto($descricao, $preco);
          $modeloProduto = new ModeloProdutos();
          if ($id = $modeloProduto->cadastrar($produto))
          echo ("Produto $id inserido com sucesso");
          else
          echo "erro na inserção";
         */
        }

      }
