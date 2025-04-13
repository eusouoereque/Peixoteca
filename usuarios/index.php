<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
    
    if (!isset($_SESSION['usuario_logado'])) {
        header("Location: ../login/index.php");
        exit;
    }
?>
<div class="container">
    <h1 class="text-center">Usuários</h1>
</div>

<div class="container mt-3">
    <h2>Usuários -
        <!-- Botão para cadastrar novo usuário -->
        <a href="cadastroUser.php" class="btn btn-primary">Novo Usuário</a>
    </h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM usuarios";
            $sql = $pdo->query($sql);

            if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $usuarios) {
                    echo '<tr>';
                    echo '<td>' . $usuarios['id'] . '</td>';
                    echo '<td>' . $usuarios['nome'] . '</td>';
                    echo '<td>' . $usuarios['login'] . '</td>';
                    echo '<td>
                        <a href="editarUser.php?id=' . $usuarios['id'] . '">Editar</a>
                        -
                        <a href="excluirUser.php?id=' . $usuarios['id'] . '">Excluir</a>
                        </td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
    include "../components/footer.php";
?>