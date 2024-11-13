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

// Obtém o ID do usuário da URL
$usuario_id = isset($_GET['id']) ? $_GET['id'] : null;  

// Se o ID do usuário não for passado, retorna um erro
if (!$usuario_id) {
    sendResponse(400, ['message' => 'Erro: ID do usuário não fornecido!']);
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
        sendResponse(404, ['message' => 'Erro: Usuário não encontrado!']);
    }

    // Retorna os dados do usuário com status 200 (sucesso)
    sendResponse(200, $usuario);

} catch (PDOException $e) {
    // Caso ocorra um erro na consulta, retorna um erro 500
    sendResponse(500, ['message' => 'Erro ao acessar os dados do usuário: ' . $e->getMessage()]);
}
