<?php
require_once("banco.php");

header("Content-Type: application/json");

$pdo = conectar();

$st = $pdo->prepare("INSERT INTO clientes VALUES (0, ?, ?, ?)");

$st->execute([
    $_POST["nome"],
    $_POST["email"],
    md5($_POST["senha"])
]);

echo json_encode([
    "sucesso" => true,
    "mensagem" => "Conta criada"
]);
?>
