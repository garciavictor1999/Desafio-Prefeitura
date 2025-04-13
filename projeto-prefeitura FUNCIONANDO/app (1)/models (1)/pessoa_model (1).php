<?php
require_once(__DIR__ . '/../../config/db_pdo.php');

class Usuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // Função realiza busca apenas por nome* ou cpf completo.
    public function pesquisaPerfil($termo) {
        try {
            // Remove caracteres não numéricos do termo (para verificar se é um CPF)
            $termoLimpo = preg_replace('/\D/', '', $termo);

            if (strlen($termoLimpo) === 11) {
                // Termo tem 11 dígitos, assume que é CPF
                $sql = "SELECT * FROM pessoas
                WHERE REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = :cpf";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':cpf', $termoLimpo);
            } else {
                // Buscar nomes que comecem com o termo digitado
                $sql = "SELECT * FROM pessoas
                WHERE nome LIKE :nome";
                $stmt = $this->conn->prepare($sql);
                $nome = $termo . '%'; // <-- Aqui está a mudança
                $stmt->bindParam(':nome', $nome);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }


    public function cadastrarPerfil($nome, $nascimento, $cpf, $sexo, $telefone, $email) {
        $sql = "INSERT INTO pessoas (nome, nascimento, cpf, sexo, telefone, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nome, $nascimento, $cpf, $sexo, $telefone, $email]);
    }
}
?>
