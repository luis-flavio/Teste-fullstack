$(document).ready(function () {
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://localhost/controle-fornecedores/empresa/' + $("#empresa").val(),
    async: true,
    success: function (data) {
      var html = '';
      html += `
      <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="uf">UF</label>
                <select name="uf" id="uf" class="form-control" required>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="nome_fantasia">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" id="nome_fantasia" value="`+ data.response[0].nome_fantasia + `" class="form-control" required>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" value="`+ data.response[0].cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5") + `" class="form-control" onkeyup="dados_cnpj(this.value)"
                  onkeypress="return somenteNumeros(event)" required>
              </div>
            </div>
          </div>
      `
      $("#editar").html(html);
      $("#uf").val(data.response[0].uf).change();
    }
  })
    .fail(function (jqXHR, textStatus, msg) {
      alert(msg);
    });
});