<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$id = $_GET["id"] ?? "";

if (empty($id)) {

    die("ID da espécie não informado.");

}

$sql = "SELECT * FROM especies WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 1) {

    $especieBanco = mysqli_fetch_array($resultado);

    $especie = $especieBanco["especie"];

} else {

    die("Espécie não encontrada.");

}

$tituloPagina = "Editar espécie";

require_once("../includes/header.php");

?>

<div class="row justify-content-center">

    <div class="col-md-8 col-lg-6">

        <div class="card shadow-sm">

            <div class="card-header">

                <h3 class="mb-0">
                    Editar espécie
                </h3>

            </div>

            <div class="card-body">

                <form method="POST" action="processa.php">

                    <div class="mb-3">

                        <label
                            for="especie"
                            class="form-label"
                        >
                            Espécie
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="especie"
                            name="especie"
                            value="<?= htmlspecialchars($especie) ?>"
                            maxlength="100"
                            required
                        >

                    </div>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $id ?>"
                    >

                    <button
                        type="submit"
                        name="alterar"
                        class="btn btn-primary w-100"
                    >
                        Alterar espécie
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php

require_once("../includes/footer.php");

?>