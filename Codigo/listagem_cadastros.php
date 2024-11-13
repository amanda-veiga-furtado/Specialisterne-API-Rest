<?php
session_start();
ob_start();

include_once 'conexao.php';
include 'css/functions.php';
include_once 'menu.php';

try {
    // Consultar os usuários
    $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, email_usuario, telefone_usuario, endereco_usuario FROM usuario");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $_SESSION['mensagem'] = "Erro ao buscar usuários: " . $e->getMessage();
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
    <title>Usuários Cadastrados</title>
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

        .user-list {
            margin-top: 20px;
            font-size: 1.1em;
        }

        .user-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-list th, .user-list td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .user-list th {
            background-color: #f8f9fa;
        }

        .view-link {
            color: #007bff;
            text-decoration: none;
        }

        .view-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Usuários Cadastrados</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="message">
                <?php echo htmlspecialchars($_SESSION['mensagem'], ENT_QUOTES); ?>
            </div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <div class="user-list">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id_usuario'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome_usuario'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email_usuario'], ENT_QUOTES); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefone_usuario'], ENT_QUOTES); ?></td>
                            <td>
                                <a href="detalhes_usuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="view-link">Ver Detalhes</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
