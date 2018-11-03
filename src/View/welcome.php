{% extends "master.twig"%}

{% block conteudo %}

<h1 class="text-center">Gerenciador de Imobiliária</h1>
<div class="row" style="max-height: 300px;">
    <div class="col-md-6 bg-secondary">
        <img src="/logo/imobiliaria.png" class="img-fluid float-right" style="max-height: 300px;">
    </div>
    <div class="col-md-6 well-lg bg-secondary">
        <form  class="form-group py-4" id="formLoginds" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email" class="text-white">Login</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" id="login" name="login" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="text-white">Senha</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input class="form-control" id="senha" name="senha" type="password">
                </div>
            </div>
            <div class="form-group">
                <div id="div_retorno" class="">
                    <p class="alert" style="font-weight: bold; weight: 100%;">&nbsp;</p>
                </div>
                <span class="btn btn-primary btn-block" id="btnLogin">Iniciar sessão <i class="fa fa-sign-in fa-fw"></i></span>
            </div>
            <br>
        </form>
    </div>
    <div class="col-12">
        <h4 class="text-center py-5">PROJETO PPI 2 - IFTM &copy {{"now"|date('Y')}} - Todos os direitos reservados.</h4>
    </div>
</div>
{% endblock  %}
{% block script_end %}
<script type="text/javascript">
    $("#btnLogin").on('click',function(){
        senha = $("#senha").val();
        login = $("#login").val();
        if(senha == "" || login == ""){
            $("#div_retorno p").text("Campo login e senha são de preenchimento obrigatório.");
            $("#div_retorno p").removeClass('alert-success');
            $("#div_retorno p").toggleClass('alert-danger');
            return;
        }
        //alert('oi');
        //$("#div_retorno").addClass('alert alert-warning text-danger');
        //$("#div_retorno span").text('asdasdf');
        //$("#div_retorno span").addClass('alert alert-danger text-danger');
        $.ajax({
            type: 'POST',
            url: '/login',
            data: {
                login: login,
                senha: senha,
            },
            success: function (dados) {
                //alert(dados);
                $("#div_retorno p").text("Aguarde. Iniciando sessão...");
                $("#div_retorno p").removeClass('alert-danger');
                $("#div_retorno p").toggleClass('alert-success');
                setTimeout(function(){
                    $("#btnLogin").children().removeClass('fa-spinner fa-spin');
                    $("#btnLogin").children().addClass('fa-sign-in');
                    window.location.href="/";
                },2000);
                /*if(dados == "errologin"){
                    $("#div_retorno").html("Usuário ou senha inválido.");
                }else if(dados == "admin"){
                    window.location.href = "/admin";
                }else if(dados == "cliente"){
                    window.location.href = "/agenda";
                }else{
                    window.location.href = "/";
                }
                */
            },
            beforeSend: function () {
                $("#btnLogin").children().removeClass('fa-sign-in');
                $("#btnLogin").children().addClass('fa-spinner fa-spin');
            },
            complete: function (dados) {
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });

});
</script>
{% endblock  %}
