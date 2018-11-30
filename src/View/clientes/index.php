{% extends "master.twig"%}
{% block conteudo %}
<div class="col-md-12">
	<h4 class="text-center text-success">.:: Lista de Clientes ::.</h4>
	<div class="row">
		<div class="col-md-6">
			<a href="/admin/cliente/novo" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
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
			<tbody id="conteudocliente">
				{% for cliente in clientes %}
				<tr>
					<td>{{cliente.id}}</td>
					<td>{{cliente.nome}}</td>
					<td>{{cliente.cpf}}</td>
					<td>{{cliente.telefone}}</td>
					<td>
						<form method="POST" action="/admin/imoveis/novo">
							<input type="hidden" name="cpf" value="{{cliente.cpf}}">
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-plus"></i></button>
						</form>
					</td>
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
		<span id ="detalhescliente" class="">{{clientes|length}} cliente(s) cadastrados.</span>
	</div>


</div>
{% endblock  %}