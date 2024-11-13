<?php 
session_start();
ob_start(); 

include_once 'conexao.php';
include 'css/functions.php';
include_once 'menu.php'; 
include_once 'menu_admin.php';

// Debug: verifica o conteúdo da sessão
// var_dump($_SESSION);

$id_usuario = filter_input(INPUT_GET, "id_usuario", FILTER_SANITIZE_NUMBER_INT);

if (empty($id_usuario)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: listagem_cadastros.php");
    exit();
}

// Atualiza o status do usuário se o botão de banir/desbanir for clicado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query_update = "";
    if ($_POST['status'] === 'c') {
        $query_update = "UPDATE usuario SET statusAdministrador_usuario = 'b' WHERE id_usuario = :id_usuario";
        $_SESSION['msg'] = "<p style='color: #0f0;'>Usuário banido!</p>";
    } elseif ($_POST['status'] === 'b') {
        $query_update = "UPDATE usuario SET statusAdministrador_usuario = 'c' WHERE id_usuario = :id_usuario";
        $_SESSION['msg'] = "<p style='color: #0f0;'>Banimento desfeito!</p>";
    }

    $result_update = $conn->prepare($query_update);
    $result_update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result_update->execute();

    // Redireciona para a mesma página para refletir a alteração
    header("Location: registro_usuario.php?id_usuario=$id_usuario");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Usuário</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container_background_image_small">
        <div class="container_whitecard_small">
            <div class="form-title-big">
                <button>Visualizar Usuário</button>
                <div class="toggle-line-big"></div>
            </div>
            <?php
                // Consulta para buscar os dados do usuário
                $query_usuario = "SELECT id_usuario, nome_usuario, telefone_usuario, email_usuario, endereco_usuario, imagem_usuario, statusAdministrador_usuario
                    FROM usuario
                    WHERE id_usuario = :id_usuario
                    LIMIT 1";
                $result_usuario = $conn->prepare($query_usuario);
                $result_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $result_usuario->execute();

                // Verifica se o usuário foi encontrado
                if (($result_usuario) && ($result_usuario->rowCount() != 0)) {
                    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                    extract($row_usuario);

                    // Debug para verificar os dados retornados
                    // var_dump($row_usuario);
            ?>
            <div class="projcard-subtitle-2">
                <?php 
                    echo '<i class="fa-regular fa-address-card" style="color: #fe797b;"></i> ' . htmlspecialchars($nome_usuario) .  
                    '<br><i class="fa-solid fa-envelope" style="color: #36cedc;"></i> ' . htmlspecialchars($email_usuario) . 
                    '<br>';
                    
                    echo '<i class="fa-solid fa-fingerprint" style="color: #ffb750;"></i> ' . htmlspecialchars($id_usuario) . '<span style="margin-right: 10px;"></span>';

                    if ($statusAdministrador_usuario == 'a') {
                        echo '<i class="fa-solid fa-lock-open" style="color: #a587ca;"></i> Admin';
                    } elseif ($statusAdministrador_usuario == 'b') {
                        echo '<i class="fa-solid fa-lock"></i> Banido';
                    } elseif ($statusAdministrador_usuario == 'c') {
                        echo '<i class="fa-solid fa-unlock" style="color: #a587ca;"></i> Comum';
                    } else {
                        echo 'Status Desconhecido';
                    }

                    // Exibe o telefone e endereço, se disponíveis
                    echo '<br><i class="fa-solid fa-phone" style="color: #36cedc;"></i> ' . 
                        (!empty($telefone_usuario) ? htmlspecialchars($telefone_usuario) : "Telefone não informado.") . 
                        '<br><i class="fa-solid fa-map-marker-alt" style="color: #ffb750;"></i> ' . 
                        (!empty($endereco_usuario) ? htmlspecialchars($endereco_usuario) : "Endereço não informado.");
                ?>
            </div>

            <!-- Formulário para alterar o status -->
            <form method="POST" action="">
                <input type="hidden" name="status" value="<?php echo htmlspecialchars($statusAdministrador_usuario); ?>">
                <br><br>
                <button class="button-yellow"  style="width: 46vw;"
                    <?php echo ($statusAdministrador_usuario == 'a') ? 'disabled' : ''; ?>>
                    <?php 
                        if ($statusAdministrador_usuario == 'b') {
                            echo "Desbanir Usuário";
                        } elseif ($statusAdministrador_usuario == 'a') {
                            echo "Impossível Banir Administrador";
                        } else {
                            echo "Banir Usuário";
                        }
                    ?>
                </button>
            </form>

            <?php
                } else {
                    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
                    header("Location: listagem_cadastros.php");
                    exit();
                }
            ?>
        </div>
    </div>
</body>
</html>
