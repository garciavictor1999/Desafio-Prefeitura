<div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
<form id="formCadastro" method="POST" action="cadastrar" autocomplete="on">

<!-- Tipo de Cadastro -->
<label for="tipoCadastro">Tipo de Cadastro:</label>
<select id="tipoCadastro" name="tipoCadastro" required>
<option value="pessoa">Pessoa</option>
<option value="imovel">Imóvel</option>
</select>

<!-- Formulário Pessoa -->
<div id="formPessoa">
<label for="nome">Nome completo:</label>
<input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>

<label for="nascimento">Data de nascimento:</label>
<input type="text" id="nascimento" name="nascimento" placeholder="dd/mm/aaaa" required>

<label for="cpf">CPF:</label>
<input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>

<label for="sexo">Sexo:</label>
<select id="sexo" name="sexo" required>
<option value="feminino">Feminino</option>
<option value="masculino">Masculino</option>
</select>

<label for="telefone">Telefone celular:</label>
<input type="text" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>

<label for="email">E-mail:</label>
<input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" required>
</div>

<!-- Formulário Imóvel -->
<div id="formImovel" style="display: none;">
<label for="logradouro">Logradouro:</label>
<input type="text" id="logradouro" name="logradouro" placeholder="Ex: Rua das Flores">

<label for="numero">Número:</label>
<input type="text" id="numero" name="numero" placeholder="Ex: 123">

<label for="bairro">Bairro:</label>
<input type="text" id="bairro" name="bairro" placeholder="Ex: Centro">

<label for="complemento">Complemento:</label>
<input type="text" id="complemento" name="complemento" placeholder="Apartamento, bloco, etc.">

<label for="situacao">Situação:</label>
<select id="situacao" name="situacao">
<option value="venda">À venda</option>
<option value="aluguel">Para alugar</option>
<option value="ocupado">Ocupado</option>
</select>
</div>

<button type="submit" class="botao-cadastro">Cadastrar</button>
</form>
</div>

<!-- Estilo -->
<style>
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input, label, select {
    font-size: 16px;
    width: 100%;
}

input, select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.botao-cadastro {
    padding: 12px;
    background-color: #4A90E2;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.botao-cadastro:hover {
    background-color: #357ABD;
}
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    // Máscaras
    $('#cpf').mask('000.000.000-00');
    $('#nascimento').mask('00/00/0000');
    $('#telefone').mask('(00) 00000-0000');
    $('#valor').mask('0000000.00', {reverse: true});

    // Função para ajustar o required nos campos visíveis
    function ajustarRequired() {
        const tipo = $('#tipoCadastro').val();

        if (tipo === 'pessoa') {
            $('#formPessoa input, #formPessoa select').prop('required', true);
            $('#formImovel input, #formImovel select').prop('required', false);
        } else {
            $('#formPessoa input, #formPessoa select').prop('required', false);
            $('#formImovel input, #formImovel select').prop('required', true);
        }
    }

    // Executar ao mudar tipo
    $('#tipoCadastro').on('change', function() {
        const tipo = $(this).val();

        if (tipo === 'pessoa') {
            $('#formCadastro').attr('action', 'cadastrar');
            $('#formPessoa').show();
            $('#formImovel').hide();
        } else {
            $('#formCadastro').attr('action', '/imovel/cadastrar');
            $('#formPessoa').hide();
            $('#formImovel').show();
        }

        ajustarRequired();
    });

    // Executar ao carregar a página
    ajustarRequired();

    // Envio AJAX do formulário
    $('#formCadastro').on('submit', function(e) {
        e.preventDefault();

        const tipoCadastro = $('#tipoCadastro').val();
        let actionUrl = '';

        if (tipoCadastro === 'pessoa') {
            actionUrl = '/app/controllers/pessoaController.php?action=cadastrar';
        } else {
            actionUrl = '/app/controllers/imovelController.php?action=cadastrar';
        }

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(resposta) {
                alert("Cadastro realizado com sucesso!");
                $('#formCadastro')[0].reset();
                $('#formCadastro').attr('action', '/usuario/cadastrar');
                $('#formPessoa').show();
                $('#formImovel').hide();
                ajustarRequired();
            },
            error: function(xhr) {
                alert("Erro ao cadastrar: " + xhr.responseText);
            }
        });
    });
});
</script>
