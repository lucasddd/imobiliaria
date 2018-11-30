{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Novo imóvel</h1>
	<div class="col-md-8 offset-md-2 form-horizontal">
		<form method="POST" action="/admin/imoveis/salvar" accept-charset="UTF-8" enctype="multipart/form-data">
			<div class="form-group">
				<h4 class="text-center text-success">Informações do proprietário (locatário)</h4>
				<input type="hidden" class="form-control" id="id" name="id" value="{{locatario.getId()}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Nome</span>
					</div>
					<input type="text" name="nome" class="form-control" readonly="true" value="{{locatario.getNome()}}" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpf" class="form-control" readonly="" value="{{locatario.getCpf()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Tel.</span>
					</div>
					<input type="text" name="telefone" readonly="" class="form-control" value="{{locatario.getTelefone()}}" />
				</div>
				<hr style="color: black">
				<h4 class="text-center text-success">Informações do imóvel</h4>
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
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Endereço</span>
					</div>
					<input type="text" name="endereco" class="form-control" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Bairro</span>
					</div>
					<input type="text" name="bairro" class="form-control" required/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Tipo do imóvel </span>
					</div>
					<select name="tipoimovel" class="btn btn-secondary">
						<option value="0">Selecione *</option>
						{% for tipo in tipos %}
						<option value="{{tipo.getId()}}">{{tipo.getDescricao()}}</option>
						{% endfor %}
					</select>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Valor Locação</span>
					</div>
					<input type="text" name="valorlocacao" class="form-control" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Valor Venda</span>
					</div>
					<input type="text" name="valorvenda" class="form-control"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Foto 1 </span>
					</div>
					<input type="text" name="cep" class="form-control"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Foto 2 </span>
					</div>
					<input type="text" name="cep" class="form-control"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Foto 3 </span>
					</div>
					<input type="text" name="cep" class="form-control"/>
				</div>
			</div>
			<div class="text-center">
				<button class="btn btn-success" id="btnSalvarTipoCliente">Salvar</button>
				<a href="/admin/clientes" class="btn btn-danger">Cancelar</a>
				<div id="processando" style="display: none;">
					<img src="/img/ajax-loader.gif" />
				</div>
			</div>
		</form>
	</div>
</div>

{% endblock  %}
