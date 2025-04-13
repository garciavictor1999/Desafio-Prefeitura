<?php
    $id = $_GET['id'] ?? null;


    if ($id) {
        // Chama o model pra buscar o usuário
        require_once "../models/pessoa.php";

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->pesquisaPerfil($id);

        if ($usuario[0]) {
            $user = $usuario[0]['sexo'] === 'feminino' ? 'Feminino' : 'Masculino';
            // Exibe os dados na tela
            echo "
            <div class='perfil-box' style='max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                <img src='../../assets/avatar.jpg' alt='Avatar' style='width:50px; height:50px; border-radius:50%; margin-right:15px;'>
            <div class='perfil-info'>
                <h3 style='margin-top: 10px;'>{$usuario[0]['nome']}</h3>
                <p>CPF: {$usuario[0]['cpf']}</p>
                <p>Telefone: {$usuario[0]['telefone']}</p>
                <p>Email: {$usuario[0]['email']}</p>
                <p>Data de nascimento: {$usuario[0]['nascimento']}</p>
                <p>Sexo: {$user}</p>
            </div>
            <div class='botoes-acoes' style='margin-top: 30px; display: flex; justify-content: space-between; gap: 10px;'>
                <button onclick=\"window.location.href='editar.php?id={$usuario[0]['id']}'\" style='flex: 1; padding: 12px; border: none; background-color: #4A90E2; color: white; font-size: 16px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;'>Editar</button>
                <button onclick=\"if(confirm('Tem certeza que deseja deletar?')) window.location.href='deletar.php?id={$usuario[0]['id']}'\" style='flex: 1; padding: 12px; border: none; background-color: #4A90E2; color: white; font-size: 16px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;'>Deletar</button>

                <button onclick=\"window.location.href='/public/index.php'\" style='flex: 1; padding: 12px; border: none; background-color: #4A90E2; color: white; font-size: 16px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;'>Voltar</button>

            </div>
            </div>

            ";

        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "ID inválido.";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Perfil</title>
<link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>




</body>
</html>
