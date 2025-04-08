<?php 
    $dsn = "mysql:dbname=peixoteca";

    $dbuser = "root";

    $dbpass = "";

    try {
        $pdo = new PDO($dsn, $dbuser, $dbpass);
    } catch (PDOException $e) {
        echo "Falha ao conectar na base de dados!";
    }
?>