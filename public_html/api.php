<?php
header("Content-Type: application/json; charset=utf-8");

###################################################
# 1) CONEXÃO COM O BANCO (SEM ALTERAÇÕES)
###################################################
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=precos_alimentos;charset=utf8",
        "root",
        ""
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo json_encode(["erro" => "Conexão falhou: " . $e->getMessage()]);
    exit;
}

$action = $_GET["action"] ?? "";


###################################################
# 2) LISTAR – JOIN COM PRODUTOS
###################################################
if ($action === "listar") {

    $sql = "
        SELECT 
            p.id,
            pr.nome AS produto,
            p.preco,
            p.mercado,
            p.bairro,
            p.cidade,
            p.estado,
            p.data_pesquisa
        FROM precos p
        JOIN produtos pr ON pr.id = p.produto_id
        ORDER BY p.id DESC
    ";

    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);
    exit;
}


###################################################
# 3) CADASTRAR – TOTALMENTE COMPATÍVEL
###################################################
if ($action === "cadastrar") {

    $json = json_decode(file_get_contents("php://input"), true);

    $produto_nome = $json["produto"];
    $preco = $json["preco"];
    $data = $json["data_coleta"];
    $mercado = $json["supermercado"];
    $estado = strtoupper($json["estado"]);
    $cidade = $json["cidade"];
    $bairro = $json["bairro"];

    // Verifica se produto já existe
    $stm = $pdo->prepare("SELECT id FROM produtos WHERE nome = :nome LIMIT 1");
    $stm->execute([":nome" => $produto_nome]);
    $produto = $stm->fetch();

    if ($produto) {
        $produto_id = $produto["id"];
    } else {
        // Insere novo produto
        $stm = $pdo->prepare("INSERT INTO produtos (nome) VALUES (:nome)");
        $stm->execute([":nome" => $produto_nome]);
        $produto_id = $pdo->lastInsertId();
    }

    // Salva o preço
    $sql = "
        INSERT INTO precos 
            (produto_id, preco, mercado, bairro, cidade, estado, data_pesquisa)
        VALUES 
            (:produto_id, :preco, :mercado, :bairro, :cidade, :estado, :data)
    ";

    $stm = $pdo->prepare($sql);
    $stm->execute([
        ":produto_id" => $produto_id,
        ":preco" => $preco,
        ":mercado" => $mercado,
        ":bairro" => $bairro,
        ":cidade" => $cidade,
        ":estado" => $estado,
        ":data" => $data
    ]);

    echo json_encode(["status" => "ok"]);
    exit;
}


###################################################
# 4) DELETAR – SEM MEXER NO BANCO
###################################################
if ($action === "deletar") {

    $id = $_GET["id"] ?? 0;

    $stm = $pdo->prepare("DELETE FROM precos WHERE id = :id");
    $stm->execute([":id" => $id]);

    echo json_encode(["status" => "ok"]);
    exit;
}


###################################################
# 5) RELATÓRIO – ARQUIVO SEPARADO (CORRETO)
###################################################
if ($action === "relatorio") {

    require "relatorio_backend.php";
    exit;
}


###################################################
# 6) CASO AÇÃO NÃO EXISTA
###################################################
echo json_encode(["erro" => "Ação inválida"]);
exit;

