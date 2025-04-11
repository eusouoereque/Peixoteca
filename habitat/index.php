<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
?>

<?php

// Cadastrar novo habitat
// Cadastrar ou Editar habitat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao']);

    // EDITAR
    if (!empty($_POST['id'])) {
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("UPDATE habitats SET descricao = :descricao WHERE id = :id");
        $stmt->execute([
            'descricao' => $descricao,
            'id' => $id
        ]);
    } else {
        // INSERIR NOVO
        if (!empty($descricao)) {
            $stmt = $pdo->prepare("INSERT INTO habitats (descricao) VALUES (:descricao)");
            $stmt->execute(['descricao' => $descricao]);
        }
    }

    // Evita reenvio
    header("Location: index.php");
    exit;
}

// EXCLUIR habitat
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Verifica se há animais vinculados
    $check = $pdo->prepare("SELECT COUNT(*) FROM animais WHERE id_habitat = :id");
    $check->execute(['id' => $id]);
    $temAnimais = $check->fetchColumn();

    if ($temAnimais == 0) {
        $stmt = $pdo->prepare("DELETE FROM habitats WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } else {
        echo "<script>alert('Não é possível excluir este habitat porque existem animais vinculados a ele.');</script>";
    }

    header("Location: index.php");
    exit;
}

// Buscar habitats
$sql = "SELECT * FROM habitats ORDER BY descricao";
$stmt = $pdo->query($sql);
$listaHabitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar animais por habitat
$sqlAnimais = "SELECT h.id AS habitat_id, h.descricao AS habitat, a.nome_popular, a.nome_cientifico, a.quantidade
               FROM habitats h
               LEFT JOIN animais a ON a.id_habitat = h.id
               ORDER BY h.descricao";
$stmtAnimais = $pdo->query($sqlAnimais);
$dados = $stmtAnimais->fetchAll(PDO::FETCH_ASSOC);

$habitatsAnimais = [];
foreach ($dados as $linha) {
    $habitatsAnimais[$linha['habitat']][] = $linha;
}

// Ver se estamos editando
$habitatEditar = null;
if (isset($_GET['edit'])) {
    $idEdit = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = :id");
    $stmt->execute(['id' => $idEdit]);
    $habitatEditar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Habitats Marinhos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h1 class="text-center mb-4">Habitats Marinhos</h1>

  <!-- Formulário -->
  <div class="card mx-auto mb-4" style="max-width: 500px;">
    <div class="card-body">
      <h5 class="card-title"><?= $habitatEditar ? 'Editar Habitat' : 'Cadastrar novo Habitat' ?></h5>
      <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $habitatEditar['id'] ?? '' ?>">
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição</label>
          <input type="text" class="form-control" name="descricao" id="descricao" required value="<?= $habitatEditar['descricao'] ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-success w-100">
          <?= $habitatEditar ? 'Salvar Alterações' : 'Cadastrar' ?>
        </button>
        <?php if ($habitatEditar): ?>
          <a href="habitats.php" class="btn btn-secondary mt-2 w-100">Cancelar</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- Lista com opções de editar/excluir -->
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <?php foreach ($listaHabitats as $habitat): ?>
        <div class="card mb-3 shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-1"><?= htmlspecialchars($habitat['descricao']) ?></h5>
              <?php if (!empty($habitatsAnimais[$habitat['descricao']][0]['nome_popular'])): ?>
                <ul class="mb-0">
                  <?php foreach ($habitatsAnimais[$habitat['descricao']] as $animal): ?>
                    <?php if ($animal['nome_popular']): ?>
                      <li>
                        <?= htmlspecialchars($animal['nome_popular']) ?> (<?= htmlspecialchars($animal['nome_cientifico']) ?>) - <?= $animal['quantidade'] ?> unid.
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <p class="text-muted mb-0">Nenhum animal neste habitat.</p>
              <?php endif; ?>
            </div>
            <div class="ms-3 text-end">
              <a href="?edit=<?= $habitat['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
              <a href="?delete=<?= $habitat['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este habitat?')">Excluir</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    include "../components/footer.php";
?>

