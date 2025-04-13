<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
    require_once "../helpers.php";
?>

<?php
apenasLogado();


$criador = $_SESSION['usuario_logado'] ?? '';

// Busca categorias e habitats para o formulário
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
$habitats = $pdo->query("SELECT * FROM habitats")->fetchAll(PDO::FETCH_ASSOC);

// Busca ID do criador pelo nome
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nome = ?");
$stmt->execute([$criador]);
$usuario = $stmt->fetch();
$id_criador = $usuario['id'] ?? null;

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_popular = addslashes($_POST["nome_popular"]);
    $nome_cientifico = addslashes($_POST["nome_cientifico"]);
    $id_categoria = addslashes($_POST["id_categoria"]);
    $id_habitat = addslashes($_POST["id_habitat"]);
    $localizacao = addslashes($_POST["localizacao"]);
    $quantidade = addslashes($_POST["quantidade"]);
    

    $sql = "INSERT INTO animais 
            (nome_popular, nome_cientifico, id_categoria, id_criador, id_habitat, localizacao, quantidade) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([
        $nome_popular, 
        $nome_cientifico, 
        $id_categoria, 
        $id_criador, 
        $id_habitat, 
        $localizacao, 
        $quantidade
    ]);

    if ($sucesso) {
        header("Location: index.php");
        exit;
    } else {
        $mensagem = "Erro ao cadastrar animal.";
    }
}
?>

<div class="container">
    <h1 class="text-center my-4">Cadastrar Novo Animal</h1>
    
    <?php if ($mensagem): ?>
        <div class="alert alert-danger"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome_popular" class="form-label">Nome Popular</label>
            <input type="text" class="form-control" id="nome_popular" name="nome_popular" required>
        </div>

        <div class="mb-3">
            <label for="nome_cientifico" class="form-label">Nome Científico</label>
            <input type="text" class="form-control" id="nome_cientifico" name="nome_cientifico" required>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select class="form-select" id="id_categoria" name="id_categoria" required>
                <option value="">Selecione...</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['descricao'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_habitat" class="form-label">Habitat</label>
            <select class="form-select" id="id_habitat" name="id_habitat" required>
                <option value="">Selecione...</option>
                <?php foreach ($habitats as $hab): ?>
                    <option value="<?= $hab['id'] ?>"><?= $hab['descricao'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização</label>
            <textarea class="form-control" id="localizacao" name="localizacao" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include "../components/footer.php"; ?>
