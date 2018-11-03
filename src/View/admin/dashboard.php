{% extends "master.twig"%}

{% block conteudo %}

<h1 class="text-center">Bem vindo ao painel administrativo</h1>

<div class="row">
    <div class="col-md-6">
        <img src="/logo/dashboard.jpg" class="img-fluid" style="height:350px">
    </div>
    <div class="col-md-6">
        <img src="/logo/imobiliaria.png" class="img-fluid" style="height:350px">
    </div>
</div>
<div id="div_retorno">
</div>
<div id="processando" style="display: none;">
    <img src="img/ajax-loader.gif" />
</div>

{% endblock  %}
