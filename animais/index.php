<?php
include "../components/header.php";
include "../components/nav.php";
require_once "../db/conn.php";
require_once "../helpers.php";

// Verifica se usuário está logado
$usuario_logado = usuarioEstaLogado();

// Consulta os animais com JOIN para trazer categoria e habitat
$sql = "SELECT a.*, 
               c.descricao AS categoria, 
               h.descricao AS habitat, 
               u.nome AS criador 
        FROM animais a
        JOIN categorias c ON a.id_categoria = c.id
        JOIN habitats h ON a.id_habitat = h.id
        JOIN usuarios u ON a.id_criador = u.id";

$animais = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-4">
    <h1 class="text-center mb-4">Animais Cadastrados</h1>

    <?php if ($usuario_logado): ?>
        <div class="text-end mb-3">
            <a href="CadastrarAnimal.php" class="btn btn-success">Cadastrar Novo Animal</a>
        </div>
    <?php endif; ?>

    <?php if (count($animais) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-primary">
                    <tr> 
                        <th>Nome Popular</th>
                        <th>Nome Científico</th>
                        <th>Categoria</th>
                        <th>Habitat</th>
                        <th>Localização</th>
                        <th>Quantidade</th>
                        <th>Criador</th>
                        <?php if ($usuario_logado): ?>
                            <th>Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($animais as $animal): ?>
                        <tr>
                            <td><?= htmlspecialchars($animal['nome_popular']) ?></td>
                            <td><?= htmlspecialchars($animal['nome_cientifico']) ?></td>
                            <td><?= htmlspecialchars($animal['categoria']) ?></td>
                            <td><?= htmlspecialchars($animal['habitat']) ?></td>
                            <td><?= htmlspecialchars($animal['localizacao']) ?></td>
                            <td><?= $animal['quantidade'] ?></td>
                            <td><?= htmlspecialchars($animal['criador']) ?></td>
                            <?php if ($usuario_logado): ?>
                                <td>
                                <a href="EditarAnimal.php?id=<?= $animal['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="ExcluirAnimal.php?id=<?= $animal['id'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Deseja realmente excluir este animal?')">
                                        Excluir
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">Nenhum animal cadastrado até o momento.</p>
    <?php endif; ?>
</div>

<?php include "../components/footer.php"; ?>