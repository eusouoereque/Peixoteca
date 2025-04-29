# 🐠 Peixoteca

Peixoteca é um projeto de CRUD simples, desenvolvido como trabalho colaborativo para a faculdade.
O sistema permite o gerenciamento de animais aquáticos, seus habitats e os usuários do sistema, utilizando tecnologias web básicas.

## 💻 Tecnologias Utilizadas

- **PHP**
- **HTML5**
- **CSS** (com **Bootstrap**)
- **MariaDB**

## 📁 Estrutura do Projeto

O projeto está estruturado como um **monolito**, reunindo o frontend, backend e banco de dados em uma única aplicação.

Principais diretórios:

- `/animais` — Gerenciamento de animais aquáticos
- `/habitat` — Cadastro e listagem de habitats
- `/usuarios` — Gerenciamento de usuários
- `/components` — Componentes reutilizáveis da interface
- `/db` — Scripts e conexões de banco de dados
- `/login` — Funcionalidades de autenticação
- `/img` — Armazenamento de imagens
- Arquivos principais como `index.php` e `helpers.php`

---

## ⚙️ Funcionalidades

- Cadastro, edição, exclusão e listagem de:
  - 🐟 **Animais aquáticos**
  - 🌊 **Habitats**
  - 👤 **Usuários**
- Sistema de login e controle de acesso
- Interface amigável utilizando Bootstrap

---

## 🚀 Como Rodar o Projeto

1. Clone o repositório
`git clone https://github.com/eusouoereque/peixoteca.git`

3. Configure o ambiente local
Utilize um servidor como XAMPP ou WAMP.
Mova os arquivos do projeto para a pasta htdocs (ou equivalente).

3. Configure o banco de dados
Importe o arquivo `peixoteca.sql`, localizado na pasta /db, para o seu MariaDB/MySQL.

4. Ajuste a conexão do banco
No arquivo conn.php, configure suas credenciais de acesso:

  - `$dsn = 'mysql:host=localhost;dbname=peixoteca';`
  - `$user = 'seu_usuario';`
  - `$pass = 'sua_senha';`

6. Acesse o projeto
Abra o navegador e acesse:
`http://localhost/peixoteca`

## 👨‍💻 Equipe
Este projeto foi desenvolvido por:

- [vToshio](https://github.com/vToshio)
- [Brschang](https://github.com/Brschang)
- [ThiagoOliverio](https://github.com/ThiagoOliverio)
- [vitalju](https://github.com/vitalju)
- [eusouoereque](https://github.com/eusouoereque)

## 📌 Observações
Este é um projeto acadêmico e está em constante evolução.
Sugestões, críticas construtivas e feedbacks são sempre bem-vindos! 🚀
