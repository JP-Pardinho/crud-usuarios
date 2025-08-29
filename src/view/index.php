<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../database/Database.php';

$conn = (new Database())->getConnection();
$stmt = $conn->query('SELECT id, nome FROM usuarios ORDER BY nome');
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once './../public/header.php'; ?>

<main>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        <h4>Lista de Usuários</h4>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './../public/footer.php'; ?>