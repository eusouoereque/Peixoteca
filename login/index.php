<?php 
    include "../components/header.php";
    require_once "../db/conn.php";
    require_once "../helpers.php";

    $mensagem = '';
    $cor = 'danger';

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (usuarioEstaLogado()) {
            header('Location: ./logout.php');
            exit;
        }

        if (isset($_GET['msg'])) {
            $mensagem = mensagemLogin($_GET['msg']);

            if ($_GET['msg'] == 'cadastro')
                $cor = 'success';
        }
    }
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = addslashes($_POST['usuario']);
        //$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $senha = $_POST['senha'];

        
        $sql = "SELECT u.id as id, u.login AS nome, u.senha AS senha FROM usuarios u WHERE u.login = '$username';";
        $sql = $pdo->query($sql);
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['id_logado'] = trim($user['id']);
            $_SESSION['usuario_logado'] = trim($user['nome']);
            header('Location: ../animais/index.php');
            exit;
        } else {
            $mensagem = 'Usuário ou senha incorretos.';
        }
    }
?>

<div class="d-flex min-vh-100">
    <!-- Div da Imagem -->
    <div class="d-none d-sm-flex  w-50">
        <img src="../img/Login.png" alt="Imagem de uma água viva laranja no fundo do oceano"
             class="img-fluid object-fit-cover w-100 h-100">
    </div>

    <!-- Div do Conteúdo -->
    <div class="shadow-lg bg-body w-100 d-flex flex-column align-items-center justify-content-center">
        <a class="text-center mb-3 link-underline link-underline-opacity-0" href="../animais/index.php">
            <img class="w-50" src="../img/Logo colorida.png" alt="Logo da Peixoteca">
        </a>
        
        <form class="w-50" method="post">
            <h1 class="text-dark text-center my-5">Login</h1>
            <div class="form-group my-3">
                <label class="form-label" for="usuario">Nome de Usuário</label>
                <input class="form-control" name="usuario" placeholder="Insira seu usuário" type="text" required>
            </div>
            <div class="form-group my-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" placeholder="Insira sua senha" class="form-control" required>
            </div>
            <div class="text-center">
                <p>Ainda não possui uma conta? <a href="../usuarios/cadastroUser.php">Cadastre-se aqui!</a> </p>
                <?php
                    if ($mensagem) echo '<p class="text-'.$cor.'">'.$mensagem.'</a>'; 
                ?>
            </div>
            <div class="form-group text-center my-4">
                <button class="btn btn-outline-primary" type="submit">Entrar</button>
            </div>
        </form>
    </div>
</div>

