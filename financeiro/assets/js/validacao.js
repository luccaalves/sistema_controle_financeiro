//Validar Campos: Tela de Login.
function ValidarLogin() {
    if ($("#email").val().trim() == '') {
        alert("Preencher o Campo EMAIL!");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencher o Campo SENHA!");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6) {
        alert("A Senha deve Conter no Minimo 6 caracteres!");
        $("#senha").focus();
        return false;
    }
}
function ValidarCadastro() {
    if ($("#nome").val().trim() == '') {
        alert("Preencher o Campo NOME!");
        $("#nome").focus();
        return false;
    }
    if ($("#email").val().trim() == '') {
        alert("Preencher o Campo EMAIL!");
        $("#email").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencher o Campo SENHA!");
        $("#senha").focus();
        return false;
    }    
    if ($("#repsenha").val().trim() == '') {
        alert("Preencher o campo obrigatório REPETIR SENHA!");
        $("#repsenha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6) {
        alert("A Senha deve Conter no MINÍMO 6 caracteres!");
        $("#senha").focus();
        return false;
    }
    if ($("#repsenha").val().trim() != $("#senha").val().trim()) {
        alert("A Senhas Devem Ser IGUAIS!");
        $("#repsenha").focus();
        return false;
    }

}
function ValidarMeusDados() {
    //var nome = document.getElementById("nome").value;
    //var email = $("#email").val();

    if ($("#nome").val().trim() == '') {
        alert("Preencher o Campo NOME!");
        $("#nome").focus();
        return false;
    }

    if ($("#email").val().trim() == '') {
        alert("Preencher o Campo EMAIL!");
        $("#email").focus();
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencher o Campo SENHA!");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6) {
        alert("A Senha deve Conter no MINÍMO 6 caracteres!");
        $("#senha").focus();
        return false;
    }

}
function ValidarCategoria() {
    if ($("#nomecategoria").val().trim() == '') {
        alert("Preencher o Campo NOME DA CATEGORIA!");
        $("#nomecategoria").focus();
        return false;
    }
}
function ValidarEmpresa() {
    if ($("#nomeempresa").val().trim() == '') {
        alert("Preencher o campo NOME DA EMPRESA!");
        $("#nomemepresa").focus();
        return false;
    }
    /*if ($("#telefone").val().trim() == '') {
        alert("Preencher o campo TELEFONE/WHATSAPP!");
        $("#telefone").focus();
        return false;
    }
    if ($("#endereco").val().trim() == '') {
        alert("Preencher o campo ENDEREÇO!");
        $("#endereco").focus();
        return false;
    }*/
}
function ValidarConta() {
    if ($("#banco").val().trim() == '') {
        alert("Preencher o Campo NOME DO BANCO!");
        $("#banco").focus();
        return false;
    }
    if ($("#agencia").val().trim() == '') {
        alert("Preencher o Campo AGÊNCIA!");
        $("#agencia").focus();
        return false;
    }
    if ($("#numero").val().trim() == '') {
        alert("Preencher o Campo NUMERO DA CONTA!");
        $("#numero").focus();
        return false;
    }
    if ($("#saldo").val().trim() == '') {
        alert("Preencher o Campo SALDO DO BANCO!");
        $("#saldo").focus();
        return false;
    }
}
function ValidarMovimento() {
    if ($("#tipomov").val() == '') {
        alert("Selecione o TIPO DE MOVIMENTO!");
        $("#tipomov").focus();
        return false;
    }
    if ($("#data").val() == '') {
        alert("Selecione a DATA!");
        $("#data").focus();
        return false;
    }
    if ($("#valor").val() == '') {
        alert("Preencher o campo VALOR DO MOVIMENTO!");
        $("#valor").focus();
        return false;
    }
    if ($("#categoria").val() == '') {
        alert("Selecione a CATEGORIA!");
        $("#categoria").focus();
        return false;
    }
    if ($("#empresa").val() == '') {
        alert("Selecione o campo EMPRESA!");
        $("empresa").focus();
        return false
    }
    if ($("#conta").val() == '') {
        alert("Selecione o campo CONTA!");
        $("conta").focus();
        return false
    }
}
function ValidarConsultaPeriodo() {
    if ($("#datainicio").val().trim() == '') {
        alert("Selecione a DATA INICIAL!");
        $("datainicio").focus();
        return false
    }
    if ($("#datafinal").val().trim() == '') {
        alert("Selecione a DATA FINAL!");
        $("datafinal").focus();
        return false
    }
}