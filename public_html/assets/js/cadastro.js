const API = "api.php";

async function listar() {
  const res = await fetch(API + "?action=listar");
  const dados = await res.json();
  renderTabela(dados);
}

// Preenche tabela
function renderTabela(lista) {
  const tbody = document.querySelector("#tabelaProdutos tbody");
  tbody.innerHTML = "";

  lista.forEach(item => {
    const tr = document.createElement("tr");

    tr.innerHTML = `
            <td>${item.produto}</td>
            <td>R$ ${Number(item.preco).toFixed(2)}</td>
            <td>${item.data_pesquisa}</td>
            <td>${item.mercado}</td>
            <td>${item.estado}</td>
            <td>${item.cidade}</td>
            <td>${item.bairro}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editar(${item.id})">✏</button>
                <button class="btn btn-danger btn-sm" onclick="deletar(${item.id})">🗑</button>
            </td>
        `;
    tbody.appendChild(tr);
  });
}

// Cadastro
document.getElementById("formCadastro").addEventListener("submit", async e => {
  e.preventDefault();

  const payload = {
    produto: produto.value,
    preco: preco.value,
    data_coleta: data_coleta.value,
    supermercado: supermercado.value,
    estado: estado.value,
    cidade: cidade.value,
    bairro: bairro.value
  };

  await fetch(API + "?action=cadastrar", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  });

  listar();
  e.target.reset();
});

// Deletar
async function deletar(id) {
  if (!confirm("Confirma exclusão?")) return;

  await fetch(`${API}?action=deletar&id=${id}`, { method: "DELETE" });
  listar();
}

listar();
