<?php 
// Habilitar CORS (opcional, dependendo do uso)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'conexao.php';

try {
    // Configuração de paginação
    $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $pagina = !empty($pagina_atual) ? $pagina_atual : 1;
    $limite_resultado = 7;
    $inicio = ($limite_resultado * $pagina) - $limite_resultado;

    // Parâmetro de busca
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $search_param = '%' . $search . '%';

    // Query para buscar usuários com paginação, incluindo telefone e endereço
    $query_usuario = "SELECT id_usuario, nome_usuario, email_usuario, telefone_usuario, endereco_usuario, statusAdministrador_usuario
                      FROM usuario
                      WHERE nome_usuario LIKE :search OR email_usuario LIKE :search
                      LIMIT :inicio, :limite";

    $stmt = $conn->prepare($query_usuario);
    $stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
    $stmt->bindValue(':inicio', (int) $inicio, PDO::PARAM_INT);
    $stmt->bindValue(':limite', (int) $limite_resultado, PDO::PARAM_INT);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Contar o total de registros para paginação
    $query_total = "SELECT COUNT(*) as total FROM usuario WHERE nome_usuario LIKE :search OR email_usuario LIKE :search";
    $stmt_total = $conn->prepare($query_total);
    $stmt_total->bindParam(':search', $search_param, PDO::PARAM_STR);
    $stmt_total->execute();
    $total_registros = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];

    // Formatar resposta JSON
    $response = [
        "usuarios" => $usuarios,
        "paginacao" => [
            "pagina_atual" => $pagina,
            "total_paginas" => ceil($total_registros / $limite_resultado),
            "total_registros" => $total_registros
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao buscar os usuários."]);
    error_log("Erro PDO: " . $e->getMessage());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro inesperado."]);
    error_log("Erro geral: " . $e->getMessage());
}
