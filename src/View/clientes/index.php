{% extends "master.twig"%}
{% block conteudo %}
<div class="col-md-12">
	<h1 class="text-center text-success">.:: Lista de Clientes ::.</h1>
	<div class="row">
		<div class="col-md-6">
			<a href="/admin/tiposcliente/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
		</div>
		<div class="col-md-6">
			<form action="/admin/clientes" method="GET">
			<input type="text" class="form-control" name="busca" maxlength="50"  placeholder="Pesquisa" autofocus>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table id="table" class="table table-sm table-striped table-condensed table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr style="" class="bg-dark text-white">
					<th class="text-center">Id</th>
					<th class="text-center">Cliente</th>
					<th class="text-center">CPF</th>
					<th class="text-center">Telefone</th>
					<th class="text-center">Locatário?</th>
					<th class="text-center">Locador?</th>
					<th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody id="conteudocateg">
				{% for cliente in clientes %}
				<tr>
					<td>{{cliente.id}}</td>
					<td>{{cliente.nome}}</td>
					<td>{{cliente.cpf}}</td>
					<td>{{cliente.telefone}}</td>
					<td>locatário</td>
					<td>locador</td>
					<td>
						<a href="/admin/cliente/editar/{{cliente.id}}" class="btn btn-warning fa fa-pencil btn-xs"></a>
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
		<span id ="detalhescliente" class="">Total de: {{clientes|length}} registro(s).</span>
	</div>


</div>
{% endblock  %}