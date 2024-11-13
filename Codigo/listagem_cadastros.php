<?php
// Inicia a sessão, se necessário para controle de erros
session_start();

// Inclui a conexão com o banco de dados
include_once 'conexao.php';

// Define que a resposta será em formato JSON
header('Content-Type: application/json');

// Função para enviar a resposta em formato JSON com uma indentação mais legível
function sendResponse($statusCode, $data) {
    // Define o código de status HTTP
    http_response_code($statusCode);
    
    // Converte o array em JSON com indentação para facilitar a leitura
    echo json_encode($data, JSON_PRETTY_PRINT);
    
    // Finaliza a execução do script
    exit();
}

try {
    // Consulta para obter os dados dos usuários
    $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, email_usuario, telefone_usuario, endereco_usuario FROM usuario");
    $stmt->execute();

    // Obtém todos os usuários
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se encontrou algum usuário
    if (count($usuarios) > 0) {
        // Adiciona o link para detalhes em cada usuário
        foreach ($usuarios as &$usuario) {
            // Ajusta o link para detalhes, incluindo o domínio completo (base_url)
            $usuario['link_detalhes'] = "http://" . $_SERVER['HTTP_HOST'] . "/detalhes_usuario.php?id=" . $usuario['id_usuario'];
        }

        // Retorna a lista de usuários com status 200 (sucesso)
        sendResponse(200, $usuarios);
    } else {
        // Caso não haja usuários, retorna mensagem de erro
        sendResponse(404, ['message' => 'Nenhum usuário encontrado']);
    }

} catch (PDOException $e) {
    // Caso ocorra um erro na consulta, retorna erro 500
    sendResponse(500, ['message' => 'Erro ao acessar os dados dos usuários: ' . $e->getMessage()]);
}
?>
