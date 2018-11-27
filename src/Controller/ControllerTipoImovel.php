<?php

namespace PPI2\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use PPI2\Entidades\TipoImovel;
use PPI2\Modelos\TipoImovelModelo;
use PPI2\Util\Sessao;

class ControllerTipoImovel {

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
      $tipos = new TipoImovelModelo();
      if(isset($busca)){
        $tipoImoveis = $tipos->busca($busca);
      }else{
        $tipoImoveis = $tipos->listar();
      }
      $listImoveis = array();
      foreach ($tipoImoveis as $key => $tipoImovel) {
        $tipoIm = new TipoImovel();
        $tipoIm->setId($tipoImovel->id);
        $tipoIm->setDescricao($tipoImovel->descricao);
        $listImoveis[$key] = $tipoIm;
      }
      return $this->response->setContent($this->twig->render('tipoimoveis/index.php',['tiposimoveis' => $listImoveis]));
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
        $destino = '/admin/tiposimoveis';
        $redirecionar = new RedirectResponse($destino);
        $redirecionar->send();
        return;   
      }
      $tipos = new TipoImovelModelo();
      $tipoImovel = $tipos->getTipoImovel($id);
      if($tipoImovel != null){
        return $this->response->setContent($this->twig->render('tipoimoveis/editar.php',['tipoimovel' => $tipoImovel]));
      }
      $destino = '/admin/tiposimoveis';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
      return;
    } 
  }
  public function novo() {
    if ($this->sessao->existe('usuario'))
      return $this->response->setContent($this->twig->render('tipoimoveis/novo.php',['erros' => '']));
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
      if(strlen($desc) < 3 || strlen($desc) > 255){
        $erros['len'] = 'Tamanho do texto na descrição inválido.';
        $erros['len2'] = 'A palavra precisa ter entre 3 e 255 caractéres.';
        return $this->response->setContent($this->twig->render('tipoimoveis/novo.php',['erros' => $erros]));
      }
      $tipos = new TipoImovelModelo();
      $duplicidadeDescricao = $tipos->consultaDescricao($desc);
      if(isset($duplicidadeDescricao)){
        $erros['duplicidade'] = 'A descricao "'.$desc.'" já esta cadastrada.';
        return $this->response->setContent($this->twig->render('tipoimoveis/novo.php',['erros' => $erros]));
      }else{
        $tipoImovel = new TipoImovel();
        $tipoImovel->setDescricao($desc);
        $tipos->salvar($tipoImovel);
        $destino = '/admin/tiposimoveis';
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
      $tipos = new TipoImovelModelo();
      $erros = [];
      $id = $this->contexto->get('id');
      $tipoImovel = $tipos->getTipoImovel($id);
      $desc = trim($this->contexto->get('descricao'));
      if(!is_numeric($id)){
        $erros['id'] = 'Id inválido';
      }
      if(strlen($desc) < 3 || strlen($desc) > 255){
        $erros['len'] = 'Tamanho do texto na descrição inválido.';
        $erros['len2'] = 'A palavra precisa ter entre 3 e 255 caractéres.';
      }
      if(!empty($erros)){
        return $this->response->setContent($this->twig->render('tipoimoveis/editar.php',['erros' => $erros,'tipoimovel' => $tipoImovel]));
      }
      $duplicidadeDescricao = $tipos->consultaDescricaoComExcessaoId($desc,$id);
      if(isset($duplicidadeDescricao)){
        $erros['duplicidade'] = 'A descricao "'.$desc.'" já esta cadastrada.';
        return $this->response->setContent($this->twig->render('tipoimoveis/editar.php',['erros' => $erros,'tipoimovel' => $tipoImovel]));
      }else{
        $tipoImovel = new TipoImovel();
        $tipoImovel->setDescricao($desc);
        $tipoImovel->setId($id);
        $tipos->atualizar($tipoImovel);
        $destino = '/admin/tiposimoveis';
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
