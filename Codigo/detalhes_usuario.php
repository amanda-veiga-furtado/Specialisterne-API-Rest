<?php  
session_start();
ob_start();

include_once 'conexao.php';
include 'css/functions.php';
include_once 'menu.php';

$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;  // Obtém o ID do usuário da URL

// Se o ID do usuário não for passado, redireciona ou exibe mensagem de erro
if (!$usuario_id) {
    $_SESSION['mensagem'] = "Erro: ID do usuário não fornecido!";
    header("Location: index.php");  // Redireciona para a página inicial, por exemplo
    exit();
}

try {
    // Consulta para obter os dados do usuário
    $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, email_usuario, telefone_usuario, endereco_usuario 
                            FROM usuario WHERE id_usuario = :id_usuario");
    $stmt->bindParam(':id_usuario', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();

    // Verifica se o usuário foi encontrado
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        $_SESSION['mensagem'] = "Erro: Usuário não encontrado!";
        header("Location: index.php");  // Redireciona para a página inicial, por exemplo
        exit();
    }

} catch (PDOException $e) {
    $_SESSION['mensagem'] = "Erro ao acessar os dados do usuário: " . $e->getMessage();
    header("Location: index.php");  // Redireciona em caso de erro
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .user-details {
            margin-top: 20px;
            font-size: 1.1em;
        }

        .user-details p {
            margin: 10px 0;
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .message {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            border-radius: 5px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Detalhes do Usuário</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="message">
                <?php echo htmlspecialchars($_SESSION['mensagem'], ENT_QUOTES); ?>
            </div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <div class="user-details">
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome_usuario'], ENT_QUOTES); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($usuario['email_usuario'], ENT_QUOTES); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['telefone_usuario'], ENT_QUOTES); ?></p>
            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($usuario['endereco_usuario'], ENT_QUOTES); ?></p>
        </div>

        <a href="listagem_cadastros.php" class="back-button">Voltar para a lista de usuários</a>
    </div>

</body>
</html>
