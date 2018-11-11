{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Editar Tipo de Cliente</h1>
	<div class="col-md-6 offset-md-3 form-horizontal">
		<form method="POST" action="/admin/tiposcliente/atualizar">
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
				<input type="hidden" class="form-control" id="id" name="id" value="{{tipocliente.id}}">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Descrição</span>
					</div>
					<input type="text" name="descricao" class="form-control" value="{{tipocliente.descricao}}" required autofocus/>
				</div>
			</div>
			<div class="text-center">
				<button class="btn btn-success" id="btnSalvarTipoCliente">Salvar</button>
				<a href="/admin/tiposcliente" class="btn btn-danger">Cancelar</a>
				<div id="processando" style="display: none;">
					<img src="/img/ajax-loader.gif" />
				</div>
			</div>
		</form>
	</div>
</div>

{% endblock  %}
