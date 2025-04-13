<?php
    function usuarioEstaLogado(): bool {
        return (isset($_SESSION['usuario_logado']) && empty($_SESSION['usuario_logado']) == false); 
    }

    function apenasLogado() {
        if (!usuarioEstaLogado()) {
            header('Location: ../animais/');
            exit;
        }
    }

    function mensagemLogin(string $msg): string {
        switch ($msg) {
            case 'logout':
                return 'Logout efetuado com sucesso!';
            case 'cadastro':
                return 'Cadastro efetuado com sucesso!';
            default:
                return 'Erro: mensagem não reconhecida!';
        }
    }
?>  