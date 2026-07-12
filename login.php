<?php
session_start();

require_once("banco.php");

header("Content-Type: application/json");

$pdo = conectar();

$st = $pdo->prepare(
    "SELECT * FROM clientes WHERE email=? AND senha=?"
);

$st->execute([
    $_POST["email"],
    md5($_POST["senha"])
]);

$u = $st->fetch();

if ($u) {

    $_SESSION["user"] = $u;

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Login ok"
    ]);

}
else {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Dados inválidos"
    ]);

}
?>
