<?php  
session_start();
ob_start();

include_once 'conexao.php'; // Conexão com o banco de dados
include 'css/functions.php'; // Funções adicionais, se necessário
include_once 'menu.php'; // Menu, se aplicável

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CadUsuario'])) {
    // Dados do formulário
    $nome_usuario = trim($_POST['nome_usuario']);
    $email_usuario = trim($_POST['email_usuario']);
    $cep = trim($_POST['cep']);
    $estado = trim($_POST['estado']);
    $cidade = trim($_POST['cidade']);
    $bairro = trim($_POST['bairro']);
    $rua = trim($_POST['rua']);
    $numero_end = trim($_POST['numero_end']);
    $complemento = trim($_POST['complemento']);
    $codigo_telefonico_pais = trim($_POST['codigo_telefonico_pais']);
    $codigo_telefonico_estado = trim($_POST['codigo_telefonico_estado']);
    $numero_telefonico = trim($_POST['numero_telefonico']);
    $senha_usuario = trim($_POST['senha_usuario']);

    // Validações
    if (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensagem'] = "Erro: E-mail inválido!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (empty($cep) || empty($estado) || empty($cidade) || empty($bairro) || empty($rua) || empty($numero_end)) {
        $_SESSION['mensagem'] = "Erro: Todos os campos do endereço devem ser preenchidos!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (!ctype_digit($codigo_telefonico_pais) || !ctype_digit($codigo_telefonico_estado) || !ctype_digit($numero_telefonico)) {
        $_SESSION['mensagem'] = "Erro: O telefone deve conter apenas números!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Concatena os dados formatados
    $telefone_usuario = $codigo_telefonico_pais . $codigo_telefonico_estado . $numero_telefonico;
    $endereco_usuario = "$rua, $numero_end, $complemento - $bairro, $cidade/$estado - CEP: $cep";

    // Hash da senha
    $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);

    // Criação do array associativo para JSON
    $dados_usuario = [
        'nome_usuario' => $nome_usuario,
        'email_usuario' => $email_usuario,
        'telefone_usuario' => $telefone_usuario,
        'endereco_usuario' => $endereco_usuario,
        'senha_usuario' => $senha_hash
    ];

    // Converte o array em JSON
    $dados_json = json_encode($dados_usuario);

    try {
        // Verifica duplicidade de e-mail
        $stmt = $conn->prepare("SELECT email_usuario FROM usuario WHERE email_usuario = :email_usuario");
        $stmt->bindParam(':email_usuario', $email_usuario);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $_SESSION['mensagem'] = "Erro: E-mail já cadastrado!";
        } else {
            // Insere o novo usuário
            $stmt = $conn->prepare(
                "INSERT INTO usuario (dados_json) VALUES (:dados_json)"
            );
            $stmt->bindParam(':dados_json', $dados_json);
            $stmt->execute();

            $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro: Usuário não cadastrado! " . $e->getMessage();
    }

    // Redireciona para evitar reenvio de formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Usuário</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .mensagem {
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
    <div class="container_background_image_grow">
        <div class="container_whitecard_grow">
            <div class="container_form">
                <div class="form-title-big">
                    <button>Cadastrar-se</button>
                    <div class="toggle-line-big"></div>
                </div>
                <?php if (isset($_SESSION['mensagem'])): ?>
                    <div class="mensagem">
                        <?php echo htmlspecialchars($_SESSION['mensagem'], ENT_QUOTES); ?>
                    </div>
                    <?php unset($_SESSION['mensagem']); ?>
                <?php endif; ?>

                <form name="cad-usuario" id="cad-usuario" method="POST" action="" enctype="multipart/form-data" style="width: 100%;">
                    <h2>Nome Completo</h2>
                    <input type="text" name="nome_usuario" id="nome_usuario" style="width: 100%;" required><br>

                    <h2>Telefone</h2>
                    <label for="codigo_telefonico_pais">+</label>
                    <input type="tel" name="codigo_telefonico_pais" id="codigo_telefonico_pais" style="width: 12%;" required pattern="\d*">
                    <input type="tel" name="codigo_telefonico_estado" id="codigo_telefonico_estado" style="width: 12%;" required pattern="\d*">
                    <input type="tel" name="numero_telefonico" id="numero_telefonico" style="width: 72%;" required pattern="\d*"><br>

                    <h2>E-mail</h2>
                    <input type="email" name="email_usuario" id="email_usuario" style="width: 100%;" required><br>

                    <h2>Endereço Completo</h2>
                    <input type="text" name="cep" id="cep" style="width: 100%;" required pattern="\d*"><br>
                    <input type="text" name="estado" id="estado" style="width: 49%;" required>
                    <input type="text" name="cidade" id="cidade" style="width: 49%;" required><br>
                    <input type="text" name="bairro" id="bairro" style="width: 100%;" required><br>
                    <input type="text" name="rua" id="rua" style="width: 80%;" required>
                    <input type="text" name="numero_end" id="numero_end" style="width: 19%;" required pattern="\d*"><br>
                    <input type="text" name="complemento" id="complemento" style="width: 100%;" required><br>

                    <h2>Senha</h2>
                    <input type="password" name="senha_usuario" id="senha_usuario" style="width: 100%;" required><br>

                    <input type="submit" name="CadUsuario" value="Cadastrar" class="button-long">
                </form>
            </div>     
        </div>
    </div>
</body>
</html>
