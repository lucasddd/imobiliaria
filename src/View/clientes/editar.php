{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Atualizar cliente</h1>
	<div class="col-md-6 offset-md-3 form-horizontal">
		<form method="POST" action="/admin/cliente/atualizar">
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
				<input type="hidden" class="form-control" id="id" name="id" value="{{cliente.id}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Nome</span>
					</div>
					<input type="text" name="nome" class="form-control" required value="{{cliente.nome}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpf" class="form-control" value="{{cliente.cpf}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">RG</span>
					</div>
					<input type="text" name="rg" class="form-control" value="{{cliente.rg}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Tel.</span>
					</div>
					<input type="text" name="telefone" class="form-control" value="{{cliente.telefone}}"/>
					<div class="input-group-prepend">
						<span class="input-group-text">Nasc.</span>
					</div>
					<input type="date" name="datanascimento" class="form-control" value="{{cliente.datanascimento}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Endereço</span>
					</div>
					<input type="text" name="endereco" class="form-control" value="{{cliente.endereco}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Bairro</span>
					</div>
					<input type="text" name="bairro" class="form-control" value="{{cliente.bairro}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cidade</span>
					</div>
					<input type="text" name="cidade" class="form-control" value="{{cliente.cidade}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Cep</span>
					</div>
					<input type="text" name="cep" class="form-control" value="{{cliente.cep}}"/>
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
