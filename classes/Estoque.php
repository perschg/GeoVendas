<?php

class Estoque {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function atualizarEstoque($jsonProdutos) {
        try {
            // $this->conn->beginTransaction();

            $produtos = json_decode($jsonProdutos, true);

            foreach ($produtos as $produtoItem) {
                $produto = $produtoItem['produto'];
                $cor = $produtoItem['cor'];
                $tamanho = $produtoItem['tamanho'];
                $deposito = $produtoItem['deposito'];
                $data_disponibilidade = $produtoItem['data_disponibilidade'];
                $quantidade = $produtoItem['quantidade'];
                $successMsg = "Produto ($produto)";

                $sql = "
                    SELECT * FROM estoque 
                    WHERE produto = :produto
                    AND cor = :cor
                    AND tamanho = :tamanho
                    AND deposito = :deposito
                    AND data_disponibilidade = :data_disponibilidade";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':produto', $produto);
                $stmt->bindParam(':cor', $cor);
                $stmt->bindParam(':tamanho', $tamanho);
                $stmt->bindParam(':deposito', $deposito);
                $stmt->bindParam(':data_disponibilidade', $data_disponibilidade);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $successMsg .= " atualizado com sucesso";
                    $sql = "
                        UPDATE estoque 
                        SET quantidade = :quantidade 
                        WHERE produto = :produto
                        AND cor = :cor
                        AND tamanho = :tamanho
                        AND deposito = :deposito
                        AND data_disponibilidade = :data_disponibilidade";
                } else {
                    $successMsg .= " criado com sucesso";
                    $sql = "
                        INSERT INTO estoque (produto, cor, tamanho, deposito, data_disponibilidade, quantidade) 
                        VALUES (:produto, :cor, :tamanho, :deposito, :data_disponibilidade, :quantidade)";
                }

                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':produto', $produto);
                $stmt->bindParam(':cor', $cor);
                $stmt->bindParam(':tamanho', $tamanho);
                $stmt->bindParam(':deposito', $deposito);
                $stmt->bindParam(':data_disponibilidade', $data_disponibilidade);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->execute();

                echo $successMsg . "<br>";
            }

            // $this->conn->commit();

            echo "Estoque atualizado com sucesso!";
        } catch (PDOException $e) {
            // $this->conn->rollBack();
            echo "Erro ao atualizar o estoque: " . $e->getMessage();
        }
    }
}
