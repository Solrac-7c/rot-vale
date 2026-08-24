<?php

require_once("config/conexao.php");

$sql = "SELECT * FROM especies";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro ao consultar espécies: " . mysqli_error($conn));
}

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

<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-4">
        Sistema de Pets
    </h1>

    <div class="card">

        <div class="card-header">
            Espécies cadastradas
        </div>

        <div class="card-body">

            <?php if (mysqli_num_rows($resultado) > 0) { ?>

                <table class="table table-striped">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Espécie</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>

                            <tr>

                                <td>
                                    <?= $row["id"] ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($row["especie"]) ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } else { ?>

                <p>
                    Nenhuma espécie cadastrada.
                </p>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>