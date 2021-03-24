<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Empresa | Lista Fornecedores</title>
</head>

<body>
  <?php include './header.php'; ?>

  <div class="container">
    <h2 class="my-3">FORNECEDORES</h2>
    <div class="card">
      <div class="card-body">
      <form method="POST" onsubmit="return buscar_fornecedores()" action="http://localhost/controle-fornecedores/fornecedor/pesquisar">
        <div class="row">
          <div class="col-3">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="">
          </div>
          <div class="col-3">
            <label for="nome">CPF/CNPJ</label>
            <input type="text" name="documento" id="documento" onkeyup="doc(this)" class="form-control" value="">
          </div>
          <div class="col-3">
            <label for="created_at">Data do Cadastro</label>
            <input type="text" name="created_at" id="created_at" class="form-control" value="">
          </div>
          <div class="col-3 align-self-end">
            <button type="submit" class="btn btn-success">Pesquisar</button>
          </div>
        </div>
        <a href="novo-fornecedor.php" class="btn btn-info mb-4 mt-3">Cadastrar Novo Fornecedor</a>
        <table class="table table-striped">
          <thead class="table-primary">
            <th>Nome</th>
            <th>Empresa</th>
            <th>Telefone Principal</th>
            <th>Ação</th>
          </thead>
          <tbody id="tabela_fornecedores"></tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/home.js"></script>
</body>

</html>