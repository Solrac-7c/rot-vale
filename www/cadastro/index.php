<?php

$mensagem = $_GET["mensagem"] ?? "";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro - Sistema de Pets</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="/assets/css/style.css"
    >

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="text-center mb-4">
                        Criar conta
                    </h1>

                    <?php if ($mensagem === "usuario_existente") { ?>

                        <div class="alert alert-danger">
                            Este usuário já está cadastrado.
                        </div>

                    <?php } ?>

                    <?php if ($mensagem === "senha_diferente") { ?>

                        <div class="alert alert-danger">
                            As senhas não coincidem.
                        </div>

                    <?php } ?>

                    <?php if ($mensagem === "erro") { ?>

                        <div class="alert alert-danger">
                            Não foi possível realizar o cadastro.
                        </div>

                    <?php } ?>

                    <form
                        action="salvar.php"
                        method="POST"
                    >

                        <div class="mb-3">

                            <label
                                for="nome"
                                class="form-label"
                            >
                                Nome
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nome"
                                name="nome"
                                maxlength="100"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="usuario"
                                class="form-label"
                            >
                                Usuário
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="usuario"
                                name="usuario"
                                maxlength="50"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="senha"
                                class="form-label"
                            >
                                Senha
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="senha"
                                name="senha"
                                minlength="6"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="confirmar_senha"
                                class="form-label"
                            >
                                Confirmar senha
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="confirmar_senha"
                                name="confirmar_senha"
                                minlength="6"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Cadastrar
                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="../login/index.php">
                            Já tenho uma conta
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>