<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . './../database/Database.php';

$conn = (new Database())->getConnection();

try {
    $conn->beginTransaction();
    $usuarioId = $_GET['usuarioId'];

    $sql = 'DELETE FROM usuarios WHERE id = :usuarioId';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();

    $conn->commit();
} catch (\Throwable $throwable) {
    $conn->rollBack();

    echo 'Ocorreu um erro ao excluir o usuario.'
        . PHP_EOL .
        'Erro: '. $throwable->getMessage();
    exit;
}

// Redireciona para index.php após inserir
header('Location: ./../view/index.php');
exit;

