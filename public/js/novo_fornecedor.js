var empresa;

$(document).ready(function () {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/empresa',
    async: true,
    success: function (data) {
      var html;
      for (i = 0; i < data.response.length; i++) {
        html += `<option value="` + data.response[i].id + `">` + data.response[i].nome_fantasia + `</option>`
      }
      $("#empresa").html(html);
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
});

function somenteNumeros(e) {
  var charCode = e.charCode ? e.charCode : e.keyCode;
  if (charCode != 8 && charCode != 9) {
    if (charCode < 48 || charCode > 57) {
      return false;
    }
  }
}

function adicionar_telefone() {
  var telefones = document.getElementById("telefones");

  $(telefones).append(
    `<div class="col-3">
    <label for="telefone">Telefone</label>
    <div class="input-group">
    <input type="text" name="telefone[]" class="form-control" onkeypress="mascara_telefone(this)">
    <button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-danger">x</button>
    </div>
    </div>`
  );
}

function tp_pessoa() {
  var documento = document.getElementById("documento").value;
  var numeros = documento.replace(/[^0-9]/g, '');

  if (numeros.length < 11) {
    if (!$("#pessoa_fisica").children().length) {
      $("#pessoa_fisica").append(
        `<div class="row">
        <div class="col-6">
          <label for="data_nascimento">RG</label>
          <input type="text" name="rg" id="rg" class="form-control" required>
        </div>
        <div class="col-6">
          <label for="data_nascimento">Data de Nascimento</label>
          <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" required> 
        </div>
      </div>`
      )
    }
    $("#pessoa_juridica").children().remove()
    document.getElementById('tipo_pessoa').value = 1;
    $('#documento').mask('000.000.000-00', { reverse: true });
  } else if (numeros.length > 11) {
    document.getElementById('tipo_pessoa').value = 2;
    $("#pessoa_fisica").children().remove()
    $('#documento').mask('00.000.000/0000-00', { reverse: true });
    inscricao();
  } else {
    if (!$("#pessoa_fisica").children().length) {
      $("#pessoa_fisica").append(
        `<div class="row">
        <div class="col-6">
          <label for="data_nascimento">RG</label>
          <input type="text" name="rg" id="rg" class="form-control" required>
        </div>
        <div class="col-6">
          <label for="data_nascimento">Data de Nascimento</label>
          <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" required>
        </div>
      </div>`
      )
    }
    $("#pessoa_juridica").children().remove()
    document.getElementById('tipo_pessoa').value = 1;
    $('#documento').mask('000.000.000-009');
  }
}

function inscricao() {
  var cnpj = document.getElementById("documento").value;
  var numeros = cnpj.replace(/[^0-9]/g, '');

  if (numeros.length >= 14) {
    if (!validarCNPJ(cnpj)) {
      alert("cnpj invalido")
      $("#documento").val('');

      return false;
    }

    $.ajax({
      'url': "https://www.receitaws.com.br/v1/cnpj/" + numeros,
      'type': "GET",
      "dataType": "jsonp",
      "cache": "false",
      "success": function (data) {
        if (data.uf == undefined) {
          alert(data.status + ' ' + data.message)
        } else {
          if (data.uf == "DF") {
            $("#pessoa_juridica").children().remove()
            $("#pessoa_juridica").append(
              `
            <div class="row">
            <div class="col-12">
            <label for="inscricao">Inscrição Estadual</label>
            <input type="text" name="inscricao" id="inscricao" class="form-control" required>
            <input type="hidden" name="uf_cnpj" id="uf_cnpj" value="`+ data.uf + `" required>
          </div>
        </div>
            `
            )
          } else {
            $("#pessoa_juridica").children().remove()
            $("#pessoa_juridica").append(
              `
            <div class="row">
            <div class="col-12">
            <label for="inscricao">Inscrição Municipal</label>
            <input type="text" name="inscricao" id="inscricao" class="form-control" required>
            <input type="hidden" name="uf_cnpj" id="uf_cnpj" value="`+ data.uf + `" required>
          </div>
        </div>
            `
            )
          }
        }
      }
    }).fail(function () {
      alert("Muitas requisições. Por favor tente mais tarde");
    })
  }
}

function valida_formulario(cpf, data_nascimento) {
  if (!validaCPF(cpf)) {
    alert("cpf invalido")
    return false
  }

  if (verificar_empresa() == "PR" && $("#tipo_pessoa").val() == 1) {
    if (!controle_idade(data_nascimento)) {
      alert("Empresas do parana nao permitem cadastro de menores como pessoa fisica")
      return false
    }
  }

  return true;
}

function mascara_telefone(telefone) {
  var tel = telefone.value;
  var numeros = tel.replace(/[^0-9]/g, '');

  if (numeros.length < 10) {
    $(telefone).mask('(00) 0000-00009');
  } else {
    $(telefone).mask('(00) 00000-0000');
  }
}
function controle_idade(data_nascimento) {
  if (isValidDate(data_nascimento)) {
    if (idade(data_nascimento) < 18) {
      return false
    }
    return true
  }
  return false
}

function verificar_empresa() {
  var empresa = document.getElementById("empresa").value;

  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/empresa/' + empresa,
    async: false,
    success: function (data) {
      empresa = data.response[0].uf

      return empresa;
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });

  return empresa;
}

function validaCPF(cpf) {
  cpf = cpf.replace(/\D/g, '');
  if (cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
  var result = true;
  [9, 10].forEach(function (j) {
    var soma = 0, r;
    cpf.split(/(?=)/).splice(0, j).forEach(function (e, i) {
      soma += parseInt(e) * ((j + 2) - (i + 1));
    });
    r = soma % 11;
    r = (r < 2) ? 0 : 11 - r;
    if (r != cpf.substring(j, j + 1)) result = false;
  });
  return result;
}

function validarCNPJ(cnpj) {

  cnpj = cnpj.replace(/[^\d]+/g, '');

  if (cnpj == '') return false;

  if (cnpj.length != 14)
    return false;

  if (cnpj == "00000000000000" ||
    cnpj == "11111111111111" ||
    cnpj == "22222222222222" ||
    cnpj == "33333333333333" ||
    cnpj == "44444444444444" ||
    cnpj == "55555555555555" ||
    cnpj == "66666666666666" ||
    cnpj == "77777777777777" ||
    cnpj == "88888888888888" ||
    cnpj == "99999999999999")
    return false;

  // Valida DVs
  tamanho = cnpj.length - 2
  numeros = cnpj.substring(0, tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
      pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(0))
    return false;

  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
      pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(1))
    return false;

  return true;

}

function isValidDate(date) {
  var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
  if (matches == null) return false;
  return true;
}

function idade(nascimento) {
  var hoje = new Date();
  var diferencaAnos = hoje.getFullYear() - nascimento.substr(-4);
  if (new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) <
    new Date(hoje.getFullYear(), nascimento.substr(3, 2), nascimento.substr(0, 2)))
    diferencaAnos--;
  return diferencaAnos;
}


$('#data_nascimento').mask('00/00/0000');