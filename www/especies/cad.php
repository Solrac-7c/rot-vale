<?php

require_once("../includes/auth.php");

$tituloPagina = "Cadastrar espécie";

require_once("../includes/header.php");

?>

<div class="page-header mb-4">

    <h1 class="page-title">
        Cadastrar espécie
    </h1>

    <p class="page-description">
        Adicione uma nova espécie ao sistema.
    </p>

</div>

<div class="row justify-content-center">

    <div class="col-md-8 col-lg-6">

        <div class="card form-card shadow-sm">

            <div class="card-body p-4">

                <form action="salvar.php" method="POST">

                    <div class="mb-4">

                        <label
                            for="especie"
                            class="form-label"
                        >
                            Espécie
                        </label>

                        <input
                            type="text"
                            class="form-control form-control-lg"
                            id="especie"
                            name="especie"
                            maxlength="100"
                            placeholder="Ex.: Cachorro"
                            required
                        >

                        <div class="form-text">
                            Informe o nome da espécie.
                        </div>

                    </div>

                    <div class="form-actions">

                        <a
                            href="index.php"
                            class="btn btn-outline-secondary"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Salvar espécie
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