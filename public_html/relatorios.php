<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatórios — Monitor de Preços</title>

  <!-- CSS DO PROJETO -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- BIBLIOTECAS DE GRÁFICOS E PDF -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>

  <!-- ================== HEADER ================== -->
  <header class="header-main shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">Monitor de Preços</div>
      <nav class="nav-menu">
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a class="active" href="relatorios.php">Relatórios</a>
        <a href="contato.php">Contato</a>
      </nav>
    </div>
  </header>

  <!-- ================== CONTEÚDO ================== -->
  <main class="container my-4">

    <!-- FILTROS -->
    <section class="glass-card p-4 mb-4">
      <h3 class="fw-bold mb-3">Filtros do Relatório</h3>

      <div class="row g-3">
        <div class="col-md-3">
          <input id="fproduto" class="form-control" placeholder="ID do Produto">
        </div>

        <div class="col-md-2">
          <input id="festado" class="form-control" placeholder="Estado (UF)" maxlength="2">
        </div>

        <div class="col-md-3">
          <input id="fcidade" class="form-control" placeholder="Cidade">
        </div>

        <div class="col-md-3">
          <input id="fbairro" class="form-control" placeholder="Bairro">
        </div>

        <div class="col-md-12 mt-3 d-flex gap-2">
          <button id="btnAtualizar" class="btn btn-primary">Atualizar</button>
          <button id="btnExportExcel" class="btn btn-success">Exportar Excel</button>
          <button id="btnExportPDF" class="btn btn-danger">Exportar PDF</button>
        </div>
      </div>
    </section>

    <!-- RESUMO -->
    <section class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="glass-card p-3 text-center">
          <h6 class="text-muted">Preço Médio</h6>
          <h3 id="precoMedio" class="fw-bold text-primary">R$ 0,00</h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="glass-card p-3 text-center">
          <h6 class="text-muted">Menor Preço</h6>
          <h3 id="precoMin" class="fw-bold text-success">R$ 0,00</h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="glass-card p-3 text-center">
          <h6 class="text-muted">Maior Preço</h6>
          <h3 id="precoMax" class="fw-bold text-danger">R$ 0,00</h3>
        </div>
      </div>
    </section>

    <!-- GRÁFICOS -->
    <section class="glass-card p-4 mb-5">

      <!-- GRÁFICO 1 -->
      <h4 class="fw-bold mb-3">Menor Preço por Supermercado</h4>
      <canvas id="chartSuper" height="120"></canvas>

      <hr class="my-5">

      <!-- GRÁFICO 2 -->
      <h4 class="fw-bold mb-3">Menor Preço por Bairro</h4>
      <canvas id="chartBairro" height="120"></canvas>

      <hr class="my-5">

      <!-- GRÁFICO 3 -->
      <h4 class="fw-bold mb-3">Evolução Média por Data</h4>
      <canvas id="chartEvolucao" height="120"></canvas>

    </section>

  </main>

  <!-- JAVASCRIPT DO RELATÓRIO -->
  <script src="assets/js/relatorios.js"></script>

</body>

</html>