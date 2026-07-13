<?php

session_start();

require_once "banco.php";

header("Content-Type: application/json; charset=utf-8");

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($nome == "" || $email == "" || $senha == "") {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Preencha todos os campos."
    ]);

    exit;
}

try {

    if (buscarCliente($email)) {

        echo json_encode([
            "sucesso" => false,
            "mensagem" => "Este e-mail já está cadastrado."
        ]);

        exit;
    }

    criarCliente($nome, $email, $senha);

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Conta criada com sucesso!"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao criar a conta."
    ]);

}
?>
