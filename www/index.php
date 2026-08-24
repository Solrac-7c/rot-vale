<?php

require_once("includes/auth.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Pets</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container py-5">

    <h1>
        Sistema de Pets
    </h1>

    <p class="lead">
        Olá, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?>!
    </p>

    <a
        href="logout.php"
        class="btn btn-danger"
    >
        Sair
    </a>

</div>

</body>

</html>