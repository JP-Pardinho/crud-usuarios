<?php



require_once __DIR__ . '/../database/Database.php';

$conn = (new Database())->getConnection();
$stmt = $conn->query('SELECT id, nome FROM usuarios ORDER BY nome');
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once './../public/header.php'?>

<main>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        <h2>
                            Realize seu cadastro
                            <a href="./login.php" class="btn btn-danger float-end">Voltar</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="./../action/criarUsuario.php" method="post">
                            <div class="mb-3">
                                <label for="nomeCadastro">Nome</label>
                                <input type="text" name="nomeCadastro" id="inomeCadastro" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="emailCadastro">Email</label>
                                <input type="email" name="emailCadastro" id="iemailCadastro" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="dataCadastro">Data de Nascimento</label>
                                <input type="date" name="dataCadastro" id="idataCadastro" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="senhaCadastro">Senha</label>
                                <input type="password" name="senhaCadastro" id="isenhaCadastro" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="criarUsuario" class="btn btn-primary" value="Salvar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './../public/footer.php'?>