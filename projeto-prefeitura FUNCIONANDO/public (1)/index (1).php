<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css">
<title>Painel Admin</title>
</head>

<body>
<div class="painel">
<h2>Painel Admin</h2>

<div class="tabs">
<button class="tablink active-tab" onclick="abrirAba(event, 'pesquisa')">Pesquisa</button>
<button class="tablink" onclick="abrirAba(event, 'cadastro')">Cadastro</button>
<button class="tablink" id="perfilTab" onclick="abrirAba(event, 'perfil')" style="display:none;">Perfil</button>
</div>

<div class="box">
<div id="pesquisa" class="aba-conteudo ativo">
<?php include "../app/views/pesquisa.php"; ?>
</div>
<div id="cadastro" class="aba-conteudo">
<?php include "../app/views/cadastro.php"; ?>
</div>
<div id="perfil" class="aba-conteudo">
<?php include "../app/views/perfil.php"; ?>
</div>
</div>
</div>

</body>


</html>
