<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$id = $_GET["id"] ?? "";

if (!is_numeric($id) || $id <= 0) {
    die("ID do pet inválido.");
}

$sql = "SELECT *
        FROM pets
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) !== 1) {
    die("Pet não encontrado.");
}

$pet = mysqli_fetch_assoc($resultado);


$tituloPagina = "Editar pet";

require_once("../includes/header.php");

?>

<div class="page-header mb-4">

    <h1 class="page-title">
        Editar pet
    </h1>

    <p class="page-description">
        Altere as informações do animal.
    </p>

</div>


<div class="row justify-content-center">

    <div class="col-lg-9">

        <div class="card shadow-sm">

            <div class="card-body p-4">

                <form
                    method="POST"
                    action="processa.php"
                >

                    <div class="row">
                        <div class="col-md-8 mb-4">

                            <label
                                for="nome"
                                class="form-label"
                            >
                                Nome do pet
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nome"
                                name="nome"
                                maxlength="100"
                                value="<?= htmlspecialchars($pet["nome"]) ?>"
                                required
                            >

                        </div>
                        <div class="col-md-4 mb-4">

                            <label
                                for="nascimento"
                                class="form-label"
                            >
                                Nascimento
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                id="nascimento"
                                name="nascimento"
                                value="<?= htmlspecialchars($pet["nascimento"]) ?>"
                                required
                            >

                        </div>
                        <div class="col-md-7 mb-4">

                            <label
                                for="especie_id"
                                class="form-label"
                            >
                                Espécie
                            </label>

                            <select
                                class="form-select"
                                id="especie_id"
                                name="especie_id"
                                required
                            >

                                <option value="">
                                    Selecione uma espécie
                                </option>

                                <?php

                                $sqlEspecies = "SELECT id, especie
                                                FROM especies
                                                ORDER BY especie ASC";

                                $resultadoEspecies = mysqli_query(
                                    $conn,
                                    $sqlEspecies
                                );

                                while (
                                    $especie = mysqli_fetch_assoc(
                                        $resultadoEspecies
                                    )
                                ) {

                                    $selecionada =
                                        $especie["id"] == $pet["especie_id"]
                                        ? "selected"
                                        : "";

                                ?>

                                    <option
                                        value="<?= $especie["id"] ?>"
                                        <?= $selecionada ?>
                                    >
                                        <?= htmlspecialchars($especie["especie"]) ?>
                                    </option>

                                <?php } ?>

                            </select>

                        </div>
                        <div class="col-md-5 mb-4">

                            <label class="form-label d-block">
                                Gênero
                            </label>


                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="macho"
                                    name="genero"
                                    value="Macho"
                                    <?= $pet["genero"] === "Macho" ? "checked" : "" ?>
                                    required
                                >

                                <label
                                    class="form-check-label"
                                    for="macho"
                                >
                                    Macho
                                </label>

                            </div>


                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    id="femea"
                                    name="genero"
                                    value="Fêmea"
                                    <?= $pet["genero"] === "Fêmea" ? "checked" : "" ?>
                                >

                                <label
                                    class="form-check-label"
                                    for="femea"
                                >
                                    Fêmea
                                </label>

                            </div>

                        </div>
                        <div class="col-12 mb-4">

                            <label
                                for="prontuario"
                                class="form-label"
                            >
                                Prontuário
                            </label>

                            <textarea
                                class="form-control"
                                id="prontuario"
                                name="prontuario"
                                rows="6"
                                required
                            ><?= htmlspecialchars($pet["prontuario"]) ?></textarea>

                        </div>


                    </div>


                    <input
                        type="hidden"
                        name="id"
                        value="<?= $pet["id"] ?>"
                    >


                    <div class="form-actions">

                        <a
                            href="mostrar.php"
                            class="btn btn-outline-secondary"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            name="alterar"
                            class="btn btn-primary"
                        >
                            Salvar alterações
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<?php

require_once("../includes/footer.php");

?>