<?php
include "../components/header.php";
include "../components/nav.php";
require_once "../db/conn.php";
require_once "../helpers.php";

apenasLogado();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Busca dados do animal
$stmt = $pdo->prepare("SELECT * FROM animais WHERE id = ?");
$stmt->execute([$id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    echo "Animal não encontrado!";
    exit;
}

// Dados auxiliares
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$habitats = $pdo->query("SELECT * FROM habitats")->fetchAll(PDO::FETCH_ASSOC);

// Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_popular = addslashes($_POST["nome_popular"]);
    $nome_cientifico = addslashes($_POST["nome_cientifico"]);
    $id_categoria = addslashes($_POST["id_categoria"]);
    $id_habitat = addslashes($_POST["id_habitat"]);
    $localizacao = addslashes($_POST["localizacao"]);
    $quantidade = addslashes($_POST["quantidade"]);

    $sql = "UPDATE animais 
            SET nome_popular=?, nome_cientifico=?, id_categoria=?, id_habitat=?, localizacao=?, quantidade=? 
            WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([
        $nome_popular,
        $nome_cientifico,
        $id_categoria,
        $id_habitat,
        $localizacao,
        $quantidade,
        $id
    ]);

    if ($sucesso) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar o animal.";
    }
}
?>

<div class="container">
    <h1 class="text-center my-4">Editar Animal</h1>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nome Popular</label>
            <input type="text" class="form-control" name="nome_popular" value="<?= htmlspecialchars($animal['nome_popular']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nome Científico</label>
            <input type="text" class="form-control" name="nome_cientifico" value="<?= htmlspecialchars($animal['nome_cientifico']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select class="form-select" name="id_categoria" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $animal['id_categoria'] ? 'selected' : '' ?>>
                        <?= $cat['descricao'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Habitat</label>
            <select class="form-select" name="id_habitat" required>
                <?php foreach ($habitats as $hab): ?>
                    <option value="<?= $hab['id'] ?>" <?= $hab['id'] == $animal['id_habitat'] ? 'selected' : '' ?>>
                        <?= $hab['descricao'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Localização</label>
            <textarea class="form-control" name="localizacao" rows="3" required><?= htmlspecialchars($animal['localizacao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" value="<?= $animal['quantidade'] ?>" required>
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include "../components/footer.php"; ?>