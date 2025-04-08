<?php
    function usuarioEstaLogado() {
        if (isset($_SESSION['usuario_logado'])) 
            return $_SESSION['usuario_logado'];
        else
            return false;
    }
?>