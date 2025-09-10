<?php

require_once './../service/mostrarErros.php';

require_once __DIR__ . './../database/Database.php';

if (!empty($_POST)) {
    $nome = $_POST['novoNome'] ?? '';
    $id = $_POST['id'] ?? '';
    $email = $_POST['novoEmail'];
    $data = $_POST['novaData'];

    // Validação simples
    if (empty($nome) && empty($id) && empty($email)) {
        echo 'Preencha todos os campos.';
        exit;
    }



    $conn = (new Database())->getConnection();
    $sql = 'UPDATE usuarios SET nome = :nome, email = :email, dataNascimento = :data WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'nome' => $nome,
        'email' => $email,
        'data' => $data
    ]);
}

// Redireciona para index.php após inserir
header('Location: ./../view/index.php');
exit;
