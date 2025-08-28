<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . './../database/Database.php';

if (!empty($_POST)) {
    $nome = $_POST['novoNome'] ?? '';
    $id = $_POST['id'] ?? '';

    // Validação simples
    if (empty($nome) && empty($id)) {
        echo 'Preencha todos os campos.';
        exit;
    }

    $conn = (new Database())->getConnection();
    $sql = 'UPDATE usuarios SET nome = :nome WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'id' => $id
    ]);
}

// Redireciona para index.php após inserir
header('Location: ./../view/index.php');
exit;
