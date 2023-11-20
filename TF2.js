//parte ajax
$.ajax({
        method: "POST",
        url: "index.php", "login.php", "cadastroUsuario.php", "edicao.php", "listaUsuarios.php", "perfil.php"
        data: $('form').serialize(),
            success : function(data){
            alert("Deu certo! <br>" + data);
        },
        error: function (errorMessage) {
            alert("Deu erro! <br>" + errorMessage);
        }
});

//parte JavaScript para login
$(function () {
    const $formLogin = $("#formLogin");

    $formLogin.on("submit", emBrancoLogin);

    function emBrancoLogin(e) {
        e.preventDefault();
        var email = $("#email1").val();
        var senha = $("#senha1").val();
        var alerta = $("#alerta1");
        var alerta2 = $("#alerta2");


        alerta.text("");
        alerta2.text("");

        if (email == "") {
            $("#email1").css("borderColor", "red");
            alerta.text("O campo Email deve ser preenchido.");
            alerta.css("color", "red");
            alerta.removeClass("display d-none").addClass("visible");
        }
        if (senha == "") {
            $("#senha1").css("borderColor", "red");
            alerta2.text("O campo Senha deve ser preenchido.");
            alerta2.css("color", "red");
            alerta2.removeClass("display d-none").addClass("visible");
        }
    }
});

//parte JavaScript para página de cadastro
$(document).ready(function () {
    const $formCadastro = $("#formCadastro");
    $formCadastro.on("submit", emBrancoCadastro);

    function emBrancoCadastro(e) {
        e.preventDefault();
        var nome = $("#nome").val();
        var dtnasc = $("#date").val();
        var cpf = $("#cpf").val();
        var telefone = $("#telefone").val();
        var email = $("#emailCadastro").val();
        var senha = $("#senhaCadastro").val();
        var senhaConfirmacao = $("#senhaConfirmacao").val();
        var alerta = $("#alerta1");
        var alerta2 = $("#alerta2");
        var alerta3 = $("#alerta3");
        var alerta4 = $("#alerta4");
        var alerta5 = $("#alerta5");
        var alerta6 = $("#alerta6");
        var alerta7 = $("#alerta7");
        var alerta8 = $("#alerta8");
        var alerta9 = $("#alerta9");

        alerta.text(""); alerta2.text(""); alerta3.text(""); alerta4.text(""); alerta5.text(""); alerta6.text(""); alerta7.text("");
        alerta8.text(""); alerta9.text("");

        if (nome == "") {
            $("#nome").css("borderColor", "red");
            alerta.text("O campo Nome Completo deve ser preenchido.");
            alerta.css("color", "red");
            alerta.removeClass("display d-none").addClass("visible");
        }
        if (dtnasc == "") {
            $("#dtnasc").css("borderColor", "red");
            alerta2.text("O campo Data de Nascimento deve ser preenchido.");
            alerta2.css("color", "red");
            alerta2.removeClass("display d-none").addClass("visible");
        }
        if (cpf == "") {
            $("#cpf").css("borderColor", "red");
            alerta3.text("O campo CPF deve ser preenchido.");
            alerta3.css("color", "red");
            alerta3.removeClass("display d-none").addClass("visible");
        }
        if (telefone == "") {
            $("#telefone").css("borderColor", "red");
            alerta4.text("O campo Telefone deve ser preenchido.");
            alerta4.css("color", "red");
            alerta4.removeClass("display d-none").addClass("visible");
        }
        if (email == "") {
            $("#emailCadastro").css("borderColor", "red");
            alerta5.text("O campo Email deve ser preenchido.");
            alerta5.css("color", "red");
            alerta5.removeClass("display d-none").addClass("visible");
        }
        if (senha == "") {
            $("#senhaCadastro").css("borderColor", "red");
            alerta6.text("O campo Senha deve ser preenchido.");
            alerta6.css("color", "red");
            alerta6.removeClass("display d-none").addClass("visible");
        }
        if (senhaConfirmacao == "") {
            $("#senhaConfirmacao").css("borderColor", "red");
            alerta7.text("O campo Confirme Sua Senha deve ser preenchido.");
            alerta7.css("color", "red");
            alerta7.removeClass("display d-none").addClass("visible");
        }
        if(senha != senhaConfirmacao){
            $("#senhaCadastro").css("borderColor", "yellow");
            $("#senhaConfirmacao").css("borderColor", "yellow");
            alerta8.text("As duas senhas digitadas devem ser iguais.");
            alerta8.css("color", "yellow");
            alerta8.removeClass("display d-none").addClass("visible");
        }
    }


    $(function() {
        $("#date").datepicker({
            dateFormat: 'yyyy-mm-dd' // Define o formato desejado para a data
        });
    });
});

