
<?php
session_start();
require_once "../db/conn.php";
require "../components/header.php";

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = addslashes($_POST['nome']);
    $usuario = addslashes($_POST['usuario']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o usuário já existe
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE login = ?");
    $sql->execute([$usuario]);

    if ($sql->rowCount() > 0) {
        $mensagem = "Usuário já cadastrado.";
    } else {
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, login, senha) VALUES (?, ?, ?)");
        if ($sql->execute([$nome, $usuario, $senha])) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar. Tente novamente.";
        }
    }
}
?>
<div class="d-flex min-vh-100">
    
<div class="shadow-lg bg-body w-100 d-flex flex-column align-items-center justify-content-center">
        <a class="text-center mb-3 link-underline link-underline-opacity-0" href="../animais/index.php">
            <img class="w-50" src="../img/Logo colorida.png" alt="Logo">
        </a>

        <form class="w-50" method="post">
            <h1 class="text-dark text-center my-4">Cadastro</h1>

            <div class="form-group my-2">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="Seu nome completo" required>
            </div>

            <div class="form-group my-2">
                <label for="usuario" class="form-label">Nome de Usuário</label>
                <input type="text" name="usuario" class="form-control" placeholder="Crie seu usuário" required>
            </div>

            <div class="form-group my-2">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Crie uma senha" required>
            </div>

            <div class="text-center my-3">
                <p>Já tem uma conta? <a href="../login/">Faça login</a></p>
                <?php if ($mensagem): ?>
                    <p class="text-<?php echo strpos($mensagem, 'sucesso') !== false ? 'success' : 'danger'; ?>">
                        <?= $mensagem ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-outline-primary" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    
    <div class="d-none d-sm-flex w-50">
        <img src="../img/Login.png" alt="Imagem de fundo" class="img-fluid object-fit-cover w-100 h-100">
    </div>
</div>
