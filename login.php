<?php

session_start();

require_once 'banco.php';

header('Content-Type: application/json; charset=utf-8');

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Preencha o e-mail e a senha.'
    ]);

    exit;
}

try {
    $cliente = buscarCliente($email);

    if ($cliente && password_verify($senha, $cliente['senha'])) {
        $_SESSION['user'] = [
            'id' => $cliente['id'],
            'nome' => $cliente['nome'],
            'email' => $cliente['email']
        ];

        echo json_encode([
            'sucesso' => true,
            'mensagem' => 'Login realizado!'
        ]);
    } else {
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'E-mail ou senha inválidos.'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Não foi possível realizar o login.'
    ]);
}
?>
