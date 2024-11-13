<?php
    session_start();
    ob_start();

    include_once 'conexao.php';
    include 'css/functions.php';
    include_once 'menu.php';
    include_once 'menu_admin.php';

    // Debug para verificar o conteúdo da sessão
    // var_dump($_SESSION);

    // Verificar se o usuário está logado e se é administrador
    //if (!isset($_SESSION['id_usuario']) || $_SESSION['statusAdministrador_usuario'] !== 'a') {
        // Redireciona para uma página de login
        //$_SESSION['mensagem'] = "Acesso negado! Somente administradores podem acessar esta página.";
        //header("Location: login.php"); 
        //exit(); // Para garantir que o restante da página não será carregado
    //}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Usuários Cadastrado</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container_background_image_grow">
        <div class="container_whitecard_grow">
            <div class="container_form">
                <div class="form-title-big">
                    <button>Lista de Cadastrados</button>
                    <div class="toggle-line-big"></div>
                </div>

                <!-- Caixa de Pesquisa -->
                <div style="position: relative; width: 90%; align-items: center;">
                    <form method="GET" action="">
                        <input type="text" name="search" id="search" placeholder="Pesquisar Usuário..." style="width: 100%; padding-right: 40px; height: 40px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="button-search" style="position: absolute; right: 0; top: 0; height: 40px; width: 10%; border-radius: 0 8px 8px 0; border: none;">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>

                <?php
                // Páginação e pesquisa
                $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
                $pagina = !empty($pagina_atual) ? $pagina_atual : 1;
                $limite_resultado = 7;
                $inicio = ($limite_resultado * $pagina) - $limite_resultado;

                // Pesquisa
                $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $search_param = '%' . $search . '%'; // Permite correspondências parciais

                try {
                    // Debugging: Log query string
                    error_log("Search term: $search");

                    $query_usuario = "SELECT id_usuario, nome_usuario, email_usuario, imagem_usuario, statusAdministrador_usuario
                                      FROM usuario
                                      WHERE nome_usuario LIKE :search OR email_usuario LIKE :search
                                      LIMIT :inicio, :limite";

                    $result_usuario = $conn->prepare($query_usuario);

                    // Bind the search term and pagination params correctly
                    $result_usuario->bindParam(':search', $search_param, PDO::PARAM_STR);
                    $result_usuario->bindValue(':inicio', (int) $inicio, PDO::PARAM_INT);
                    $result_usuario->bindValue(':limite', (int) $limite_resultado, PDO::PARAM_INT);
                    $result_usuario->execute();

                    // Fetch results into an array
                    $usuarios = $result_usuario->fetchAll(PDO::FETCH_ASSOC);

                    // Check if query execution was successful
                    if ($usuarios === false) {
                        throw new Exception("Query failed to execute.");
                    }

                    // Check if there are users found
                    if (!empty($usuarios)) {
                        // Loop through each user and display
                        foreach ($usuarios as $usuario) {
                            // Extract user info
                            $id_usuario = htmlspecialchars($usuario['id_usuario']);
                            $nome_usuario = htmlspecialchars($usuario['nome_usuario']) ?? 'Nome do Usuário Indisponível';
                            $email_usuario = htmlspecialchars($usuario['email_usuario']);
                            $imagem_usuario = htmlspecialchars($usuario['imagem_usuario']) ?? 'caminho/default_image.jpg';
                            $statusAdministrador_usuario = htmlspecialchars($usuario['statusAdministrador_usuario']);

                            // Display user card
                            ?>

<div class="projcard-small">
    <a href="registro_usuario.php?id_usuario=<?php echo htmlspecialchars($id_usuario); ?>" style="text-decoration: none; display: block;">
        <div class="projcard-innerbox">
            <img class="projcard-img" src="<?php echo htmlspecialchars($imagem_usuario); ?>" alt="Imagem do Usuário">
            <div class="projcard-textbox">
                <div class="projcard-subtitle">
                    <?php echo '<br><i class="fa-regular fa-address-card" style="color: #fe797b;"></i> ' . htmlspecialchars($nome_usuario) . '<span style="margin-left: 10px;"></span><i class="fa-solid fa-fingerprint" style="color: #ffb750;"></i> ' . htmlspecialchars($id_usuario); ?>                
                    <div class="projcard-bar"></div>          
                </div>
                <div class="projcard-description">
                    <?php
                        echo '<i class="fa-solid fa-envelope" style="color: #36cedc;"></i> ' . htmlspecialchars($email_usuario) . '<br>';
                        if ($statusAdministrador_usuario == 'a') {
                            echo '<i class="fa-solid fa-lock-open" style="color: #a587ca;"></i> Admin';
                        } elseif ($statusAdministrador_usuario == 'b') {
                            echo '<i class="fa-solid fa-lock" style="color:#8f8f8f;"></i> Banido';
                        } elseif ($statusAdministrador_usuario == 'c') {
                            echo '<i class="fa-solid fa-unlock" style="color: #a587ca;"></i> Comum';
                        } else {
                            echo 'Status Desconhecido';
                        }
                    ?>
                </div>
                <!-- <div class="projcard-tagbox">
                    <span class="projcard-tag">
                        <?php 
                        if ($statusAdministrador_usuario == 'a') {
                            echo 'Admin';
                        } elseif ($statusAdministrador_usuario == 'b') {
                            echo 'Banido';
                        } elseif ($statusAdministrador_usuario == 'c') {
                            echo 'Comum';
                        } else {
                            echo 'Status Desconhecido';
                        }
                        ?>
                    </span>
                </div> -->
            </div>
        </div>
    </a>
</div>

                            <?php
                        }

                        // Paginação
                        $query_total = "SELECT COUNT(*) as total FROM usuario WHERE nome_usuario LIKE :search OR email_usuario LIKE :search";
                        $result_total = $conn->prepare($query_total);
                        $result_total->bindParam(':search', $search_param, PDO::PARAM_STR);
                        $result_total->execute();
                        $total_registros = $result_total->fetch(PDO::FETCH_ASSOC)['total'];
                        $total_paginas = ceil($total_registros / $limite_resultado);

                        // Links de navegação
                        echo '<div class="pagination">';
                        if ($pagina > 1) {
                            echo '<a href="?page=' . ($pagina - 1) . '&search=' . urlencode($search) . '">Anterior</a>';
                        }
                        for ($i = 1; $i <= $total_paginas; $i++) {
                            if ($i == $pagina) {
                                echo '<strong>' . $i . '</strong>';
                            } else {
                                echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a>';
                            }
                        }
                        if ($pagina < $total_paginas) {
                            echo '<a href="?page=' . ($pagina + 1) . '&search=' . urlencode($search) . '">Próximo</a>';
                        }
                        echo '</div>';
                    } else {
                        // No users found
                        $_SESSION['mensagem'] = "Nenhum usuário encontrado";

                    }
                } catch (PDOException $e) {
                    // Error handling
                    error_log($e->getMessage());
                    echo '<p>Ocorreu um erro ao buscar os usuários. Por favor, tente novamente mais tarde.</p>';
                } catch (Exception $e) {
                    // Catching custom query errors
                    error_log($e->getMessage());
                    echo '<p>Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
        // Display session message, if any
        if (isset($_SESSION['mensagem'])) {
            echo "<script>window.onload = function() { alert('" . $_SESSION['mensagem'] . "'); }</script>";
            unset($_SESSION['mensagem']);
        }
    ?>
</body>
</html>