<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
    
    apenasLogado();
?>

<div class="container my-4">
    <h1 class="text-center mb-4">Usuários</h1>
    
    <?php if (usuarioEstaLogado()): ?>
        <div class="text-end mb-3">
            <!-- Botão para cadastrar novo usuário -->
            <a href="cadastroUser.php" class="btn btn-success mb-3">Novo Usuário</a>
        </h2>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
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
</div>

<?php
    include "../components/footer.php";
?>