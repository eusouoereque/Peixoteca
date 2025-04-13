<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
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
                // Seleção de todos os usuários do BD
                $sql = "SELECT * FROM usuarios";
                // PDO que executa a query SELECT
                $sql = $pdo->query($sql);
                // Verifica se a query retornou resultados
                if ($sql->rowCount() > 0) {
                    // O loop percorre todo o SELECT
                    // imprimindo como user[]
                    foreach ($sql->fetchAll() as $usuarios) {
                        // Retorno das consultas na tabela
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
