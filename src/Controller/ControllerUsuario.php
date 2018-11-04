<?php

namespace PPI2\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use PPI2\Entidades\Usuario;
use PPI2\Modelos\UsuarioModelo;
use PPI2\Util\Sessao;

class ControllerUsuario {

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
    public function validaLogin(){
      $login = $this->contexto->get('login');
      $senha = $this->contexto->get('senha');
      if(isset($login) && isset($senha)){
          $usuarioModelo = new UsuarioModelo();
          $usuario = $usuarioModelo->login($login,$senha);
          if(isset($usuario)){
            $this->sessao->add('usuario',$usuario);
            echo('ok');
          }else{
            echo("inexistente");
          }
          return;
      }
      //print_r('login = '.$login.' senha = '.$senha);
      //return echo('oi');
      //die();
    }
    public function show() {
        //if ($this->sessao->existe('Usuario'))
        return $this->response->setContent($this->twig->render('cadastro.twig'));
        /*   else{
          $destino = '/login';
          $redirecionar = new RedirectResponse($destino);
          $redirecionar->send();

          } */
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
    public function logout(){
        $this->sessao->del();
        $re = new RedirectResponse('/');
        $re->send();
    }

}
