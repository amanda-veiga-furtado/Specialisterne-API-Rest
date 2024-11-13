<?php
session_start();
ob_start();

// Verifica se existe uma mensagem no parâmetro da URL
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
    echo "<script>alert('$mensagem');</script>";
}

include_once 'conexao.php'; 
include 'css/functions.php';
include_once 'menu.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Login | Cadastro</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container_background_image_medium">
            <div class="whitecard_form_type_1">
                <div class="container_form">
                    <div class="form_switch">
                        <div class="form-toggle">
                            <button id="loginBtn" onclick="showLogin()">Login</button> <!-- Exibir o formulário de login -->

                            <div id="toggleLine" class="toggle-line-big"></div> <!-- Linha colorida de seleção atual -->
                    </div>
                    
                    <!-- Login --------------------------------------------------------------------------->
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SendLogin'])) {
                            $email_usuario = $_POST['email_usuario'];
                            $senha_usuario = $_POST['senha_usuario'];

                            try {

                                $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, senha_usuario, statusAdministrador_usuario FROM usuario WHERE email_usuario = :email_usuario");


                                $stmt->bindParam(':email_usuario', $email_usuario);
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                                    if ($usuario['statusAdministrador_usuario'] == 'b') {
                                        $_SESSION['mensagem'] = "Você foi suspenso pelo Administrador!";

                                    }elseif (password_verify($senha_usuario, $usuario['senha_usuario'])) {
                                        $_SESSION['id_usuario'] = $usuario['id_usuario'];
                                        $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
                                        $_SESSION['email_usuario'] = $email_usuario;


                                        $_SESSION['statusAdministrador_usuario'] = $usuario['statusAdministrador_usuario']; 
                                        
                                        header("Location: dashboard.php");
                                        exit();
                                    } else {
                                        // $_SESSION['mensagem'] = "Senha incorreta!";
                                        $_SESSION['mensagem'] = "Login Invalido!";

                                    }
                                } else {
                                    // $_SESSION['mensagem'] = "Usuário não encontrado!";
                                    $_SESSION['mensagem'] = "Login Invalido!";

                                }
                            } catch (PDOException $e) {
                                $_SESSION['mensagem'] = "Erro ao verificar o usuário!";
                            }
                        }
                    ?>
                    <form id="loginForm" class="form" method="POST" action="" style="display: block;">
                        <h2>Bem-Vindo(a) de Volta!</h2>
                        <!-- <h2>Bem-Vindo(a) de Volta!</h2> -->
                        <!-- <h2>Bem-Vindo(a)! Faça login ou cadastre-se para acessar sua conta</h2> -->
                        <!-- <h2>Bem-Vindo(a)! Cadastre-se para criar sua conta ou faça login se já tiver uma</h2> -->
                        <!-- <h2>Bem-Vindo(a)! Faça login ou crie uma conta!</h2> -->


                        <input type="email" name="email_usuario"  placeholder="Email" required>
                        <input type="password" name="senha_usuario" placeholder="Senha" required>
                        <div class="container-button-long">

                        <input type="submit" name="SendLogin" value="Entrar" class="button-long">
                        <div class="div_link"><a href="recuperar_senha/recuperar_senha.php">Recuperar Acesso</a></div>
                        </div>
                    </form>


                </div>
                </div>
            </div>
        </div>

        <!-- Exibir a mensagem como alerta, caso exista -->
        <?php
            if (isset($_SESSION['mensagem'])) {
                echo "<script>window.onload = function() { alert('" . $_SESSION['mensagem'] . "'); }</script>";
                unset($_SESSION['mensagem']);
            }
        ?>
    </body>
</html>
