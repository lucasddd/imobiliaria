<?php

namespace PPI2\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use PPI2\Entidades\Locacao;
use PPI2\Modelos\LocacaoModelo;
use PPI2\Entidades\Cliente;
use PPI2\Modelos\ClienteModelo;
use PPI2\Entidades\Imovel;
use PPI2\Modelos\ImovelModelo;
use PPI2\Entidades\TipoImovel;
use PPI2\Modelos\TipoImovelModelo;
use PPI2\Util\Sessao;

class ControllerLocacao {

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
    $imoveisModelo = new ImovelModelo();
    if(isset($busca)){
      $imoveis = $imoveisModelo->busca($busca);
    }else{
      $imoveis = $imoveisModelo->listar();
    }
    return $this->response->setContent($this->twig->render('locacao/index.php',['imoveis' => $imoveis]));
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();
  }
  return;
}

public function show($id) {
  if ($this->sessao->existe('usuario')){
    if(!is_numeric($id) || $id < 1){
      $destino = '/admin/imoveis';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
      return;   
    }
    $imoveisModelo = new ImovelModelo();
    $imovel = $imoveisModelo->getImovel($id);
    if($imovel != null){
      return $this->response->setContent($this->twig->render('imoveis/show.php',['imovel' => $imovel]));
    }
    $destino = '/admin/imoveis';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();
    return;
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();

  }
}
public function editar($id) {
  if ($this->sessao->existe('usuario')){
    if(!is_numeric($id) || $id < 1){
      $destino = '/admin/imoveis';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
      return;   
    }
    $imoveisModelo = new ImovelModelo();
    $imovel = $imoveisModelo->getImovel($id);
    $tiposModelo = new TipoImovelModelo();
    $tipos = $tiposModelo->listar();
    if($imovel != null){
      return $this->response->setContent($this->twig->render('imoveis/editar.php',['imovel' => $imovel,'tipos' => $tipos]));
    }
    $destino = '/admin/imoveis';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();
    return;
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();

  } 
}
public function novo() {
  if ($this->sessao->existe('usuario')){
    $erros = [];
    $imovel = new Imovel();
    $cpf = trim(preg_replace("/[^0-9]/", "", $this->contexto->get('cpf')));
    //print_r($cpf);
    //die();
    if(!$this->validaCPF($cpf)){
      $erros['cpf'] = 'Cpf '.$this->contexto->get('cpf').' inválido.';
      //$destino = '/admin/imoveis/informecpf';
      //$redirecionar = new RedirectResponse($destino);
      //$redirecionar->send();
      return $this->response->setContent($this->twig->render('imoveis/informecpf.php',['erros' => $erros]));        
    }
    $clienteModelo = new ClienteModelo();
    $locatario = new Cliente();
    $tiposModelo = new TipoImovelModelo();
    $tipos = $tiposModelo->listar();
    $cliente_ = $clienteModelo->consultaCpf($cpf);
    if(isset($cliente_)){
      $locatario->setId($cliente_['id']);
      $locatario->setNome($cliente_['nome']);
      $locatario->setCpf($cliente_['cpf']);
      $locatario->setRg($cliente_['rg']);
      $locatario->setTelefone($cliente_['telefone']);
      $locatario->setDataNascimento($cliente_['datanascimento']);
      $locatario->setEndereco($cliente_['endereco']);
      $locatario->setBairro($cliente_['bairro']);
      $locatario->setCidade($cliente_['cidade']);
      $locatario->setCep($cliente_['cep']);
      return $this->response->setContent($this->twig->render('imoveis/novo.php',['locatario' => $locatario,'imovel' => $imovel,'tipos' => $tipos,'imovel' => $imovel]));        
    }else{
      $erros['clientenaoencontrado'] = 'Cliente não encontrado XD.';
      return $this->response->setContent($this->twig->render('imoveis/informecpf.php',['erros' => $erros]));        
    }
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();

  } 
}

