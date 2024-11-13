<?php
// Inicia a sessão, se necessário para controle de erros
session_start();

// Inclui a conexão com o banco de dados e outras funções, caso necessário
include_once 'conexao.php';

// Define que a resposta será no formato JSON
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
    // Preparar e executar a consulta SQL para buscar os usuários
    $stmt = $conn->prepare("SELECT id_usuario, nome_usuario, email_usuario, telefone_usuario, endereco_usuario FROM usuario");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se encontrou usuários
    if (count($usuarios) > 0) {
        // Retorna a lista de usuários com status 200 (sucesso)
        sendResponse(200, $usuarios);
    } else {
        // Retorna uma mensagem de erro caso não encontre usuários
        sendResponse(404, [
            'message' => 'Nenhum usuário encontrado'
        ]);
    }
} catch (PDOException $e) {
    // Caso ocorra um erro na consulta
    sendResponse(500, [
        'message' => 'Erro ao buscar usuários: ' . $e->getMessage()
    ]);
}
?>
