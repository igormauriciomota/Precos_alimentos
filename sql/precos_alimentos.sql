CREATE DATABASE IF NOT EXISTS precos_alimentos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE precos_alimentos;
DROP TABLE IF EXISTS precos;
DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL
);
CREATE TABLE precos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    mercado VARCHAR(150),
    bairro VARCHAR(150),
    cidade VARCHAR(150),
    estado VARCHAR(2),
    data_pesquisa DATE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);