{% extends "master.twig"%}
{% block conteudo %}
<div class="col-md-12">
	<h4 class="text-center text-success">.:: Tipos de cliente ::.</h4>
	<div class="table-responsive">
		<table id="table" class="table table-sm table-striped table-condensed table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr style="" class="bg-dark text-white">
					<th class="text-center">Id</th>
					<th class="text-center">Descrição</th>
					<th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody id="conteudotipocliente">
				{% for tipocliente in tipoclientes %}
				<tr>
					<td>{{tipocliente.id}}</td>
					<td>{{tipocliente.descricao}}</td>
					<td>
						<a href="/admin/tiposcliente/editar/{{tipocliente.id}}" class="btn btn-warning fa fa-pencil btn-xs"></a>
					</td>
				</tr>
				{% endfor %}
			</tbody>

		</table>
		<div class="form-group">
			<div class="text-danger">
				<div id="div_retorno">
					&nbsp;
				</div>
			</div>
		</div>
		<div id="processando" style="display: none;">
			<img src="/img/ajax-loader.gif" />
		</div>
		<span id ="detalhestipocliente" class="">{{tipoclientes|length}} tipos de clientes cadastrado(s).</span>
	</div>


</div>
{% endblock  %}