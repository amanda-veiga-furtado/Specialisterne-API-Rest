<?php
$config = include 'config.php';

try {
    $conn = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}",
        $config['user'],
        $config['pass']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    error_log("Erro na conexão com o banco de dados: " . $err->getMessage());
    die("Erro ao conectar ao banco de dados.");
}
