<!-- jQuery: DEVE vir antes de qualquer uso do $ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Mask Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<div style="max-width: 800px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">

<!-- Buscar Pessoa -->
<form id="form-pessoa" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 30px;">
<h2 style="margin: 0;">Buscar Pessoa</h2>
<label for="busca-pessoa">Nome ou CPF</label>
<input type="text" id="busca-pessoa" name="busca-pessoa" placeholder="Digite o nome ou CPF"
style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
<div style="display: flex; gap: 10px;">
<button type="button" onclick="window.location.href='/public/index.php'"
style="flex: 1; padding: 12px; background-color: #e74c3c; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Nova Consulta</button>
<button type="submit"
style="flex: 1; padding: 12px; background-color: #4A90E2; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Pesquisar</button>
</div>
</form>

<!-- Buscar Imóvel -->
<form id="form-imovel" style="display: flex; flex-direction: column; gap: 10px;">
<h2 style="margin: 0;">Buscar Imóvel</h2>
<label for="busca-imovel">Endereço ou Código</label>
<input type="text" id="busca-imovel" name="busca-imovel" placeholder="Digite o endereço ou código do imóvel"
style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;">
<div style="display: flex; gap: 10px;">
<button type="button" onclick="window.location.href='/public/index.php'"
style="flex: 1; padding: 12px; background-color: #e74c3c; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Nova Consulta</button>
<button type="submit"
style="flex: 1; padding: 12px; background-color: #4A90E2; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Pesquisar</button>
</div>
</form>

</div>
<div id="resultado-pesquisa" style="margin-top: 20px;"></div>
</div>



<script>
$(document).ready(function() {
    function renderizarPessoas(pessoas) {
        let html = '';

        if (!Array.isArray(pessoas) || pessoas.length === 0) {
            html = '<p>Nenhuma pessoa encontrada.</p>';
        } else {
            pessoas.forEach(function(pessoa) {
                const id = encodeURIComponent(pessoa.cpf);
                const nome = encodeURIComponent(pessoa.nome);
                const nascimento = encodeURIComponent(pessoa.nascimento ?? 'Data não informada');
                const termoBusca = encodeURIComponent($('#busca-pessoa').val());

                const perfilUrl = `/app/views/perfil.php?id=${id}&nome=${nome}&nascimento=${nascimento}&busca-pessoa=${termoBusca}`;

                html += `
                <div class="perfil-box" onclick="window.location.href='${perfilUrl}'" style="display: flex; align-items: center; gap: 15px; border: 1px solid #ccc; padding: 10px; border-radius: 5px; margin-bottom: 10px; cursor: pointer;">
                <img src="../assets/avatar.jpg" alt="Avatar" style="width:50px; height:50px; border-radius:50%;">
                <div class="perfil-info">
                <h3 style="margin: 0;">${decodeURIComponent(nome)}</h3>
                <p style="margin: 0;">Data de nascimento: ${decodeURIComponent(nascimento)}</p>
                </div>
                <a class="perfil-link" href="${perfilUrl}" style="margin-left:auto; color: #FFFFFF;">Ver perfil</a>
                </div>
                `
            });

            $('#resultado-pesquisa').html(html);
        }

    }



    // Busca inicial por pessoa via parâmetro da URL utilizado pra carregar o perfil.php
    const urlParams = new URLSearchParams(window.location.search);
    const termoInicial = urlParams.get('busca-pessoa');
    if (termoInicial) {
        $('#busca-pessoa').val(termoInicial); // preenche o campo
        $.ajax({
            url: '/app/controllers/pessoaController.php?action=pesquisar',
            method: 'POST',
            data: { busca: termoInicial },
            dataType: 'json',
            success: renderizarPessoas,
            error: function() {
                $('#resultado-pesquisa').html('<p>Erro ao buscar.</p>');
            }
        });
    }

    // Formulário de busca de pessoa
    $('#form-pessoa').on('submit', function(e) {
        e.preventDefault();
        let termo = $('#busca-pessoa').val();

        $.ajax({
            url: '/app/controllers/pessoaController.php?action=pesquisar',
            method: 'POST',
            data: { busca: termo },
            dataType: 'json',
            success: renderizarPessoas,
            error: function() {
                $('#resultado-pesquisa').html('<p>Erro ao buscar pessoa.</p>');
            }
        });
    });
});
</script>
