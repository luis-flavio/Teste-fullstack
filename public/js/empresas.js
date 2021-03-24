$(document).ready(function () {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/empresa',
    async: true,
    success: function (data) {
      var html;
      if (data.response != "Nenhuma Empresa cadastrada") {
        for (i = 0; i < data.response.length; i++) {
          html += `<tr>
        <td>`+ data.response[i].nome_fantasia + `</td>
        <td>`+ data.response[i].cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + `</td>
        <td>
        <a class="btn btn-warning" href="editar-empresa.php?empresa=`+ data.response[i].id + `">Editar</a>
        <button class="btn btn-danger" onclick="deletar_empresa(`+ data.response[i].id + `)">Excluir</button>
        </td>
        </tr>`
        }
      } else {
        html += `<tr>
        <td colspan="4">Nenhuma Empresa cadastrada</td>
        </tr>`
      }
      $("#tabela_empresas").html(html);
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
});

function deletar_empresa(id) {
  $.ajax({
    type: 'DELETE',
    url: 'http://localhost/controle-fornecedores/empresa/' + id,
    async: true,
    success: function (data) {
      $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'http://localhost/controle-fornecedores/empresa',
        async: true,
        success: function (data) {
          var html;
          if (data.response != "Nenhuma Empresa cadastrada") {
            for (i = 0; i < data.response.length; i++) {
              html += `<tr>
        <td>`+ data.response[i].nome_fantasia + `</td>
        <td>`+ data.response[i].cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + `</td>
        <td>
        <a class="btn btn-warning" href="editar-empresa.php?empresa=`+ data.response[i].id + `">Editar</a>
        <button class="btn btn-danger" onclick="deletar_empresa(`+ data.response[i].id + `)">Excluir</button>
        </td>
        </tr>`
            }
          } else {
            html += `<tr>
        <td colspan="4">Nenhuma Empresa cadastrada</td>
        </tr>`
          }
          $("#tabela_empresas").html(html);
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