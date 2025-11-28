<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contato — Monitor de Preços</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS global -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <header class="header-main shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">Monitor de Preços</div>
      <nav class="nav-menu">
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro</a>
        <a href="relatorios.php">Relatórios</a>
        <a class="active" href="contato.php">Contato</a>
      </nav>
    </div>
  </header>

  <main class="container my-4">

    <div class="glass-card p-4">
      <h3 class="mb-2 fw-bold">Fale Conosco</h3>
      <p class="text-muted mb-4">Envie sugestões, dúvidas ou reporte problemas no sistema.</p>

      <form id="formContato">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input id="nome" class="form-control form-control-lg" placeholder="Seu nome">
        </div>

        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input id="email" type="email" class="form-control form-control-lg" placeholder="seuemail@exemplo.com">
        </div>

        <div class="mb-3">
          <label class="form-label">Mensagem</label>
          <textarea id="mensagem" class="form-control form-control-lg" rows="5"
            placeholder="Digite sua mensagem..."></textarea>
        </div>

        <button type="button" id="btnEnviar" class="btn btn-primary btn-lg w-100">
          Enviar mensagem
        </button>
      </form>
    </div>

  </main>

  <script>
    // Envio via Fetch API (PHP backend -> api.php?action=contato)
    document.getElementById('btnEnviar').addEventListener('click', async () => {
      const payload = {
        nome: document.getElementById('nome').value.trim(),
        email: document.getElementById('email').value.trim(),
        mensagem: document.getElementById('mensagem').value.trim()
      };

      if (!payload.nome || !payload.email || !payload.mensagem) {
        alert("Preencha todos os campos!");
        return;
      }

      try {
        const res = await fetch("api.php?action=contato", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload)
        });

        const json = await res.json();

        if (json.status === "ok") {
          alert("Mensagem enviada com sucesso!");
          document.getElementById('formContato').reset();
        } else {
          alert("Erro ao enviar mensagem.");
        }
      } catch (e) {
        alert("Erro de conexão com o servidor.");
      }
    });
  </script>

</body>

</html>