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
  /*FONTE https://www.geradorcpf.com/script-validar-cpf-php.htm*/
  public function validaCPF($cpf = null) {

  // Verifica se um número foi informado
    if(empty($cpf)) {
      return false;
    }

  // Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

  // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
      return false;
    }
  // Verifica se nenhuma das sequências invalidas abaixo 
  // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
      $cpf == '11111111111' || 
      $cpf == '22222222222' || 
      $cpf == '33333333333' || 
      $cpf == '44444444444' || 
      $cpf == '55555555555' || 
      $cpf == '66666666666' || 
      $cpf == '77777777777' || 
      $cpf == '88888888888' || 
      $cpf == '99999999999') {
      return false;
   // Calcula os digitos verificadores para verificar se o
   // CPF é válido
  } else {   

    for ($t = 9; $t < 11; $t++) {

      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf{$c} * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf{$c} != $d) {
        return false;
      }
    }

    return true;
  }
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
      $destino = '/admin/clientes';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
      return;   
    }
    $clientesModelo = new ClienteModelo();
    $cliente = $clientesModelo->getCliente($id);
    if($cliente != null){
      return $this->response->setContent($this->twig->render('clientes/editar.php',['cliente' => $cliente]));
    }
    $destino = '/admin/clientes';
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
    $nome = trim($this->contexto->get('nome'));
    $cpf = trim(preg_replace("/[^0-9]/", "", $this->contexto->get('cpf')));
    $rg = trim($this->contexto->get('rg'));
    $telefone = preg_replace("/[^0-9]/", "", $this->contexto->get('telefone'));
    $dataNasc = trim($this->contexto->get('datanascimento'));
//    print_r("Nasc: ".$dataNasc);
    $endereco = trim($this->contexto->get('endereco'));
    $bairro = trim($this->contexto->get('bairro'));
    $cidade = trim($this->contexto->get('cidade'));
    $cep = preg_replace("/[^0-9]/", "", $this->contexto->get('cep'));
    if (!empty($dataNasc)) {
      $data = $dataNasc;
      $data = explode('/', $data);
      //print_r("data aqui ".!empty($data[0]));
      if(empty($data)){
        $dia = $data[0];
        $mes = $data[1];
        $ano = $data[2];
        $dataNasc = $ano . '-' . $mes . '-' . $dia;
      }
    }else{
      $erros['nasc'] = 'Data de nascimento é de preenchimento obrigatório';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }
    //print_r("data nasc: ".$cpf);
    //die();
    if(strlen($nome) < 10 || strlen($nome) > 255){
      $erros['len'] = 'Nome precisa ter entre 10 e 255 caractéres.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }
    if(strlen($endereco) < 5 || strlen($endereco) > 255){
      $erros['len'] = 'Endereço precisa ter entre 5 e 255 caractéres.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }
    if(isset($cep) && strlen($cep) != 8){
      $erros['cep'] = 'Cep inválido.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }
    if(isset($telefone) && strlen($telefone) < 8){
      $erros['telefone'] = 'Telefone inválido.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }
    if(!$this->validaCPF($cpf)){
      $erros['cpf'] = 'Cpf inválido.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));        
    }
    $clientesModelo = new ClienteModelo();
    $duplicidadeCpf = $clientesModelo->consultaCpf($cpf);
    if(isset($duplicidadeCpf)){
      $erros['duplicidade'] = 'O cpf "'.$cpf.'" já esta cadastrado.';
      return $this->response->setContent($this->twig->render('clientes/novo.php',['erros' => $erros]));
    }else{
      $cliente = new Cliente();
      $cliente->setNome($nome);
      $cliente->setCpf($cpf);
      $cliente->setRg($rg);
      $cliente->setTelefone($telefone);
      $cliente->setDataNascimento($dataNasc);
      $cliente->setEndereco($endereco);
      $cliente->setBairro($bairro);
      $cliente->setCidade($cidade);
      $cliente->setCep($cep);
      $clientesModelo->salvar($cliente);
      $destino = '/admin/clientes';
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
    $erros = [];
    $id = $this->contexto->get('id');
    $clientesModelo = new ClienteModelo();
    $cliente = $clientesModelo->getCliente($id);
    if(!isset($cliente)){
      $erros['id'] = 'Cliente não encontrado.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    $nome = trim($this->contexto->get('nome'));
    $cpf = trim(preg_replace("/[^0-9]/", "", $this->contexto->get('cpf')));
    $rg = trim($this->contexto->get('rg'));
    $telefone = preg_replace("/[^0-9]/", "", $this->contexto->get('telefone'));
    $dataNasc = trim($this->contexto->get('datanascimento'));
//    print_r("Nasc: ".$dataNasc);
    $endereco = trim($this->contexto->get('endereco'));
    $bairro = trim($this->contexto->get('bairro'));
    $cidade = trim($this->contexto->get('cidade'));
    $cep = preg_replace("/[^0-9]/", "", $this->contexto->get('cep'));
    if (!empty($dataNasc)) {
      $data = $dataNasc;
      $data = explode('/', $data);
      //print_r("data aqui ".!empty($data[0]));
      if(empty($data)){
        $dia = $data[0];
        $mes = $data[1];
        $ano = $data[2];
        $dataNasc = $ano . '-' . $mes . '-' . $dia;
      }
    }else{
      $erros['nasc'] = 'Data de nascimento é de preenchimento obrigatório';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    //print_r("data nasc: ".$cpf);
    //die();
    if(strlen($nome) < 10 || strlen($nome) > 255){
      $erros['len'] = 'Nome precisa ter entre 10 e 255 caractéres.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    if(strlen($endereco) < 5 || strlen($endereco) > 255){
      $erros['len'] = 'Endereço precisa ter entre 5 e 255 caractéres.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    if(isset($cep) && strlen($cep) != 8){
      $erros['cep'] = 'Cep inválido.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    if(isset($telefone) && strlen($telefone) < 11){
      $erros['telefone'] = 'Telefone inválido.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }
    if(!$this->validaCPF($cpf)){
      $erros['cpf'] = 'Cpf inválido.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));        
    }
    $duplicidadeCpf = $clientesModelo->consultaCpfComExcessaoId($cpf,$id);
    if(isset($duplicidadeCpf)){
      $erros['duplicidade'] = 'O cpf "'.$cpf.'" já esta cadastrado.';
      return $this->response->setContent($this->twig->render('clientes/editar.php',['erros' => $erros,'cliente' => $cliente]));
    }else{
      $cliente = new Cliente();
      $cliente->setId($id);
      $cliente->setNome($nome);
      $cliente->setCpf($cpf);
      $cliente->setRg($rg);
      $cliente->setTelefone($telefone);
      $cliente->setDataNascimento($dataNasc);
      $cliente->setEndereco($endereco);
      $cliente->setBairro($bairro);
      $cliente->setCidade($cidade);
      $cliente->setCep($cep);
      $clientesModelo->atualizar($cliente);
      $destino = '/admin/clientes';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();
  }
  return;
  /*
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
  */
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
