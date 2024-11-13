<?php 
session_start();
ob_start();

include_once 'conexao.php';
include 'css/functions.php';
include_once 'menu.php';

$dados = []; // Array para armazenar os dados enviados no formulário

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CadUsuario'])) {
    $nome_usuario = trim($_POST['nome_usuario']);
    $telefone_usuario = "";
    $email_usuario = trim($_POST['email_usuario']);

    // Validação do formato de e-mail
    if (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensagem'] = "Erro: E-mail inválido!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validação e concatenação do endereço
    $cep = trim($_POST['cep']);
    $estado = trim($_POST['estado']);
    $cidade = trim($_POST['cidade']);
    $bairro = trim($_POST['bairro']);
    $rua = trim($_POST['rua']);
    $numero_end = trim($_POST['numero_end']);
    $complemento = trim($_POST['complemento']);

    // Verifica se todos os campos de endereço foram preenchidos
    if (!empty($cep) && !empty($estado) && !empty($cidade) && !empty($bairro) && !empty($rua) && !empty($numero_end)) {
        $endereco_usuario = "$rua, $numero_end, $complemento - $bairro, $cidade/$estado - CEP: $cep";
    } else {
        $_SESSION['mensagem'] = "Erro: Todos os campos do endereço devem ser preenchidos!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $senha_usuario = trim($_POST['senha_usuario']);

    // Validação e concatenação do telefone
    $codigo_telefonico_pais = trim($_POST['codigo_telefonico_pais']);
    $codigo_telefonico_estado = trim($_POST['codigo_telefonico_estado']);
    $numero_telefonico = trim($_POST['numero_telefonico']);

    if (ctype_digit($codigo_telefonico_pais) && ctype_digit($codigo_telefonico_estado) && ctype_digit($numero_telefonico)) {
        $telefone_usuario = $codigo_telefonico_pais . $codigo_telefonico_estado . $numero_telefonico;
    } else {
        $_SESSION['mensagem'] = "Erro: O telefone deve conter apenas números!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);

    $dados = $_POST; // Armazena os dados para repopular o formulário em caso de erro

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
                "INSERT INTO usuario (nome_usuario, telefone_usuario, email_usuario, endereco_usuario, senha_usuario) 
                VALUES (:nome_usuario, :telefone_usuario, :email_usuario, :endereco_usuario, :senha_usuario)"
            );

            $stmt->bindParam(':nome_usuario', $nome_usuario);
            $stmt->bindParam(':telefone_usuario', $telefone_usuario);
            $stmt->bindParam(':email_usuario', $email_usuario);
            $stmt->bindParam(':endereco_usuario', $endereco_usuario);
            $stmt->bindParam(':senha_usuario', $senha_hash);
            $stmt->execute();

            $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
            $dados = []; // Limpa os dados após sucesso
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
                    <input type="text" name="nome_usuario" id="nome_usuario" 
                           value="<?php echo isset($dados['nome_usuario']) ? htmlspecialchars($dados['nome_usuario'], ENT_QUOTES) : ''; ?>" 
                           style="width: 100%;" required><br>

                    <h2>Telefone</h2>
                    <label for="codigo_telefonico_pais">+</label>
                    <input type="tel" name="codigo_telefonico_pais" id="codigo_telefonico_pais" placeholder=""
                           value="<?php echo isset($dados['codigo_telefonico_pais']) ? htmlspecialchars($dados['codigo_telefonico_pais'], ENT_QUOTES) : ''; ?>" 
                           style="width: 12%;" required pattern="\d*" 
                           title="Apenas números são permitidos" oninput="this.value = this.value.replace(/\D/g, '')">

                       <input type="tel" name="codigo_telefonico_estado" id="codigo_telefonico_estado" placeholder=""
                           value="<?php echo isset($dados['codigo_telefonico_estado']) ? htmlspecialchars($dados['codigo_telefonico_estado'], ENT_QUOTES) : ''; ?>" 
                           style="width: 12%;" required pattern="\d*" 
                           title="Apenas números são permitidos" oninput="this.value = this.value.replace(/\D/g, '')">

                    <input type="tel" name="numero_telefonico" id="numero_telefonico" 
                           value="<?php echo isset($dados['numero_telefonico']) ? htmlspecialchars($dados['numero_telefonico'], ENT_QUOTES) : ''; ?>" 
                           style="width: 72%;" required pattern="\d*" 
                           title="Apenas números são permitidos" oninput="this.value = this.value.replace(/\D/g, '')"><br>

                    <h2>E-mail</h2>
                    <input type="email" name="email_usuario" id="email_usuario" 
                           value="<?php echo isset($dados['email_usuario']) ? htmlspecialchars($dados['email_usuario'], ENT_QUOTES) : ''; ?>" 
                           style="width: 100%;" required><br>

                    <h2>Endereço Completo</h2>
                    <input type="text" name="cep" id="cep" 
                           value="<?php echo isset($dados['cep']) ? htmlspecialchars($dados['cep'], ENT_QUOTES) : ''; ?>" 
                           style="width: 100%;" required pattern="\d*" 
                           title="Apenas números são permitidos" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="CEP"><br>

                    <input type="text" name="estado" id="estado" required style="width: 49%;" placeholder="Estado"><?php echo isset($dados['estado']) ? htmlspecialchars($dados['estado'], ENT_QUOTES) : ''; ?>

                    <input type="text" name="cidade" id="cidade" required style="width: 49%;" placeholder="Cidade"><?php echo isset($dados['cidade']) ? htmlspecialchars($dados['cidade'], ENT_QUOTES) : ''; ?><br>

                    <input type="text" name="bairro" id="bairro" required style="width: 100%;" placeholder="Bairro"><?php echo isset($dados['bairro']) ? htmlspecialchars($dados['bairro'], ENT_QUOTES) : ''; ?><br>

                    <input type="text" name="rua" id="rua" required style="width: 80%;" placeholder="Rua/Avenida"><?php echo isset($dados['rua']) ? htmlspecialchars($dados['rua'], ENT_QUOTES) : ''; ?>

                    <input type="text" name="numero_end" id="numero_end" 
                           value="<?php echo isset($dados['numero_end']) ? htmlspecialchars($dados['numero_end'], ENT_QUOTES) : ''; ?>" 
                           style="width: 19%;" required pattern="\d*" 
                           title="Apenas números são permitidos" oninput="this.value = this.value.replace(/\D/g, '')"placeholder="Número"><br>

                           <input type="text" name="complemento" id="complemento" required style="width: 100%;" placeholder="Complemento"><?php echo isset($dados['complemento']) ? htmlspecialchars($dados['complemento'], ENT_QUOTES) : ''; ?>


                    <h2>Senha</h2>
                    <input type="password" name="senha_usuario" id="senha_usuario" 
                           placeholder="Digite sua senha" style="width: 100%;" required><br>

                    <input type="submit" name="CadUsuario" value="Cadastrar" class="button-long">
                </form>
            </div>     
        </div>
    </div>
</body>
</html>
