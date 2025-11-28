<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Cadastro — Monitor de Preços</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS MODERNO -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!-- ================== HEADER ================== -->
  <header class="header-main">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">Monitor de Preços</div>

      <nav class="nav-menu">
        <a href="index.php">Home</a>
        <a class="active" href="cadastro.php">Cadastro</a>
        <a href="relatorios.php">Relatórios</a>
        <a href="contato.php">Contato</a>
      </nav>
    </div>
  </header>

  <!-- ================== CONTEÚDO ================== -->
  <main class="container">

    <!-- FORMULÁRIO -->
    <section class="glass-card mb-4 p-4">
      <h2 class="section-title mb-3">Cadastrar preço — formulário</h2>

      <form id="formCadastro">

        <input type="hidden" id="id">

        <label>Produto</label>
        <input id="produto" class="form-control mb-2" required>

        <label>Preço (R$)</label>
        <input id="preco" type="number" step="0.01" class="form-control mb-2" required>

        <label>Data da coleta</label>
        <input id="data_coleta" type="date" class="form-control mb-2" required>

        <label>Supermercado</label>
        <input id="supermercado" class="form-control mb-2" required>

        <label>Estado (UF)</label>
        <input id="estado" maxlength="2" class="form-control mb-2" required>

        <label>Cidade</label>
        <input id="cidade" class="form-control mb-2" required>

        <label>Bairro</label>
        <input id="bairro" class="form-control mb-2" required>

        <div class="form-buttons mt-3 d-flex gap-2">
          <button class="btn-save" type="submit">Salvar</button>
          <button class="btn-clear" type="button" id="btnLimpar">Limpar</button>
        </div>
      </form>
    </section>

    <!-- TABELA -->
    <section class="glass-card table-section p-4">
      <h2 class="section-title mb-3">Produtos cadastrados</h2>

      <input id="filtro" class="filter-input mb-3 form-control"
        placeholder="Pesquisar por produto, estado, cidade ou bairro...">

      <table class="table table-hover table-striped" id="tabelaProdutos">
        <thead class="table-primary">
          <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Data</th>
            <th>Super</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Bairro</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </section>

  </main>

  <!-- ================== FOOTER ================== -->
  <footer class="footer">© 2025 Monitor de Preços</footer>

  <script src="assets/js/cadastro.js"></script>

</body>

</html>