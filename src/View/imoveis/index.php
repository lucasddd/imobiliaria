{% extends "master.twig"%}
{% block conteudo %}
<div class="col-md-12">
	<h4 class="text-center text-success">.:: Lista de imoveis ::.</h4>
	<div class="row">
		<div class="col-md-6">
			<a href="/admin/imoveis/informecpf" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
		</div>
		<div class="col-md-6">
			<form action="/admin/imoveis" method="GET">
				<input type="text" class="form-control" name="busca" maxlength="50"  placeholder="Pesquisa" autofocus>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table id="table" class="table table-sm table-striped table-condensed table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr style="" class="bg-dark text-white">
					<th class="text-center">Id</th>
					<th class="text-center">Endereço</th>
					<th class="text-center">Bairro</th>
					<th class="text-center">Locatário</th>
					<th class="text-center">Valor Locação</th>
					<th class="text-center">Locador</th>
					<th class="text-center">Ações</th>
				</tr>
			</thead>
			<tbody id="conteudoimoveis">
				{% for imovel in imoveis %}
				<tr>
					<td>{{imovel.getId()}}</td>
					<td>{{imovel.getEndereco()}}</td>
					<td>{{imovel.getBairro()}}</td>
					<td>{{imovel.getLocatario().getNome()}}</td>
					<td>{{imovel.getValorLocacao()}}</td>
					<td>
					{% if(imovel.getLocador()) %}

					{{imovel.getLocador().getNome()}}
					{% else %}
					<form class="" action="/admin/imoveis/alugar_informecpf" method="POST">
						<input type="hidden" value="{{imovel.getId()}}" name="id_imovel">
						<button type="submit" class="btn btn-dark btn-md" data-toggle="tooltip" data-placement="top" title="Alugar"><i class="fa fa-plus" ></i></button>
					</form>
					{% endif %}
					</td>
					<td class="">
						<a href="/admin/imoveis/editar/{{imovel.id}}" class="btn btn-xs btn-warning fa fa-pencil btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"></a>
						<a href="/admin/imoveis/show/{{imovel.id}}" class="btn btn-xs btn-info fa fa-eye btn-xs" data-toggle="tooltip" data-placement="top" title="Visualizar"></a>
						<form class="" action="/admin/imoveis/transferir_informecpf" method="POST">
							<input type="hidden" value="{{imovel.getId()}}" name="id_imovel">
							<button type="submit" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top" title="Transferir"><i class="fa fa-exchange" ></i></button>
						</form>
						{% if(not imovel.imovelPossuiLocacoes()) %}
						<form class="" action="/admin/imoveis/delete" method="POST">
							<input type="hidden" value="{{imovel.getId()}}" name="id_imovel">
							<button type="submit" class="btn btn-danger btn-md" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fa fa-trash" ></i></button>
						</form>
						{% endif %}
						
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
		<span id ="detalhesimovel" class="">{{imoveis|length}} imovel(is) cadastrados.</span>
	</div>


</div>
{% endblock  %}