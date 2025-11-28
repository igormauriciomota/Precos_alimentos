// ==============================
// VARIÁVEIS GLOBAIS
// ==============================
let chartSuper = null;
let chartBairro = null;
let chartEvolucao = null;

// ==============================
// BUSCAR DADOS DO BACKEND
// ==============================
async function carregarRelatorio() {
  const params = {
    produto: document.getElementById("fproduto").value.trim(),
    estado: document.getElementById("festado").value.trim(),
    cidade: document.getElementById("fcidade").value.trim(),
    bairro: document.getElementById("fbairro").value.trim(),
  };

  const resposta = await fetch("api.php?action=relatorio", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(params)
  });

  const json = await resposta.json();

  console.log("DEBUG → Dados recebidos do backend:", json);

  // Se erro
  if (!json || json.erro) {
    alert("Erro ao carregar dados do relatório.");
    return;
  }

  atualizarResumo(json.resumo);
  gerarGraficoSuper(json.supermercados);
  gerarGraficoBairros(json.bairros);
  gerarGraficoEvolucao(json.evolucao);
}


// ==============================
// RESUMO
// ==============================
function atualizarResumo(r) {
  document.getElementById("precoMedio").innerText = "R$ " + parseFloat(r.media).toFixed(2);
  document.getElementById("precoMin").innerText = "R$ " + parseFloat(r.min).toFixed(2);
  document.getElementById("precoMax").innerText = "R$ " + parseFloat(r.max).toFixed(2);
}


// ==============================
// GRÁFICO - SUPERMERCADOS
// ==============================
function gerarGraficoSuper(data) {
  if (chartSuper) chartSuper.destroy();

  const ctx = document.getElementById("chartSuper");

  chartSuper = new Chart(ctx, {
    type: "bar",
    data: {
      labels: data.map(i => i.mercado),
      datasets: [{
        label: "Menor Preço (R$)",
        data: data.map(i => parseFloat(i.preco)),
        borderColor: "#1d6fd6",
        backgroundColor: "rgba(54, 162, 235, 0.6)",
        borderWidth: 2
      }]
    },
    options: { responsive: true }
  });
}


// ==============================
// GRÁFICO - BAIRROS
// ==============================
function gerarGraficoBairros(data) {
  if (chartBairro) chartBairro.destroy();

  const ctx = document.getElementById("chartBairro");

  chartBairro = new Chart(ctx, {
    type: "bar",
    data: {
      labels: data.map(i => i.bairro),
      datasets: [{
        label: "Menor Preço (R$)",
        data: data.map(i => parseFloat(i.preco)),
        borderColor: "#d67c22",
        backgroundColor: "rgba(255, 159, 64, 0.6)",
        borderWidth: 2
      }]
    },
    options: { responsive: true }
  });
}


// ==============================
// GRÁFICO - EVOLUÇÃO
// ==============================
function gerarGraficoEvolucao(data) {
  if (chartEvolucao) chartEvolucao.destroy();

  const ctx = document.getElementById("chartEvolucao");

  chartEvolucao = new Chart(ctx, {
    type: "line",
    data: {
      labels: data.map(i => i.data),
      datasets: [{
        label: "Preço Médio (R$)",
        data: data.map(i => parseFloat(i.media)),
        borderColor: "#28a745",
        backgroundColor: "rgba(40,167,69,0.2)",
        borderWidth: 3,
        tension: 0.3
      }]
    },
    options: { responsive: true }
  });
}


// ==============================
// BOTÃO ATUALIZAR
// ==============================
document.getElementById("btnAtualizar").addEventListener("click", carregarRelatorio);

// Carrega ao abrir
carregarRelatorio();

