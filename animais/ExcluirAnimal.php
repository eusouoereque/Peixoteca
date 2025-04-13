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

// Excluir animal
$stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
$sucesso = $stmt->execute([$id]);

header("Location: index.php");
exit;
?>