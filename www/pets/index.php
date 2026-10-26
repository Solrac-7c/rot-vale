<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$tituloPagina = "Cadastrar pet";

require_once("../includes/header.php");

?>

<div class="page-header mb-4">

    <h1 class="page-title">
        Cadastrar pet
    </h1>

    <p class="page-description">
        Cadastre as informações do animal.
    </p>

</div>

<div class="row justify-content-center">

    <div class="col-lg-9">

        <div class="card shadow-sm">

            <div class="card-body p-4">

                <form method="POST" action="processa.php" enctype="multipart/form-data">

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
                                placeholder="Ex.: Thor"
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

                                $sql = "SELECT id, especie
                                        FROM especies
                                        ORDER BY especie ASC";

                                $resultado = mysqli_query($conn, $sql);

                                if (!$resultado) {

                                    die(
                                        "Erro ao consultar espécies: "
                                        . mysqli_error($conn)
                                    );

                                }

                                while ($row = mysqli_fetch_assoc($resultado)) {

                                ?>

                                    <option value="<?= $row["id"] ?>">
                                        <?= htmlspecialchars($row["especie"]) ?>
                                    </option>

                                <?php

                                }

                                ?>

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
                                placeholder="Digite informações relevantes sobre o pet..."
                                required
                            ></textarea>

                            <label for="foto" class="form-label">
                                Foto do pet
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="foto"
                                    name="foto"
                                    accept="image/jpeg,image/png,image/webp"
                                >   

                                <div class="form-text">
                                    Formatos aceitos: JPG, PNG ou WEBP. Tamanho máximo: 2 MB.
                                </div>
</div>

                    </div>


                    <div class="form-actions">

                        <a
                            href="mostrar.php"
                            class="btn btn-outline-secondary"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            name="enviar"
                            class="btn btn-primary"
                        >
                            Cadastrar pet
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