<?php
include 'css/functions.php';

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "api_rest";
$port = 3306;

try{
    //Conexao com a porta
    $conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<p style='color: green; margin-left: 10px;'><br>Conexão com banco de dados realizada com sucesso";

    //Conexao sem a porta
    //$conn = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);
            
} catch(PDOException $err){
    echo "<p style='color: #f00; margin-left: 10px;'>Erro: Conexão com banco de dados não realizada com sucesso - ". $err->getMessage();
}