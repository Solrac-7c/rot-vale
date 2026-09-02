<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$tituloPagina = "Espécies cadastradas";

require_once("../includes/header.php");

?>

<?php

if (isset($_SESSION["msg"])):

?>

<div
    id="msg"
    class="<?= $_SESSION["class"] ?>"
    role="alert"
>
    <?= htmlspecialchars($_SESSION["msg"]) ?>
</div>

<?php

unset($_SESSION["msg"]);
unset($_SESSION["class"]);

endif;

?>

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Espécies cadastradas
        </h3>

        <a
            href="index.php"
            class="btn btn-primary"
        >
            Nova espécie
        </a>

    </div>

    <div class="card-body">

        <?php

        $sql = "SELECT * FROM especies ORDER BY especie ASC";

        $resultado = mysqli_query($conn, $sql);

        if (!$resultado) {

            echo "Erro ao consultar espécies.";

        } elseif (mysqli_num_rows($resultado) > 0) {

        ?>

        <div class="table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Espécie</th>

                        <th class="text-center">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                while ($row = mysqli_fetch_array($resultado)) {

                ?>

                    <tr>

                        <td>
                            <?= $row["id"] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row["especie"]) ?>
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
                                onclick="return confirm('Deseja realmente excluir esta espécie?');"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>

        <?php

        } else {

            echo "Não há espécies cadastradas.";

        }

        ?>

    </div>

</div>

<?php

require_once("../includes/footer.php");

?>