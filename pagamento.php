<?php

session_start();

require_once "banco.php";

header("Content-Type: application/json; charset=utf-8");

$id = intval($_POST["id"] ?? 0);
$metodo = trim($_POST["metodo"] ?? "Pix");

if ($id <= 0) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Agendamento inválido."
    ]);

    exit;
}

try {

    registrarPagamento($id, $metodo);

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Pagamento confirmado!"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Erro ao confirmar o pagamento."
    ]);

}
?>
