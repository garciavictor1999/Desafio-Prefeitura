# Sistema Simplificado de Cadastro de Imóveis – Prefeitura de São Leopoldo

Este projeto é uma versão reduzida e simplificada de um sistema de cadastro de imóveis para uso do setor de IPTU da Secretaria da Fazenda da Prefeitura de São Leopoldo. O principal objetivo é permitir o registro de imóveis do município e dos contribuintes (proprietários).

## 🚀 Tecnologias Utilizadas

- PHP (Back-end)
- MySQL (Banco de dados)
- HTML/CSS
- JavaScript
- Kali linux

## 💡 Funcionalidades

### Cadastro de Pessoas
- Registro de pessoas com os campos:
  - **Obrigatórios**: nome, data de nascimento, CPF e sexo
  - **Opcionais**: telefone e e-mail
- ID gerado automaticamente (auto incremento e único)
- Consulta, edição e exclusão de pessoas cadastradas

### Cadastro de Imóveis
- Registro de imóveis com os campos:
  - **Obrigatórios**: logradouro, número, bairro, contribuinte (proprietário vinculado)
  - **Opcional**: complemento
- A inscrição municipal (ID) é gerada automaticamente
- Consulta de imóveis, incluindo identificação do proprietário
- Edição e exclusão de imóveis cadastrados

### Funcionalidades Extras (não obrigatórias, mas implementáveis)
- Restrição de acesso com usuário e senha
- Consulta com filtros (ex: buscar imóveis por logradouro)
- Uso de framework de componentes para front-end (como Bootstrap)

## 📁 Estrutura do Projeto

```plaintext
/ (raiz)
│
├── index.php               # Página inicial ou login
├── cadastro_pessoa.php     # Formulário de cadastro de pessoa
├── cadastro_imovel.php     # Formulário de cadastro de imóvel
├── listar_pessoas.php      # Listagem e ações sobre pessoas
├── listar_imoveis.php      # Listagem e ações sobre imóveis
├── conexao.php             # Arquivo de conexão com o banco MySQL
├── editar_pessoa.php       # Edição de pessoa
├── editar_imovel.php       # Edição de imóvel
└── assets/



Como rodar o projeto localmente:

# 1. Clone o repositório
git clone https://github.com/seu-usuario/cadastro-imoveis-prefeitura.git

# 2. Mova para o diretório do projeto
cd cadastro-imoveis-prefeitura

# 3. Configure o servidor local com Apache e PHP (ex: usando XAMPP, Laragon ou Linux com Apache(Eu usei Kali linux por indicação de um amigo.))

# 4. Importe o banco de dados:
# - Crie o banco de dados no MySQL
# - Importe o script .sql fornecido na pasta raiz do projeto

# 5. Acesse o sistema via navegador:
http://localhost/cadastro-imoveis-prefeitura/
        


Caro recrutador, eu tive inúmeros problemas ao fazer esse projeto e como não tinha domínio de tudo, recebi ajuda de um amigo da área. Aprendi muito fazendo esse projeto, confesso que não domino ou compreendo 100% do trabalho que entreguei, mas se a mim for dada uma oportunidade, garanto que garra para aprender a ser mais autônomo não faltará, desde já agradeço pela oportunidade!
Victor Garcia da Rosa (25).

