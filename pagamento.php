<?php
require_once("banco.php");

header("Content-Type: application/json");

$pdo = conectar();

$pdo->prepare(
    "INSERT INTO pagamentos VALUES (0, ?, 'Simulado')"
)->execute([
    $_POST["id"]
]);

$pdo->prepare(
    "UPDATE agendamentos SET status='Pago' WHERE id=?"
)->execute([
    $_POST["id"]
]);

echo json_encode([
    "sucesso" => true
]);
?>
