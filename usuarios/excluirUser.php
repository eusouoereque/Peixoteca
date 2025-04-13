<?php
require_once "../db/conn.php";

// Verifica se o ID foi passado corretamente
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);

    // Verifica se existem animais cadastrados com esse usuário como criador
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM animais WHERE id_criador = ?");
    $stmt->execute([$id]);
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Se houver animais relacionados, não permite excluir
    if ($total > 0) {
        echo "<script>
                alert('Este usuário possui animais cadastrados e não pode ser excluído.');
                window.location.href = 'index.php';
              </script>";
        exit;
    }

    // Se não houver animais, pode excluir o usuário
    $sql = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $sql->execute([$id]);

    echo "<script>
            alert('Usuário excluído com sucesso!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('ID de usuário inválido!');
            window.location.href = 'index.php';
          </script>";
}
?>