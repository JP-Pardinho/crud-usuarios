<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . './../database/Database.php';


if (!empty($_POST)) {
    $nome = trim($_POST['nomeCadastro']);
    $email = trim($_POST['emailCadastro']);
    $dataNascimento = $_POST['dataCadastro'] ?? '';
    $senha = trim($_POST['senhaCadastro']);

    // Validação simples
    if (empty($nome) || empty($email) || empty($senha) || empty($dataNascimento)) {
        echo 'Preencha todos os campos.';
        exit;
    }
    try {
        $conn = (new Database())->getConnection();

        $sql = 'INSERT INTO usuarios (nome, email, dataNascimento, senha) VALUES (:nome, :email, :dataNascimento, :senha)'; // fazer isso aqui dar certo !! 

        $stmt = $conn->prepare($sql);

        $senhaHash = password_hash($senha, PASSWORD_ARGON2ID); // ver como vai usar essa senha ai pra confirmar o login

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':dataNascimento' => $dataNascimento,
            ':senha' => $senhaHash
        ]);

        header('Location: ./../view/index.php');
        exit;

    } catch (\Throwable $e) {
        echo "Erro: Não foi possível cadastrar usuário!" . PHP_EOL;
        exit;
    }
} else {
    // Redireciona para index.php após inserir
    header('Location: ./../view/index.php');
    exit;
}

