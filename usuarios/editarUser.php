<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";

    apenasLogado();
    if (isset($_GET['id']) && $_GET['id'] != $_SESSION['id_logado']) {
        header('Location: ./index.php');
        exit;
    }
    
    if (isset($_SESSION['id_logado']) && isset($_GET['id']) && empty($_GET['id']) == false) {
        // Guarda o id em uma variável
        $id = addslashes($_GET['id']);
        // Seleciona os dados do id passado
        $sql = "SELECT u.nome AS nome, u.login AS login FROM usuarios u WHERE id = '$id'";
        
        // PDO executa a query
        $sql = $pdo->query($sql);
        // Verifica se foi retornado algum registro
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            header('Location: ../usuarios/');
            exit;
        }
    } else {
        header('Location: ../usuarios/');
        exit;
    }

    // Guarda os valores passados pelo formulário editado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['nome']) && empty($_POST['nome']) == false) {
            $nome = addslashes($_POST['nome']);
            $login = addslashes($_POST['login']);
            $id = $_SESSION['id_logado'];

            // SQL UPDATE
            $sql = "UPDATE usuarios SET nome = '$nome', login = '$login'
                    WHERE id = '$id'";
    
            // PDO executa o UPDATE
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $sucesso = $stmt->fetch();
            echo $sucesso;
            $_SESSION['usuario_logado'] = $login;

            // Confirma o UPDATE e direciona para a pág. personagem
            echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
                <script type=\"text/javascript\">
                    alert(\"Usuário atualizado com sucesso!\");
                </script>";
        }
    }
?>

<div class="container">
    <h1 class="text-center">Editar Usuário</h1>
    
    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input value="<?php echo $usuario['nome']?>" type="text" class="form-control" id="nome" placeholder="Entre com o nome" name="nome">
        </div>
        
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Login:</label>
            <input value="<?php echo $usuario['login']?>" type="text" class="form-control" id="login" placeholder="Entre com o Login" name="login">
        </div>
        
        <div class="form-group text-center mt-5">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="./index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php
    include "../components/footer.php";
?>