var empresa;

$(document).ready(function () {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/fornecedor',
    async: true,
    success: function (data) {
      var html;
      if (data.response != "Nenhum Fornecedor encontrado") {
        var telefones = data.response[0].telefone.split(";");

        if (telefones[0].length > 10) {
          telefones[0] = telefones[0].replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (telefones[0].length > 5) {
          telefones[0] = telefones[0].replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        }

        for (i = 0; i < data.response.length; i++) {
          html += `<tr>
        <td>`+ data.response[i].nome + `</td>
        <td>`+ emp(data.response[i].empresa) + `</td>
        <td>`+ telefones[0] + `</td>
        <td>
        <a class="btn btn-warning" href="editar-fornecedor.php?fornecedor=`+ data.response[i].id + `">Editar</a>
        <button class="btn btn-danger" onclick="deletar_fornecedor(`+ data.response[i].id + `)">Excluir</button>
        </td>
        </tr>`
        }
      } else {
        html += `<tr>
        <td colspan="4">Nenhum fornecedor cadastrado</td>
        </tr>`
      }
      $("#tabela_fornecedores").html(html);
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
});

function buscar_fornecedores() {
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/fornecedor/pesquisar',
    data: $('form').serialize(),
    async: true,
    success: function (data) {
      var html;
      if (data.response != "Nenhum Fornecedor encontrado") {
        var telefones = data.response[0].telefone.split(";");

        if (telefones[0].length > 10) {
          telefones[0] = telefones[0].replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (telefones[0].length > 5) {
          telefones[0] = telefones[0].replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        }

        for (i = 0; i < data.response.length; i++) {
          html += `<tr>
        <td>`+ data.response[i].nome + `</td>
        <td>`+ emp(data.response[i].empresa) + `</td>
        <td>`+ telefones[0] + `</td>
        <td>
        <a class="btn btn-warning" href="editar-fornecedor.php?fornecedor=`+ data.response[i].id + `">Editar</a>
        <button class="btn btn-danger" onclick="deletar_fornecedor(`+ data.response[i].id + `)">Excluir</button>
        </td>
        </tr>`
        }
      } else {
        html += `<tr>
        <td colspan="4">Nenhum fornecedor cadastrado</td>
        </tr>`
      }
      $("#tabela_fornecedores").html(html);
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
  return false;
}

function deletar_fornecedor(id) {
  $.ajax({
    type: 'DELETE',
    url: 'http://localhost/controle-fornecedores/fornecedor/' + id,
    async: true,
    success: function (data) {
      $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'http://localhost/controle-fornecedores/fornecedor',
        async: true,
        success: function (data) {
          var html;
          if (data.response != "Nenhum Fornecedor encontrado") {
            telefones = data.response[0].telefone.split(";");

            if (telefones[0].length > 10) {
              telefones[0] = telefones[0].replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (telefones[0].length > 5) {
              telefones[0] = telefones[0].replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            }

            for (i = 0; i < data.response.length; i++) {
              html += `<tr>
              <td>`+ data.response[i].nome + `</td>
              <td>`+ emp(data.response[i].empresa) + `</td>
              <td>`+ telefones[0] + `</td>
              <td>
              <a class="btn btn-warning" href="editar-fornecedor.php?fornecedor=`+ data.response[i].id + `">Editar</a>
              <button class="btn btn-danger" onclick="deletar_fornecedor(`+ data.response[i].id + `)">Excluir</button>
              </td>
              </tr>`
            }
          } else {
            html += `<tr>
            <td colspan="4">Nenhum fornecedor cadastrado</td>
            </tr>`
          }
          $("#tabela_fornecedores").html(html);
        }
      })
        .fail(function (jqXHR, textStatus, msg) {
          alert(msg);
        });
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
}

function emp(id) {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/empresa/' + id,
    async: false,
    success: function (data) {
      empresa = data.response[0].nome_fantasia

      return empresa;
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });

  return empresa;
}

function doc(documento) {
  var doc = documento.value;
  var numeros = doc.replace(/[^0-9]/g, '');

  if (numeros.length < 11) {
    $(documento).mask('000.000.000-00', { reverse: true });
  } else if (numeros.length > 11) {
    $(documento).mask('00.000.000/0000-00', { reverse: true });
  } else {
    $(documento).mask('000.000.000-009');
  }
}

$('#created_at').mask('00/00/0000');