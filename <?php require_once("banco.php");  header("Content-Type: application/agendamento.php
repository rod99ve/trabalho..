<?php
require_once("banco.php");

header("Content-Type: application/json");

$pdo = conectar();

$st = $pdo->prepare(
    "INSERT INTO agendamentos VALUES (0, ?, ?, ?, ?, ?, 'Pendente')"
);

$st->execute([
    $_POST["nome"],
    $_POST["email"],
    $_POST["servico"],
    $_POST["data"],
    $_POST["hora"]
]);

echo json_encode([
    "sucesso" => true
]);
?>