public function alugar_informecpf() {
  if ($this->sessao->existe('usuario')){
    $idImovel = $this->contexto->get('id_imovel');
    return $this->response->setContent($this->twig->render('locacao/alugar_informecpf.php',['erros' => '','id_imovel' => $idImovel]));
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();

  } 
}
public function alugarImovel() {
  if ($this->sessao->existe('usuario')){
    $erros = [];
    $idImovel = $this->contexto->get('id_imovel');
    $imovel = new Imovel();
    $cpf = trim(preg_replace("/[^0-9]/", "", $this->contexto->get('cpf')));
    //print_r($cpf);
    //die();
    if(!$this->validaCPF($cpf)){
      $erros['cpf'] = 'Cpf '.$this->contexto->get('cpf').' inválido.';
      //$destino = '/admin/imoveis/informecpf';
      //$redirecionar = new RedirectResponse($destino);
      //$redirecionar->send();
      return $this->response->setContent($this->twig->render('locacao/alugar_informecpf.php',['erros' => $erros,'id_imovel' => $idImovel]));        
    }
    $clienteModelo = new ClienteModelo();
    $imovelModelo = new ImovelModelo();
    $imovel = $imovelModelo->getImovel($idImovel);
    $locador = new Cliente();
    $cliente_ = $clienteModelo->consultaCpf($cpf);
    if($cliente_['id'] == $imovel->getLocatario()->getId()){
      $erros['duplicidade'] = 'Locador não pode ser o locatário.';
      return $this->response->setContent($this->twig->render('locacao/alugar_informecpf.php',['erros' => $erros,'id_imovel' => $idImovel]));        
    }
    if(isset($cliente_)){
      $locacao = new Locacao();
      $locador->setId($cliente_['id']);
      $locador->setNome($cliente_['nome']);
      $locador->setCpf($cliente_['cpf']);
      $locador->setRg($cliente_['rg']);
      $locador->setTelefone($cliente_['telefone']);
      $locador->setDataNascimento($cliente_['datanascimento']);
      $locador->setEndereco($cliente_['endereco']);
      $locador->setBairro($cliente_['bairro']);
      $locador->setCidade($cliente_['cidade']);
      $locador->setCep($cliente_['cep']);
      $locacao->setLocador($locador);
      $locacao->setImovel($imovel);
      return $this->response->setContent($this->twig->render('locacao/alugarimovel.php',['locacao' => $locacao]));        
    }else{
      $erros['clientenaoencontrado'] = 'Cliente não encontrado XD.';
      return $this->response->setContent($this->twig->render('locacao/alugar_informecpf.php',['erros' => $erros,'id_imovel' => $idImovel]));        
    }
  }else{
    $destino = '/';
    $redirecionar = new RedirectResponse($destino);
    $redirecionar->send();

  } 
}
public function salvar() {
  if ($this->sessao->existe('usuario')){
    $erros = [];
    $diaVencimento = $this->contexto->get('diavencimento');
    if(!isset($diaVencimento))
      $diaVencimento = 0;
    $diaRepasse = $this->contexto->get('diarepasse');
    if(!isset($diaRepasse))
      $diaRepasse = 0;
    $valorLocacao = $this->contexto->get('valorlocacao');
    if(!isset($valorLocacao))
      $valorLocacao = 0;
    $comissao = $this->contexto->get('comissao');
    if(!isset($comissao))
      $comissao = 0;
    
    //Problema com fevereiro.
    if($diaRepasse < 1 || $diaRepasse > 31){
      $erros['diarepasse'] = 'Campo dia repasse inválido.';
    }
    if($diaVencimento < 1 || $diaVencimento > 31){
      $erros['diarepasse'] = 'Campo dia repasse inválido.';
    }
    if($valorLocacao < 1){
      $erros['valorlocacao'] = 'Campo valor locacação inválido.';
    }
    if($comissao < 1){
      $erros['comissao'] = 'Campo valor comissão inválido.';
    }
    $clienteModelo = new ClienteModelo();
    $imovelModelo = new ImovelModelo();
    $imovel = $imovelModelo->getImovel($this->contexto->get('id_imovel'));
    $locacaoModelo = new LocacaoModelo();
    $locador = $clienteModelo->getClientePeloId($this->contexto->get('id_locador'));
    $locacao = new Locacao();
    $locacao->setImovel($imovel);
    $locacao->setLocador($locador);
    $locacao->setValorMensal(str_replace(',', '.', $valorLocacao));
    $locacao->setValorComissao(str_replace(',', '.', $comissao));
    $locacao->setDiaVencimento($diaVencimento);
    $locacao->setDiaRepasse($diaRepasse);
    $jaEstaLocado = $locacaoModelo->getLocacaoPeloImovelId($imovel->getId());
    if($jaEstaLocado){
      $erros['imoveljalocado'] = 'Este imóvel já esta locado.';
    }
    if(!empty($erros)){
      return $this->response->setContent($this->twig->render('locacao/alugarimovel.php',['erros' => $erros,'locacao' => $locacao]));
    }
    //print_r($this->contexto);
    //die();
    
    $locacaoModelo->salvar($locacao);
    if($locacaoModelo){
      $destino = '/admin/imoveis';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }else{
      $erros['ErroDB'] = "algo errado com o database...";
      return $this->response->setContent($this->twig->render('imoveis/novo.php',['erros' => $erros,'tipos' => $tipoModelo->listar(),'locatario' => $locatario,'imovel' => $imovel]));
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
    $imovelModelo = new ImovelModelo();
    $imovel = $imovelModelo->getImovel($this->contexto->get('id'));
    $endereco = trim($this->contexto->get('endereco'));
    $bairro = trim($this->contexto->get('bairro'));
    $valorLocacao = $this->contexto->get('valorlocacao');
    $valorVenda = $this->contexto->get('valorvenda');
    $qtQuartos = $this->contexto->get('qtquartos');
    if(empty($qtQuartos))
      $qtQuartos = 0;
    $qtSuites = $this->contexto->get('qtsuites');
    if(empty($qtSuites))
      $qtSuites = 0;
    $qtBanheiros = $this->contexto->get('qtbanheiros');
    if(empty($qtBanheiros))
      $qtBanheiros = 0;
    $areaConstruida = str_replace(',', '.', $this->contexto->get('areaconstruida'));
    $obs = $this->contexto->get('obs');
    $imovel->setEndereco($endereco);
    $imovel->setBairro($bairro);
    $imovel->setValorLocacao($valorLocacao);
    $imovel->setValorVenda($valorVenda);
    $imovel->setQtQuartos($qtQuartos);
    $imovel->setQtBanheiros($qtBanheiros);
    $imovel->setQtSuites($qtSuites);
    $imovel->setAreaConstruida($areaConstruida);
    $imovel->setObs($obs);
    //print_r($imovel);
    //die();
    $tipoModelo = new TipoImovelModelo();
    $clienteModelo = new ClienteModelo();
    $locatario = new Cliente();
    $locatario = $imovel->getLocatario();
    $tipoImovel = $this->contexto->get('tipoimovel');
    
    if(isset($qtQuartos) && $qtQuartos < 0){
      $erros['qtquartosnegativo'] = 'Campo qtde quartos deve ser um número positivo';
    }
    if(isset($qtQuartos) && !is_numeric($qtQuartos)){
      $erros['qtquartosfloat'] = 'Campo quarto deve ser um número inteiro';
    }
    if(isset($qtSuites) && $qtSuites < 0){
      $erros['qtsuitesnegativo'] = 'Campo qtde suítes deve ser um número positivo';
    }
    if(isset($qtSuites) && !is_numeric($qtSuites)){
      $erros['qtsuitesfloat'] = 'Campo qtde suítes deve ser um número inteiro';
    }
    if(isset($qtBanheiros) && $qtBanheiros < 0){
      $erros['qtbanheirosnegativo'] = 'Campo qtde banheiros deve ser um número positivo';
    }
    if(isset($qtBanheiros) && !is_numeric($qtBanheiros)){
      $erros['qtbanheirosfloat'] = 'Campo qtde banheiros deve ser um número inteiro';
    }
    if(empty($areaConstruida)){
      $erros['areaconstruida'] = 'Campo area construída é de preenchimento obrigatório';
    }
    if(isset($areaConstruida) && $areaConstruida < 1){
      $erros['areaconstruida'] = 'Campo area construida deve ser um número positivo maior que zero';
    }
    if(isset($areaConstruida) && !is_numeric($areaConstruida)){
      $erros['areaconstruida'] = 'Campo area construida deve ser um número inteiro';
    }
    if(strlen($endereco) < 5 || strlen($endereco) > 255){
      $erros['len'] = 'Endereço precisa ter entre 5 e 255 caractéres.';
    }
    if(strlen($bairro) < 5 || strlen($bairro) > 90){
      $erros['len2'] = 'Bairro precisa ter entre 5 e 90 caractéres.';
    }
    if($tipoImovel < 1){
      $erros['tipoimovel'] = "Selecione um tipo de imóvel.";
    }
    $tipo = $tipoModelo->getTipoImovelPeloId($tipoImovel);
    if(!isset($tipo)){
      $erros['tipoimovel'] = "Selecione um tipo de imóvel.";
    }
    
    $foto0 = $this->contexto->files->get('foto0');
    if(isset($foto0)){
      if($foto0->getSize() > 1000000){
        $erros['foto0'] = 'Foto 1 não pode ser maior que 1Mb';
      }
      $ext = strtolower(explode('/',$foto0->getClientMimeType())[1]);
      if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
        $erros['extensão1'] = 'Coloque somente fotos com a extensão jpg, jpeg ou png';
      }else{
        $fileName = '1-'.time().'.'.$ext;
        if($imovel->getFoto1() != null){
          $this->deleteImage($imovel->getFoto1());
        }
        if(move_uploaded_file($foto0->getPathName(), 'images/'.$fileName)){
          $imovel->setFoto1($fileName);
        }
      }
    }
    $foto1 = $this->contexto->files->get('foto1');
    if(isset($foto1)){
      if($foto1->getSize() > 1000000){
        $erros['foto1'] = 'Foto 2 não pode ser maior que 1Mb';
      }
      $ext = strtolower(explode('/',$foto1->getClientMimeType())[1]);
      if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
        $erros['extensão2'] = 'Foto 2, coloque somente fotos com a extensão jpg, jpeg ou png';
      }else{
        $fileName = '2-'.time().'.'.$ext;
        if($imovel->getFoto2() != null){
          $this->deleteImage($imovel->getFoto2());
        }
        if(move_uploaded_file($foto1->getPathName(), 'images/'.$fileName)){
          $imovel->setFoto2($fileName);
        }
      }
    }
    $foto2 = $this->contexto->files->get('foto2');
    if(isset($foto2)){
      if($foto2->getSize() > 1000000){
        $erros['foto2'] = 'Foto 3 não pode ser maior que 1Mb';
      }
      $ext = strtolower(explode('/',$foto2->getClientMimeType())[1]);
      if($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg'){
        $erros['extensão3'] = 'Foto 3, coloque somente fotos com a extensão jpg, jpeg ou png';
      }else{
        $fileName = '3-'.time().'.'.$ext;
        if($imovel->getFoto3() != null){
          $this->deleteImage($imovel->getFoto3());
        }
        if(move_uploaded_file($foto2->getPathName(), 'images/'.$fileName)){
          $imovel->setFoto3($fileName);
        }
      }
    }
    if(!empty($erros)){
      return $this->response->setContent($this->twig->render('imoveis/editar.php',['erros' => $erros,'tipos' => $tipoModelo->listar(),'locatario' => $locatario,'imovel' => $imovel]));
    }
    //print_r($this->contexto);
    //die();
    $imovel->setLocatario($locatario);
    $imovel->setTipoImovel($tipo);
    $imovelModelo->atualizar($imovel);
    if($imovelModelo){
      $destino = '/admin/imoveis';
      $redirecionar = new RedirectResponse($destino);
      $redirecionar->send();
    }else{
      $erros['ErroDB'] = "algo errado com o database...";
      return $this->response->setContent($this->twig->render('imoveis/novo.php',['erros' => $erros,'tipos' => $tipoModelo->listar(),'locatario' => $locatario,'imovel' => $imovel]));
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
