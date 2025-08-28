<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . './../database/Database.php';

if (!empty($_POST)) {
    $nome = $_POST['nomeCadastro'] ?? '';

    // Validação simples
    if (empty($nome)) {
        echo 'Preencha todos os campos.';
        exit;
    }

    $conn = (new Database())->getConnection();
    $sql = 'INSERT INTO usuarios (nome) VALUES (:nome)';
    $stmt = $conn->prepare($sql);
    $stmt->execute(compact('nome'));
}

// Redireciona para index.php após inserir
header('Location: ./../view/index.php');
exit;
