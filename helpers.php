<?php
    function usuarioEstaLogado() {
        return isset($_SESSION['usuario_logado']); 
    }
?>