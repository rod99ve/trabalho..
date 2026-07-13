<?php

session_start();

require_once "banco.php";

header("Content-Type: application/json; charset=utf-8");

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$servico = trim($_POST["servico"] ?? "");
$data = trim($_POST["data"] ?? "");
$hora = trim($_POST["hora"] ?? "");

if (
    $nome == "" ||
    $email == "" ||
    $servico == "" ||
    $data == "" ||
    $hora == ""
) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Preencha todos os dados do agendamento."
    ]);

    exit;
}

try {

    $id = criarAgendamento(
        $nome,
        $email,
        $servico,
        $data,
        $hora
    );

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Agendamento realizado!",
        "id" => $id
    ]);

} catch (Exception $e) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao realizar o agendamento."
    ]);

}
?>
