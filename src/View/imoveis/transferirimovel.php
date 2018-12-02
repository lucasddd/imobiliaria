{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Transferência de imóvel</h1>
	<div class="col-md-8 offset-md-2 form-horizontal">
		<form method="POST" action="/admin/imoveis/efetuartransferencia">
			<div class="form-group">
				<h4 class="text-center text-success">Informações do proprietário atual</h4>
				<input type="hidden" class="form-control" id="id" name="id_imovel" value="{{imovel.getId()}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Nome</span>
					</div>
					<input type="text" name="nome" class="form-control" readonly="true" value="{{imovel.getLocatario().getNome()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpf" class="form-control" readonly="" value="{{imovel.getLocatario().getCpf()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Tel.</span>
					</div>
					<input type="text" name="telefone" readonly="" class="form-control" value="{{imovel.getLocatario().getTelefone()}}" />
				</div>
				<hr style="color: black">
				<h4 class="text-center text-success">Informações do novo proprietário</h4>
				<input type="hidden" class="form-control" id="id_newLocatario" name="id_newLocatario" value="{{newLocatario.getId()}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Nome</span>
					</div>
					<input type="text" name="nomel" class="form-control" readonly="true" value="{{newLocatario.getNome()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpfl" class="form-control" readonly="" value="{{newLocatario.getCpf()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Tel.</span>
					</div>
					<input type="text" name="telefonel" readonly="" class="form-control" value="{{newLocatario.getTelefone()}}" />
				</div>
				<hr style="color: black">
				<h4 class="text-center text-success">Informações do imóvel</h4>

				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cod.</span>
					</div>
					<input type="text" readonly="" name="cod" class="form-control" value="{{imovel.getId()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Endereço</span>
					</div>
					<input type="text" readonly="" name="endereco" class="form-control" value="{{imovel.getEndereco()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Bairro</span>
					</div>
					<input type="text" readonly="" name="bairro" class="form-control" value="{{imovel.getBairro()}}"required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Tipo do imóvel </span>
					</div>
					<input type="text" readonly="" name="tipoimo" class="form-control" value="{{imovel.getTipoImovel().getDescricao()}}"required/>
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
