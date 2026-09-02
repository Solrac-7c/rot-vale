<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$tituloPagina = "Pets cadastrados";

require_once("../includes/header.php");

?>


<?php if (isset($_SESSION["msg"])) { ?>

    <div
        class="<?= htmlspecialchars($_SESSION["class"]) ?>"
        role="alert"
    >
        <?= htmlspecialchars($_SESSION["msg"]) ?>
    </div>

<?php

    unset($_SESSION["msg"]);
    unset($_SESSION["class"]);

}

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title">
            Pets cadastrados
        </h1>

        <p class="page-description">
            Consulte e gerencie os animais cadastrados.
        </p>

    </div>

    <a
        href="index.php"
        class="btn btn-primary"
    >
        Novo pet
    </a>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <?php

        $sql = "SELECT
                    pets.id,
                    pets.nome,
                    pets.nascimento,
                    especies.especie,
                    pets.genero,
                    pets.prontuario

                FROM pets

                INNER JOIN especies
                    ON pets.especie_id = especies.id

                ORDER BY pets.nome ASC";

        $resultado = mysqli_query($conn, $sql);

        ?>


        <?php if (!$resultado) { ?>

            <div class="alert alert-danger">
                Erro ao consultar os pets.
            </div>

        <?php } elseif (mysqli_num_rows($resultado) > 0) { ?>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Espécie</th>
                            <th>Gênero</th>
                            <th>Prontuário</th>
                            <th class="text-center">Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>

                        <tr>

                            <td>
                                <?= $row["id"] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["nome"]) ?>
                            </td>

                            <td>
                                <?= date(
                                    "d/m/Y",
                                    strtotime($row["nascimento"])
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["especie"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["genero"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["prontuario"]) ?>
                            </td>

                            <td class="text-center text-nowrap">

                                <a
                                    href="editar.php?id=<?= $row["id"] ?>"
                                    class="btn btn-outline-primary btn-sm"
                                >
                                    Editar
                                </a>

                                <a
                                    href="excluir.php?id=<?= $row["id"] ?>"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Deseja realmente excluir este pet?');"
                                >
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>


        <?php } else { ?>

            <div class="text-center py-4">

                <p class="text-muted">
                    Nenhum pet cadastrado.
                </p>

                <a
                    href="index.php"
                    class="btn btn-primary"
                >
                    Cadastrar primeiro pet
                </a>

            </div>

        <?php } ?>

    </div>

</div>


<?php

require_once("../includes/footer.php");

?>