function alteraSenha() {
    $.ajax({
        type: "POST",
        url: "modalalteraSenha.php",
        data: {
            nomeProduto: $('#nomeProduto').val()
	},
	success: function(data) {
        $('#altera-senha').html(data);
	}
    });
}

function formVisitante(idvs) {
    
    var idvs = idvs;
    
    $.ajax({
        type: "POST",
        url: "divModalFormVisitante.php",
        data: {
            idvs: idvs
	},
	success: function(data) {
        $('#modal-form-visitante').html(data);
	}
    });
}

function pesquisaVisitanteCheckin(){
    $.ajax({
        type: "POST",
        url: "pesquisaCheckin.php",
        data: {
            nome: $('#nomePesq').val(),
            cpf: $('#cpfPesq').val()
	},
	success: function(data) {
        $('#retPesquisa').html(data);
	}
    });
}
function onLoadCheckin(cpf){
    console.log("chamou");
    var cpf = cpf;
    console.log(cpf);
    $.ajax({
        type: "POST",
        url: "pesquisaCheckin.php",
        data: {
            cpf: cpf
	},
	success: function(data) {
            
        $('#retPesquisa').html(data);
	}
    });
}    

function pesquisaVisitante(){
    
    var rads = document.getElementsByName('sexop');
    
    for(var i = 0; i < rads.length; i++){
        if(rads[i].checked){
            var sexo = rads[i].value;
        }else{
            var sexo = 0;
        }
    }
    
    if(document.getElementById('alerta').checked){
        var alerta = 1;
    }else{
        var alerta = 0;
    }
    if(document.getElementById('acessoLivre').checked){
        var acesso = 1;
    }else{
        var acesso =0;
    }
    
    
    $.ajax({
        type: "POST",
        url: "pesquisaVisitante.php",
        data: {
            nome: $('#nomep').val(),
            cpf: $('#cpfp').val(),
            rg: $('#rgp').val(),
            dn: $('#dnp').val(),
            fone: $('#fonep').val(),
            omOrigem: $('#omOrigemp').val(),
            idMil: $('#idMilp').val(),
            sexo: sexo,
            idLocal: $('#idLocalpes').val(),
            acessoLivre: acesso,
            alerta: alerta
            
	},
	success: function(data) {
        $('#resultPesquisa').html(data);
	}
    });
}
function salcaCartaoAcesso(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/salvaCartaoAcesso.php",
        data: {
            idVisitante: id,
            idLocal: $('#idLocal').val(),
            validade: $('#validade').val()
	},
	success: function(data) {
            
        $('#retCartao').html(data);
	}
    });
}

function bloqueiaCartaoAcesso(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/bloqueiaCartaoAcesso.php",
        data: {
            idVisitante: id
	},
	success: function(data) {   
        $('#retCartao').html(data);
        
        document.getElementById('validade').value = "";
        document.getElementById('idLocal').innerHTML = "";
	}
    });
}
function salvaVeiculoVisitante(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/salvaVeiculoVisistante.php",
        data: {
            idVisitante: id,
            tipo: $('#tipoVeiculo').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            cor: $('#cor').val(),
            placa: $('#placa').val()
	},
	success: function(data) {
            
        $('#retVeiculo').html(data);
	}
    });
}
function bloqueiaVeiculoVisitante(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/bloqueiaVeiculoVisitante.php",
        data: {
            idVeiculo: id
	},
	success: function(data) {
        $('#retVeiculo').html(data);
        document.getElementById('marca').value = "";
        document.getElementById('modelo').value = "";
        document.getElementById('cor').value = "";
        document.getElementById('placa').value = "";
        document.getElementById('tipoVeiculo').innerHTML = "";
	}
    });
}
function salvaAlerta(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/salvaAlerta.php",
        data: {
            idVisitante: id,
            motivo: $('#motivoAlerta').val()
	},
	success: function(data) {
            
        $('#retAlerta').html(data);
	}
    });
}
function encerraAlerta(id){
    var id = id;
    
    $.ajax({
        type: "POST",
        url: "../scripts/encerraAlerta.php",
        data: {
            idVisitante: id
	},
	success: function(data) {
            
        $('#retAlerta').html(data);
        document.getElementById('motivoAlerta').value = "";
	}
    });
}
function pesquisaVisitas(){
    
    $.ajax({
        type: "POST",
        url: "pesquisaVisitas.php",
        data: {
            inicio: $('#inicio').val(),
            termino: $('#termino').val(),
            idLocal: $('#idLocalPesq').val(),
            placa: $('#placa').val(),
            modelo: $('#modelo').val(),
            cor: $('#cor').val()
	},
	success: function(data) {
            
        $('#retPesquisaVisitas').html(data);
	}
    });
}

function pesquisaMilOm(){
    
    $.ajax({
        type: "POST",
        url: "divPesquisaMilOm.php",
        data: {
            nomeMil: $('#nomeMilOmPesq').val()
	},
	success: function(data) {
            $('#retPesquMilOm').html(data);
	}
    });
}

function marcaMil(id,nome){
    
    var id = id;
    var nome = nome;
        
    document.getElementById('idMilHidden').value = id;
    
    var input = "<input type='text' value='"+nome+"' readonly='readonly' class='form-control'>";
    
    $('#idMilHiddenInput').html(input);
}

function pesquisaMil(){
    
    $.ajax({
        type: "POST",
        url: "divPesquisaMil.php",
        data: {
            nomeMil: $('#nomeMilPesq').val()
	},
	success: function(data) {
            $('#retPesqMil').html(data);
	}
    });
}
function listaDep(idMil){
    
    var idMil = idMil;
    
    $.ajax({
        type: "POST",
        url: "divModalListaDep.php",
        data: {
            idMil: idMil
	},
	success: function(data) {
            $('#modal-lista-visitantes').html(data);
	}
    });
}
function editaMil(idMil){
    
    var idMil = idMil;
    
    $.ajax({
        type: "POST",
        url: "divModalEditaMil.php",
        data: {
            idMil: idMil
	},
	success: function(data) {
            $('#modal-edita-mil').html(data);
	}
    });
}
function editaVisitante(idVis){
    
    var idVis = idVis;
    
    $.ajax({
        type: "POST",
        url: "../scripts/edita_visitante.php",
        data: {
            idVis: idVis,
            nome: $('#nomeEdt').val(),
            sexo: $('#sexoEdt').val(),
            cpf: $('#cpfEdt').val(),
            dn: $('#dnEdt').val(),
            rg: $('#rgEdt').val(),
            fone: $('#foneEdt').val(),
            idtMil: $('#idtMilEdt').val()
	},
	success: function(data) {
            
	}
    });
}

function pesquisaCBarras(){
    
    $.ajax({
        type: "POST",
        url: "divPesquisaCBarras.php",
        data: {
            cBarras: $('#cBarras').val()
	},
	success: function(data) {
            $('#retPesqCBarras').html(data);
	}
    });
}
