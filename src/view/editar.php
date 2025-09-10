<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ./login.php');
    exit;
}

require_once './../service/mostrarErros.php';
require_once __DIR__ . '/../database/Database.php';

try {
    if (empty($_GET['usuarioId'])) {
        throw new \Exception('ID do usuario é obrigatório para a edição.');
    }

    $conn = (new Database())->getConnection();
    $stmt = $conn->prepare('SELECT id, nome, email, dataNascimento FROM usuarios WHERE id = :usuarioId');
    $stmt->bindValue(':usuarioId', $_GET['usuarioId'], PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Throwable $throwable) {
    // Redireciona para index.php após inserir
    header('Location: /src/view/index.php');
    exit;
}
?>

<?php require_once './../public/header.php' ?>

<main>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        <h2>
                            Editar Usuario
                            <a href="./index.php" class="btn btn-danger float-end">Voltar</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="./../action/editarUsuario.php" method="post">
                            <div class="mb-3">
                                <label for="id">Id</label>
                                <input type="text" name="id" class="form-control" value="<?= ($usuario['id']) ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="novoNome">Nome</label>
                                <input type="text" name="novoNome" class="form-control" value="<?= ($usuario['nome']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="novoEmail">Email</label>
                                <input type="email" name="novoEmail" class="form-control" value="<?= ($usuario['email']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="novaData">Data de Nascimento</label>
                                <input type="date" name="novaData" class="form-control" value="<?= ($usuario['dataNascimento']) ?>">
                            </div>

                            <div class="mt-3 mb-3">
                                <input type="submit" name="editarUsuario" class="btn btn-primary" value="Salvar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './../public/footer.php' ?>