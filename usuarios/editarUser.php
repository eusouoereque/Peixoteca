<?php 
    include "../components/header.php";
    include "../components/nav.php";
    require_once "../db/conn.php";
?>

<?php


// Guarda o id do personagem em uma variável
$id = addslashes($_GET['id']);

// Guarda os valores passados pelo formulário editado
if (isset($_POST['nome']) && empty($_POST['nome']) == false) {
    $nome = addslashes($_POST['nome']);
    $login = addslashes($_POST['login']);
    
    
   

    // SQL UPDATE
    $sql = "UPDATE usuarios SET nome = '$nome', login = '$login'
            WHERE id = '$id'";

    // PDO executa o UPDATE
    $sql = $pdo->query($sql);

    // Confirma o UPDATE e direciona para a pág. personagem
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'>
          <script type=\"text/javascript\">
              alert(\"Usuário atualizado com sucesso!\");
          </script>";
}

?>


<?php
    // Verifica se o id foi passado
    if (isset($_GET['id']) && empty($_GET['id']) == false) {
        // Guarda o id em uma variável
        $id = addslashes($_GET['id']);
        // Seleciona os dados do id passado
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        // PDO executa a query
        $sql = $pdo->query($sql);
        // Verifica se foi retornado algum registro
        if ($sql->rowCount() > 0) {
            // retorna a variável $personagem[]
            foreach ($sql->fetchAll() as $usuarios) {
            }
        }
    }
?>









<form  method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome: </label>
            <input value="<?php echo $usuarios['nome']?>" type="text" class="from-control" id="nome" placeholder="Entre com o nome" name="nome">
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Login:</label>
            <input value="<?php echo $usuarios['login']?>" type="text" class="from-control" id="login" placeholder="Entre com o Login" name="login">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>







<?php
    include "../components/footer.php";
?>