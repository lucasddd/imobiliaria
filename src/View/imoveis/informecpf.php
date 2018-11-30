{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Informe o cpf do proprietário (locatário)</h1>
	<div class="col-md-6 offset-md-3 form-horizontal">
		<form method="POST" action="/admin/imoveis/novo">
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
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">CPF</span>
					</div>
					<input type="text" name="cpf" class="form-control" required/>
				</div>
			<div class="text-center">
				<button class="btn btn-success" id="btnSalvarTipoCliente">Continuar</button>
				<a href="/admin/clientes" class="btn btn-danger">Cancelar</a>
				<div id="processando" style="display: none;">
					<img src="/img/ajax-loader.gif" />
				</div>
			</div>
		</form>
	</div>
</div>

{% endblock  %}
