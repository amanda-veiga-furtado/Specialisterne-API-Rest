<?php

session_start(); // Inicia a sessão

include_once '../conexao.php'; // Corrigido o caminho do include

$id_usuario = filter_input(INPUT_GET, "id_usuario", FILTER_SANITIZE_NUMBER_INT); // Obtém o ID do usuário da URL e filtra como um número inteiro

if (empty($id_usuario)) { // Verifica se o ID do usuário está vazio
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: registro_usuario.php");
    exit();
}

try {
    // Usando prepared statement com placeholders
    $query_usuario = "SELECT id_usuario FROM usuario WHERE id_usuario = :id_usuario LIMIT 1";
    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result_usuario->execute();

    if ($result_usuario && $result_usuario->rowCount() != 0) {
        $query_del_usuario = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $apagar_usuario = $conn->prepare($query_del_usuario);
        $apagar_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        
        if ($apagar_usuario->execute()) {
            $_SESSION['msg'] = "<p style='color: green;'>Usuário apagado com sucesso!</p>";
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não apagado com sucesso!</p>";
        }
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    }
} catch (PDOException $e) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: " . $e->getMessage() . "</p>";
}

header("Location: registro_usuario.php");
exit();

?>
