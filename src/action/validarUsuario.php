<?php
session_start();

require_once './../service/mostrarErros.php';
require_once __DIR__ . './../database/Database.php';

if (!empty($_POST)) {
    $email = trim($_POST['emailLogin']);
    $senha = trim($_POST['senhaLogin']);

    if (empty($email) || empty($senha)) {
        echo 'Por favor, preencha o e-mail e a senha.';
        exit;
    }

    try {
        $conn = (new Database())->getConnection();


        $sql = 'SELECT id, nome, email, senha, status FROM usuarios WHERE email = :email';
        $stmt = $conn->prepare($sql);

        $stmt->execute([':email' => $email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_status'] = $usuario['status'];

            header('Location: ./../view/index.php');
            exit;
        } else {
            echo 'E-mail ou senha inválidos.';
            header('Location: ./../view/login.php?erro=1');
            exit;
        }
    } catch (\Throwable $e) {
        echo "Erro no servidor. Tente novamente mais tarde.";
        exit;
    }
} else {
    header('Location: ./../view/login.php');
    exit;
}
