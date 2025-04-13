<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
    
    apenasLogado();
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
            ?>

            <?php if ($sql->rowCount() > 0): ?>
                <?php foreach ($sql->fetchAll() as $usuarios): ?>
                    <tr>
                        <td><?php echo $usuarios['id'] ?> </td>
                        <td><?php echo $usuarios['nome'] ?> </td>
                        <td><?php echo $usuarios['login'] ?></td>
                    <?php if ($usuarios['id'] == $_SESSION['id_logado']): ?>
                        <td>
                            <a class="btn btn-warning btn-sm"
                             href="./editarUser.php?id=<?php echo $usuarios['id'] ?>">Editar</a>
                            <a class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja realmente excluir a sua conta?')"
                               href="./excluirUser.php?id=<?php echo $usuarios['id'] ?>">Excluir</a>
                        </td>
                    <?php else:  ?>
                        <td> - </td>
                    <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
    include "../components/footer.php";
?>