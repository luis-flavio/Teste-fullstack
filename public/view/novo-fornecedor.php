<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Empresa | Cadastrar Fornecedor</title>
</head>

<body>
  <?php include './header.php'; ?>

  <div class="container">
    <h2 class="my-3">CADASTRAR FORNECEDOR</h2>
    <div class="card">
      <div class="card-body">
        <form action="http://localhost/controle-fornecedores/fornecedor/" onsubmit="return valida_formulario(this.documento.value,this.data_nascimento.value)" method="POST">
          <div class="row">
            <div class="col-5">
              <div class="form-group">
                <label for="empresa">Empresa</label>
                <select class="form-select" name="empresa" id="empresa" required>
                </select>
                <a href="nova-empresa.php">Adicionar Empresa</a>
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" id="nome" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group"></div>
              <label for="documento">CPF ou CNPJ</label>
              <div class="row">
                <div class="col-7">
                  <input type="text" name="documento" id="documento" class="form-control" maxlength="18" onkeyup="tp_pessoa()" onkeypress="return somenteNumeros(event)" required>
                </div>
                <div class="col-5">
                  <select name="tipo_pessoa" id="tipo_pessoa" class="form-control">
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Jurídica</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-8">
              <div id="pessoa_fisica">
                <div class="row">
                  <div class="col-6">
                    <label for="data_nascimento">RG</label>
                    <input type="text" name="rg" id="rg" onkeypress="return somenteNumeros(event)" class="form-control" required>
                  </div>
                  <div class="col-6">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" required>
                  </div>
                </div>
              </div>
              <div id="pessoa_juridica"></div>
            </div>
          </div>
          <div class="row">
            <div id="telefones">
              <div class="col-3">
                <label for="telefone">Telefone</label>
                <div class="input-group">
                  <input type="text" name="telefone[]" class="form-control" onkeypress="mascara_telefone(this)">
                  <button type="button" onclick="adicionar_telefone()" class="btn btn-danger">+</button>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-success">Cadastrar Fornecedor</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/novo_fornecedor.js"></script>
</body>

</html>