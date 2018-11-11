{% extends "master.twig"%}
{% block conteudo %}
<div class="col-md-12">
	<h4 class="text-center text-success">.:: Tipos de cliente ::.</h4>
	<div class="row">
		<div class="col-md-6">
			<a href="/admin/tiposcliente/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
		</div>
		<div class="col-md-6">
			<form action="/admin/tiposcliente" method="GET">
			<input type="text" class="form-control" name="busca" maxlength="50"  placeholder="Pesquisa" autofocus>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table id="table" class="table table-sm table-striped table-condensed table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr style="" class="bg-dark text-white">
					<th class="text-center">Id</th>
					<th class="text-center">Descrição</th>
					<th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody id="conteudocateg">
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
		<span id ="detalhestipocliente" class="">Total de: {{tipoclientes|length}} registro(s).</span>
	</div>


</div>
{% endblock  %}