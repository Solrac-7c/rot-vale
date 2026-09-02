<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$tituloPagina = "Cadastrar espécie";

require_once("../includes/header.php");

?>

<div class="row justify-content-center">

    <div class="col-md-8 col-lg-6">

        <div class="card shadow-sm">

            <div class="card-header">

                <h3 class="mb-0">
                    Cadastrar nova espécie
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
                            maxlength="100"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        name="enviar"
                        class="btn btn-primary w-100"
                    >
                        Cadastrar espécie
                    </button>

                </form>

            </div>

            <div class="card-footer text-center">

                <a href="mostrar.php">
                    Ver espécies cadastradas
                </a>

            </div>

        </div>

    </div>

</div>

<?php

require_once("../includes/footer.php");

?>