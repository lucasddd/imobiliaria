{% extends "master.twig"%}

{% block conteudo %}

<h1 class="text-center">Bem vindo ao painel administrativo</h1>

<div class="row">
    <div class="col-md-8 offset-2">
        <img src="/logo/dashboard.jpg" class="img-fluid" style="width: 100%; height: 400px;">
    </div>
</div>
<div id="div_retorno">
</div>
<div id="processando" style="display: none;">
    <img src="img/ajax-loader.gif" />
</div>

{% endblock  %}
