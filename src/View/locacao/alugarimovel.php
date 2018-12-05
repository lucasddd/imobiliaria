{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Locação de imóvel</h1>
	<div class="col-md-8 offset-md-2 form-horizontal">
		<form method="POST" action="/admin/imoveis/aluguelimovel_salvar">
			<div class="form-group">
				<div class="form-group">
					<div class="text-danger">
						{% if(erros) %}
						<div class="alert alert-danger">
							<strong class="text-center">Seu formulário contem erros.</strong><br>
							{% for erro in erros %}
							<small><li>{{erro}}</li></small>
							{% endfor %}
						</div>
						{% endif %}
					</div>
				</div>
				<h4 class="text-center text-success">Informações do locador</h4>
				<input type="hidden" class="form-control" id="id" name="id_locador" value="{{locacao.getLocador().getId()}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Nome</span>
					</div>
					<input type="text" name="nome" class="form-control" readonly="true" value="{{locacao.getLocador().getNome()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpf" class="form-control" readonly="" value="{{locacao.getLocador().getCpf()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Tel.</span>
					</div>
					<input type="text" name="telefone" readonly="" class="form-control" value="{{locacao.getLocador().getTelefone()}}" />
				</div>
				<hr style="color: black">
				<h4 class="text-center text-success">Informações do imóvel</h4>
				<input type="hidden" class="form-control" id="id" name="id_imovel" value="{{locacao.getImovel().getId()}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cod.</span>
					</div>
					<input type="text" readonly="" name="cod" class="form-control" value="{{locacao.getImovel().getId()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Endereço</span>
					</div>
					<input type="text" readonly="" name="endereco" class="form-control" value="{{locacao.getImovel().getEndereco()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Bairro</span>
					</div>
					<input type="text" readonly="" name="bairro" class="form-control" value="{{locacao.getImovel().getBairro()}}"required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Tipo do imóvel </span>
					</div>
					<input type="text" readonly="" name="tipoimo" class="form-control" value="{{locacao.getImovel().getTipoImovel().getDescricao()}}"required/>
				</div>
				<hr style="color: black">
				<h4 class="text-center text-success">Detalhes de pagamento.</h4>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Valor aluguel</span>
					</div>
					<input type="number" step="any" name="valorlocacao" class="form-control" value="{{locacao.getImovel().getValorLocacao()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Comissão/taxa administração.</span>
					</div>
					<input type="number" step="any" name="comissao" class="form-control" value="{{imovel.getValorComissao()}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Dia de vencto.</span>
					</div>
					<input type="number" step="1" name="diavencimento" class="form-control" value="{{locacao.getDiaVencimento()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Dia de repasse.</span>
					</div>
					<input type="number" step="1" name="diarepasse" class="form-control" value="{{locacao.getDiaRepasse()}}"/>
				</div>
			</div>
			<div class="text-center">
				<button class="btn btn-primary" id="btnSalvarTipoCliente">Confirmar</button>
				<a href="/admin/imoveis" class="btn btn-danger">Voltar</a>
				<div id="processando" style="display: none;">
					<img src="/img/ajax-loader.gif" />
				</div>
			</div>
		</form>
	</div>
</div>

{% endblock  %}