//parte JavaScript da página index
$(function () {
    //Escondendo os campos de consumo
    $("#consumoEletricidadeCalculadora").hide();
    $("#consumoCombustivelCalculadora").hide();

    //Adicionando evento de mudança aos inputs de radio
    $("input[name='flexRadioDefault']").change(function() {
        if ($("#energiaCalculadora").is(":checked")) {
            $("#consumoEletricidadeCalculadora").show();
            $("#consumoCombustivelCalculadora").hide();
        } else {
            $("#consumoCombustivelCalculadora").show();
            $("#consumoEletricidadeCalculadora").hide();
        }
    });

    const $formCalculadora = $("#formCalculadora");
    $formCalculadora.on("submit", emBrancoCalculadora);

    function emBrancoCalculadora(e) {
        e.preventDefault();
        var energia = $("#energiaCalculadora").is(":checked");
        var combustivel = $("#combustivelCalculadora").is(":checked");
        var distancia = $("#distanciaCalculadora").val();
        var consumoEletricidade = $("#inputConsumoEletricidadeCalculadora").val();
        var consumoCombustivel = $("#inputConsumoCombustivelCalculadora").val();
        var alerta = $("#alerta1");
        var alerta2 = $("#alerta2");
        var alerta3 = $("#alerta3");

        alerta.text(""); alerta2.text(""); alerta3.text("");

        if (!energia && !combustivel) {
            alerta.text("Você deve selecionar o que seu veículo utiliza.");
            alerta.css("color", "red");
            alerta.removeClass("display d-none").addClass("visible");
        }else if(energia){
            if (distancia == "") {
                $("#distanciaCalculadora").css("borderColor", "red");
                alerta2.text("O campo Distância deve ser preenchido.");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
            if (consumoEletricidade == "") {
                $("#consumoEletricidadeCalculadora").addClass("input-error");
                alerta3.text("O campo Consumo de Eletricidade deve ser preenchido.");
                alerta3.css("color", "red");
                alerta3.removeClass("display d-none").addClass("visible");

            } 
        }else{
            if (distancia == "") {
                $("#distanciaCalculadora").css("borderColor", "red");
                alerta2.text("O campo Distância deve ser preenchido.");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
            if (consumoCombustivel == "") {
                $("#consumoCombustivelCalculadora").addClass("input-error");
                alerta3.text("O campo Consumo Médio do veículo deve ser preenchido.\n");
                alerta3.css("color", "red");
                alerta3.removeClass("display d-none").addClass("visible");
            }
        }
    }
});

//parte JavaScript para página de listaVeiculos
$(document).ready(function () {
    //Lidar com o clique do botão Excluir
    $(".botaoExcluir").click(function () {
        //Encontre o elemento pai (li) e remova-o
        $(this).parent().parent().remove(); //reorganizando a lista
    });

    //busca na listaVeiculos
    $("#busca").on("keyup", function() {
        //evento keyup detecta quando algo é digitado
        var textoBusca = $(this).val().toLowerCase(); //Obtendo o texto de busca e convertendo para minúsculas
        $(".listaVeiculos li").each(function() {    
        //each passa por cada elemento da lista
            var item = $(this).text().toLowerCase(); // Obtenha o texto de cada item da lista em minúsculas
            if (item.indexOf(textoBusca) === -1) {
            //indexOf compara até achar os itens e retorna -1 caso não ache
                $(this).hide(); // Oculte os itens que não correspondem à busca
            } else {
                $(this).show(); // Mostre os itens que correspondem à busca
            }
        });
    });
});

//parte JavaScript para página perfil
$(function () {
    //Escondendo os campos de consumo
    $("#consumoEletricidadePerfil").hide();
    $("#consumoCombustivelPerfil").hide();
    $("#tipoCombustivelPerfilDiv").hide();

    //Adicionando evento de mudança aos inputs de radio
    $("input[name='flexRadioDefault']").change(function() {
        if ($("#energiaPerfil").is(":checked")) {
            $("#tipoCombustivelPerfilDiv").hide();
            $("#consumoCombustivelPerfil").hide();
            $("#consumoEletricidadePerfil").show();
        } else {
            $("#tipoCombustivelPerfilDiv").show();
            $("#consumoCombustivelPerfil").show();
            $("#consumoEletricidadePerfil").hide();
        }
    });


    const $formPerfil = $("#formPerfil");
    $formPerfil.on("submit", emBrancoPerfil);

    function emBrancoPerfil(e) {
        e.preventDefault();
        var energia = $("#energiaPerfil").is(":checked");
        var combustivel = $("#combustivelPerfil").is(":checked");
        var modelo = $("#modeloPerfil").val();
        var tipoCombustivel = $("#tipoCombustivelPerfilDiv").val();
        var consumoEletricidade = $("#inputConsumoEletricidadePerfil").val();
        var consumoCombustivel = $("#inputConsumoCombustivelPerfil").val();
        var alerta = $("#alerta1");
        var alerta2 = $("#alerta2");
        var alerta3 = $("#alerta3");
        var alerta4 = $("#alerta4");

        alerta.text(""); alerta2.text(""); alerta3.text(""); alerta4.text("");

        if (!energia && !combustivel) {
            alerta.text("Você deve selecionar o que seu veículo utiliza.");
            alerta.css("color", "red");
            alerta.removeClass("display d-none").addClass("visible");
        }else if(energia){
            if (modelo == "") {
                $("#modeloPerfil").css("borderColor", "red");
                alerta2.text("O campo Modelo deve ser preenchido.");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
            if (consumoEletricidade == "") { //*
                $("#consumoEletricidadePerfil").addClass("input-error");
                alerta3.text("O campo Consumo de Eletricidade deve ser preenchido.");
                alerta3.css("color", "red");
                alerta3.removeClass("display d-none").addClass("visible");
            }
        }else{
            if (modelo == "") {
                $("#modeloPerfil").css("borderColor", "red");
                alerta2.text("O campo Modelo deve ser preenchido.");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
            if (consumoCombustivel == "") {
                $("#consumoCombustivelPerfil").addClass("input-error");
                alerta3.text("O campo Consumo Médio deve ser preenchido.");
                alerta3.css("color", "red");
                alerta3.removeClass("display d-none").addClass("visible");
            }
            if (tipoCombustivel == "") {
                $("#tipoCombustivelPerfilDiv").addClass("input-error");
                alerta4.text("Você não selecionou nada no campo Tipo de Combustível.");
                alerta4.css("color", "red");
                alerta4.removeClass("display d-none").addClass("visible");
            }
        }
    }
});

//parte JavaScript página para edicao
$(document).ready(function(){
    //Escondendo os campos de consumo
    $("#consumoEletricidadeEdicao").hide();
    $("#consumoCombustivelEdicao").hide();
    $("#tipoCombustivelEdicaoDiv").hide();

    //Adicionando evento de mudança aos inputs de radio
    $("input[name='flexRadioDefault']").change(function() {
        if ($("#energiaEdicao").is(":checked")) {
            $("#tipoCombustivelEdicaoDiv").hide();
            $("#consumoCombustivelEdicao").hide();
            $("#consumoEletricidadeEdicao").show();
        } else {
            $("#tipoCombustivelEdicaoDiv").show();
            $("#consumoCombustivelEdicao").show();
            $("#consumoEletricidadeEdicao").hide();
        }
    });
    
    const $formEditarVeiculo = $("#formEditarVeiculo");
    $formEditarVeiculo.on("submit", emBrancoEditar);

    function emBrancoEditar(e) {
        e.preventDefault();
        var energia = $("#energiaEdicao").is(":checked");
        var combustivel = $("#combustivelEdicao").is(":checked");
        var tipoCombustivel = $("#tipoCombustivelEdicaoDiv").val();
        var consumoEletricidade = $("#inputConsumoEletricidadeEdicao").val();
        var consumoCombustivel = $("#inputConsumoCombustivelEdicao").val();
        var alerta = $("#alerta1");
        var alerta2 = $("#alerta2");
        var alerta3 = $("#alerta3");

        alerta.text(""); alerta2.text(""); alerta3.text("");

        if (!energia && !combustivel) {
            alerta.text("Você deve selecionar o que seu veículo utiliza.");
            alerta.css("color", "red");
            alerta.removeClass("display d-none").addClass("visible");
        }else if(energia){
            if (consumoEletricidade == "") {
                $("#consumoEletricidadeEdicao").addClass("input-error");
                alerta2.text("O campo Consumo de Eletricidade deve ser preenchido.");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
        }else{
            if (consumoCombustivel == "") {
                $("#consumoCombustivelEdicao").addClass("input-error");
                alerta2.text("O campo Consumo Médio do veículo deve ser preenchido.\n");
                alerta2.css("color", "red");
                alerta2.removeClass("display d-none").addClass("visible");
            }
            if (tipoCombustivel == "") {
                $("#tipoCombustivelEdicaoDiv").addClass("input-error");
                alerta3.text("Você não selecionou nada no campo Tipo de Combustível.");
                alerta3.css("color", "red");
                alerta3.removeClass("display d-none").addClass("visible");
            }
        }
    }
});

//parte JavaScript página para listaUsuarios
$(document).ready(function () {
    //Lidar com o clique do botão Excluir
    $(".botaoExcluirUsuario").click(function () {
        //Encontre o elemento pai (li) e remova-o
        $(this).parent().parent().remove(); //reorganizando a lista
    });
});