<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
    }

    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->createProductsTable(); // Adiciona a criação da tabela durante a inicialização

            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    private function createProductsTable() {
        try {
            // $query = "
            //     CREATE TABLE IF NOT EXISTS produtos (
            //         id_produto INT PRIMARY KEY,
            //         quantidade INT,
            //         preco DECIMAL(10, 2),
            //         descricao VARCHAR(255)
            //     )
            // ";
            $query = "
            CREATE TABLE IF NOT EXISTS estoque (
              id INT UNSIGNED auto_increment NOT NULL,
              produto varchar(100) NOT NULL,
              cor varchar(100) NOT NULL,
              tamanho varchar(100) NOT NULL,
              deposito varchar(100) NOT NULL,
              data_disponibilidade DATE NOT NULL,
              quantidade INT UNSIGNED NOT NULL,
              CONSTRAINT estoque_pk PRIMARY KEY (id),
              CONSTRAINT estoque_un UNIQUE KEY (produto,cor,tamanho,deposito,data_disponibilidade)
            )
            ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb3
            COLLATE=utf8mb3_general_ci;";

            $this->conn->exec($query);

            echo "Tabela de estoque verificada/criada com sucesso.<br>";
        } catch (PDOException $e) {
            echo "Erro ao verificar/criar a tabela de produtos: " . $e->getMessage();
        }
    }
}
