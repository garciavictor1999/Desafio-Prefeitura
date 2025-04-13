<?php
require_once "../../config/database.php";

class Imovel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // Função para pesquisar imóveis por logradouro ou bairro
    public function pesquisar($termo) {
        try {
            $sql = "SELECT * FROM imovel WHERE logradouro LIKE :termo OR bairro LIKE :termo";
            $stmt = $this->conn->prepare($sql);
            $termo = '%' . $termo . '%';
            $stmt->bindParam(':termo', $termo);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    // Função para cadastrar um novo imóvel
    public function cadastrar($dados) {
        $sql = "INSERT INTO imovel (logradouro, numero, bairro, complemento)
        VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $dados['logradouro'],
            $dados['numero'],
            $dados['bairro'],
            $dados['complemento'] ?? null  // complemento é opcional
        ]);
    }
}
?>
