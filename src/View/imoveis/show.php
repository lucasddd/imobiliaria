{% extends "master.twig"%}

{% block conteudo %}

<div class="col-md-12">
	<h1 class="text-center text-success">Visualizar imóvel</h1>
	<div class="col-md-8 offset-md-2 form-horizontal">
		<form method="" action="">
			<div class="form-group">
				<h4 class="text-center text-success">Informações do proprietário (locatário)</h4>
				<input type="hidden" class="form-control" id="id" name="id" value="{{imovel.getId()}}">
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
				<h4 class="text-center text-success">Informações do imóvel</h4>
			
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
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Qtde Quartos</span>
					</div>
					<input type="number" readonly="" name="qtquartos" class="form-control" value="{{imovel.getQtQuartos()}}"/>
					<div class="input-group-prepend">
						<span class="input-group-text">Qtde Suítes</span>
					</div>
					<input type="number" readonly="" name="qtsuites" class="form-control" value="{{imovel.getQtSuites()}}"/>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Qtde Banheiros</span>
					</div>
					<input type="number" readonly="" name="qtbanheiros" class="form-control" value="{{imovel.getQtBanheiros()}}"/>
					<div class="input-group-prepend">
						<span class="input-group-text">Area Construída(m²)</span>
					</div>
					<input type="number" readonly="" step="any" placeholder="0.00" name="areaconstruida" class="form-control" value="{{imovel.getAreaConstruida()}}"/>
				</div>
				<div class="form-group">
					<label for="obs" class="control-label">Observações: </label>
					<textarea readonly="" class="form-control" placeholder="" name="obs" cols="50" rows="3" id="obs">{{imovel.getObs()}}</textarea>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Valor Locação</span>
					</div>
					<input type="text" readonly="" name="valorlocacao" class="form-control" value="{{imovel.getValorLocacao()}}" required/>
					<div class="input-group-prepend">
						<span class="input-group-text">Valor Venda</span>
					</div>
					<input type="text" readonly="" name="valorvenda" class="form-control" value="{{imovel.getValorVenda()}}"/>
				</div>
				<div class="{{imovel.getFoto1() ? '' : 'input-group '}}form-group">
					<div class="{{imovel.getFoto1() ? '' : 'input-group-prepend'}}">
						<span class="input-group-text">Foto 1 </span>
					</div>
					{% if(imovel.getFoto1()) %}
					<a target="_blank" href="/images/{{imovel.getFoto1()}}" class="">
						<img src="/images/{{imovel.getFoto1()}}" width="250px" height="150px">
					</a>
					{% endif %}
				</div>
				<div class="{{imovel.getFoto2() ? '' : 'input-group '}}form-group">
					<div class="{{imovel.getFoto2() ? '' : 'input-group-prepend'}}">
						<span class="input-group-text">Foto 2 </span>
					</div>
					{% if(imovel.getFoto2()) %}
					<a target="_blank" href="/images/{{imovel.getFoto2()}}" class="">
						<img src="/images/{{imovel.getFoto2()}}" width="250px" height="150px">
					</a>
					{% endif %}
				</div>
				<div class="{{imovel.getFoto3() ? '' : 'input-group '}}form-group">
					<div class="{{imovel.getFoto3() ? '' : 'input-group-prepend'}}">
						<span class="input-group-text">Foto 3 </span>
					</div>
					{% if(imovel.getFoto3()) %}
					<a target="_blank" href="/images/{{imovel.getFoto3()}}" class="">
						<img src="/images/{{imovel.getFoto3()}}" width="250px" height="150px">
					</a>
					{% endif %}
				</div>
			</div>
			<div class="text-center">
				<a href="/admin/imoveis" class="btn btn-danger">Voltar</a>
				<div id="processando" style="display: none;">
					<img src="/img/ajax-loader.gif" />
				</div>
			</div>
		</form>
	</div>
</div>

{% endblock  %}
