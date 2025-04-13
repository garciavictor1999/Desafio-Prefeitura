<?php
require_once "../models/pessoa.php";

class PessoaController {
    public function pesquisar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busca = $_POST['busca'] ?? '';
            if (empty($busca)) {
                http_response_code(400);
                echo json_encode(['erro' => 'Entrada inválida.']);
                return;
            }

            // Verificar se a porta está aberta
            $porta = 3306;
            if (!@fsockopen("localhost", $porta, $errno, $errstr, 2)) {
                http_response_code(500);
                echo json_encode(['erro' => 'Erro: Porta do banco de dados fechada.']);
                return;
            }

            $usuario = new Usuario();
            $resultados = $usuario->pesquisaPerfil($busca);

            if (empty($resultados)) {
                echo json_encode([]);
                return;
            }

            $dadosFormatados = [];

            foreach($resultados as $usuario) {
                $dadosFormatados[] = [
                    'cpf' => $usuario['cpf'],
                    'nome' => $usuario['nome'],
                    'nascimento' => $usuario['nascimento'] ?? null,
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($dadosFormatados);
        }
    }

    public function cadastrar() {
        header('Content-Type: application/json; charset=utf-8');

        // Coletar e sanitizar dados
        $nome       = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $nascimento = $_POST['nascimento'] ?? '';
        $cpf        = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
        $sexo       = $_POST['sexo'] ?? '';
        $telefone   = preg_replace('/\D/', '', $_POST['telefone'] ?? '');
        $email      = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if (empty($nome) || empty($nascimento) || empty($cpf) || empty($sexo) || empty($telefone) || !$email) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados inválidos']);
            return;
        }

        // Converter data para formato MySQL (YYYY-MM-DD)
        $dataFormatada = DateTime::createFromFormat('d/m/Y', $nascimento);
        if (!$dataFormatada) {
            http_response_code(400);
            echo json_encode(['erro' => 'Data inválida']);
            return;
        }
        $nascimentoFormatado = $dataFormatada->format('Y-m-d');

        $nome = mb_convert_encoding($nome, 'UTF-8', 'auto');

        $usuario = new Usuario();
        $resultado = $usuario->cadastrarPerfil($nome, $nascimentoFormatado, $cpf, $sexo, $telefone, $email);

        if ($resultado) {
            echo json_encode(['sucesso' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao cadastrar']);
        }
    }
}

// Roteamento
$action = $_GET['action'] ?? '';
$controller = new PessoaController();

if ($action === 'cadastrar') {
    $controller->cadastrar();
} elseif ($action === 'pesquisar') {
    $controller->pesquisar();
}
?>
