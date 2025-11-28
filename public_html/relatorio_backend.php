<?php

$json = json_decode(file_get_contents("php://input"), true);

$produto = $json["produto"] ?? "";
$estado = $json["estado"] ?? "";
$cidade = $json["cidade"] ?? "";
$bairro = $json["bairro"] ?? "";

// ----- FILTROS DINÂMICOS -----
$where = " WHERE 1=1 ";

if ($produto !== "")
    $where .= " AND p.produto_id = " . intval($produto);
if ($estado !== "")
    $where .= " AND p.estado = " . $pdo->quote($estado);
if ($cidade !== "")
    $where .= " AND p.cidade LIKE " . $pdo->quote("%$cidade%");
if ($bairro !== "")
    $where .= " AND p.bairro LIKE " . $pdo->quote("%$bairro%");

// ----- RESUMO -----
$sqlResumo = "
    SELECT 
        COALESCE(AVG(p.preco),0) AS media,
        COALESCE(MIN(p.preco),0) AS min,
        COALESCE(MAX(p.preco),0) AS max
    FROM precos p
    $where
";
$resResumo = $pdo->query($sqlResumo)->fetch(PDO::FETCH_ASSOC);

// ----- MENOR PREÇO POR SUPERMERCADO -----
$sqlSuper = "
    SELECT mercado, MIN(preco) AS preco
    FROM precos p
    $where
    GROUP BY mercado
    ORDER BY preco ASC
";
$resSuper = $pdo->query($sqlSuper)->fetchAll(PDO::FETCH_ASSOC);

// ----- MENOR PREÇO POR BAIRRO -----
$sqlBairro = "
    SELECT bairro, MIN(preco) AS preco
    FROM precos p
    $where
    GROUP BY bairro
    ORDER BY preco ASC
";
$resBairro = $pdo->query($sqlBairro)->fetchAll(PDO::FETCH_ASSOC);

// ----- EVOLUÇÃO POR DATA -----
$sqlEvolucao = "
    SELECT data_pesquisa AS data, AVG(preco) AS media
    FROM precos p
    $where
    GROUP BY data_pesquisa
    ORDER BY data_pesquisa ASC
";
$resEvolucao = $pdo->query($sqlEvolucao)->fetchAll(PDO::FETCH_ASSOC);

// ----- RETORNO FINAL -----
echo json_encode([
    "resumo" => $resResumo,
    "supermercados" => $resSuper,
    "bairros" => $resBairro,
    "evolucao" => $resEvolucao
]);
exit;
