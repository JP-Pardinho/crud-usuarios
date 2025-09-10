<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ./login.php');
    exit;
}

require_once __DIR__ . '/../database/Database.php';

$conn = (new Database())->getConnection();
$stmt = $conn->query('SELECT id, nome, email, dataNascimento, status FROM usuarios ORDER BY nome');
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$usuarioLogin = $_SESSION['usuario_status'];

$editar = '';
$excluir = '';

if ($usuarioLogin == 0) {
    $editar = 'disabled';
    $excluir = 'disabled';
} else if ($usuarioLogin == 2) {
    $excluir = 'disabled';
}

?>

<?php require_once './../public/header.php'; ?>

<main>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        <h4>
                            Lista de Usuários
                            <a href="./login.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Data de Nascimento</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($usuarios as $usuario) {
                                    $urlVisualizar = './../action/validaPermicao.php';
                                    $urlEditar = true ? '#' : '#';

                                    // CRIAR MAIS 4 CAMPOS DA TABELA DE USUARIOS PARA FAZER AS VALIDAÇÕES E GERAR OS BOTÕES DE ACORDO COM AS OPÇÕES SELECIONADAS
                                    echo sprintf(
                                        <<<'HTML'
                                        <tr class="text-center">
                                            <th scope="row">%d</td>
                                            <td>%s</td>
                                            <td>%s</td>
                                            <td>%s</td>
                                            <td>
                                                <a href="./visualizarUsuario.php?usuarioId=%d" class="btn btn-secondary btn-sm mb-1">Visualizar</a>
                                            
                                                <a href="./editar.php?usuarioId=%d" class="btn btn-success btn-sm mb-1 %s">Editar</a>

                                                <a href="./../action/excluirUsuario.php?usuarioId=%d" class="btn btn-danger btn-sm mb-1 %s">Excluir</a>
                                            </td>
                                        </tr>
                                        HTML,
                                        $usuario['id'],
                                        $usuario['nome'],
                                        $usuario['email'],
                                        $usuario['dataNascimento'],
                                        $usuario['id'],
                                        $usuario['id'],
                                        $editar,
                                        $usuario['id'],
                                        $excluir,
                                        /*
                                        id => db
                                        nome => db
                                        email => db
                                        dataNacimento => db
                                        id Usuario p/ editar => db
                                        variavel editor => $editar
                                        variavel adm => $excluir
                                        */
                                    );
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './../public/footer.php'; ?>