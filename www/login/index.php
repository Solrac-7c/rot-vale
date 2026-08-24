<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistema de Pets</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="text-center mb-4">
                        Sistema de Pets
                    </h1>

                    <h5 class="text-center mb-4">
                        Acesso ao sistema
                    </h5>

                    <?php if (isset($_GET["erro"])) { ?>

                        <div class="alert alert-danger">
                            Usuário ou senha inválidos.
                        </div>

                    <?php } ?>

                    <form action="autenticar.php" method="POST">

                        <div class="mb-3">

                            <label for="usuario" class="form-label">
                                Usuário
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="usuario"
                                name="usuario"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label for="senha" class="form-label">
                                Senha
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="senha"
                                name="senha"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Entrar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>