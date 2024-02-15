<?php
require_once 'classes/Database.php';
require_once 'classes/Estoque.php'; // Corrigi o nome da classe

$db = new Database();
$conn = $db->getConnection();

$estoque = new Estoque($conn); // Corrigi o nome da classe

$jsonProdutos = '[
    {
        "produto": "10.01.0419",
        "cor": "00",
        "tamanho": "P",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-05-01",
        "quantidade": 15
    },
    {
        "produto": "11.01.0568",
        "cor": "08",
        "tamanho": "P",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-05-01",
        "quantidade": 2
    },
    {
        "produto": "11.01.0568",
        "cor": "08",
        "tamanho": "M",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-05-01",
        "quantidade": 4
    },
    {
        "produto": "11.01.0568",
        "cor": "08",
        "tamanho": "G",
        "deposito": "1",
        "data_disponibilidade": "2023-05-01",
        "quantidade": 6
    },
    {
        "produto": "11.01.0568",
        "cor": "08",
        "tamanho": "P",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-06-01",
        "quantidade": 8
    },
    {
        "produto": "11.01.0569",
        "cor": "22",
        "tamanho": "P",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-06-01",
        "quantidade": 8
    },
    {
        "produto": "11.01.0569",
        "cor": "23",
        "tamanho": "P",
        "deposito": "DEP1",
        "data_disponibilidade": "2023-06-01",
        "quantidade": 8
    }
]'; // Adicionei a vírgula no final do JSON

// Exemplo de uso
$estoque->atualizarEstoque($jsonProdutos);
?>
