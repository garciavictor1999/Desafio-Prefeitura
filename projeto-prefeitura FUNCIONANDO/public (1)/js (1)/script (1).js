function abrirAba(evt, abaId) {
    // Esconde todas as abas
    document.querySelectorAll('.aba-conteudo').forEach(div => {
        div.classList.remove('ativo');
    });

    // Remove classe ativa de todos os botões
    document.querySelectorAll('.tablink').forEach(btn => {
        btn.classList.remove('active-tab');
    });

    // Mostra aba clicada e destaca o botão
    document.getElementById(abaId).classList.add('ativo');
    if (evt) {
        evt.currentTarget.classList.add('active-tab');
    } else {
        // Se chamada por JS (sem clicar), ativa a aba "Perfil"
        document.getElementById(abaId + "Tab").style.display = "inline-block";
        document.getElementById(abaId + "Tab").classList.add("active-tab");
    }
}
