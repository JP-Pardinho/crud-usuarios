<?php require_once './../public/header.php' ?>

<main>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="./../action/validarUsuario.php" method="post">
                            <div class="mb-3">
                                <label for="emailLogin" class="form-label">Email</label>
                                <input name="emailLogin" type="email" class="form-control" id="iemailLogin" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="senhaLogin" class="form-label">Senha</label>
                                <input name="senhaLogin" type="password" class="form-control" id="isenhaLogin">
                                <div id="PasswordHelp" class="form-text">
                                    <a href="./cadastrarUsuario.php">Clique aqui caso ainda não possua cadastro.</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './../public/footer.php' ?>