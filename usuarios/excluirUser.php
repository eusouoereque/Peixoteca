<?php 
    session_start();

    require_once "../db/conn.php";
    require_once "../helpers.php";

    if (isset($_GET['id']) && empty($_GET['id']) == false) {
        $id = $_GET['id'];
        // Excluir outro usuario
        if ($_SESSION['id_logado'] && $id != $_SESSION['id_logado']) {
            header('Location: ./index.html');
            exit;
        }

        //Verifica se não criou animais
        $sql = "SELECT COUNT(*) FROM animais
                WHERE id_criador = '$id'";
        $query = $pdo->query($sql);
        $total = $query->fetchColumn();
        if ($total > 0) {
            echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
                    <script type=\"text/javascript\">
                        alert(\"Usuário possui animais cadastrados, não pode ser deletado!\");
                    </script>";
            exit;
        }
        // Exclui usuario
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=../login/logout.php'>
                    <script type=\"text/javascript\">
                        alert(\"Usuário deletado, encerrando a sessão...\");
                    </script>";
        exit;
    } else {
        header('Location: ../usuarios/');
        exit;
    }
    
?>