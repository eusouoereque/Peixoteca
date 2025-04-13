<?php

// Conexão com o BD
require_once "../db/conn.php";

// Verifica se o Id veio com valor
if (isset($_GET['id']) && empty($_GET['id']) == false) {
    // Grava o Id em uma variável
    $id = addslashes($_GET['id']);
    // Delete SQL
    $sql = "DELETE FROM usuarios WHERE id = '$id'";
    // PDO executa o Delete
    $sql = $pdo->query($sql);
    // Confirma a exclusão
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
    <script type=\"text/javascript\">
        alert(\"Exclusão realizada com sucesso!\");
    </script>";
} else {
    // Retorna que deu erro
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
    <script type=\"text/javascript\">
        alert(\"Algo deu errado!\");
    </script>";
}

?>