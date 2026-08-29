<?php

require_once("../includes/auth.php");

$tituloPagina = "Cadastrar pet";

require_once("../includes/header.php");

?>

<div class="page-header mb-4">

    <h1 class="page-title">
        Cadastrar pet
    </h1>

    <p class="page-description">
        Preencha as informações do animal.
    </p>

</div>

<div class="row justify-content-center">

    <div class="col-lg-9">

        <div class="card form-card shadow-sm">

            <div class="card-body p-4">

                <form action="salvar.php" method="POST">

                    <div class="row">

                        <!-- Nome -->
                        <div class="col-md-8 mb-4">

                            <label
                                for="nome"
                                class="form-label"
                            >
                                Nome do pet
                            </label>

                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="nome"
                                name="nome"
                                maxlength="100"
                                placeholder="Ex.: Thor"
                                required
                            >

                        </div>

                        <!-- Nascimento -->
                        <div class="col-md-4 mb-4">

                            <label
                                for="nascimento"
                                class="form-label"
                            >
                                Nascimento
                            </label>

                            <input
                                type="date"
                                class="form-control form-control-lg"
                                id="nascimento"
                                name="nascimento"
                                required
                            >

                        </div>

                        <!-- Espécie -->
                        <div class="col-md-7 mb-4">

                            <label
                                for="especie_id"
                                class="form-label"
                            >
                                Espécie
                            </label>

                            <select
                                class="form-select form-select-lg"
                                id="especie_id"
                                name="especie_id"
                                required
                            >

                                <option value="">
                                    Selecione uma espécie
                                </option>

                                <!--
                                    Futuramente as espécies
                                    virão do banco de dados.
                                -->

                                <option value="1">
                                    Cachorro
                                </option>

                                <option value="2">
                                    Gato
                                </option>

                            </select>

                        </div>

                        <!-- Gênero -->
                        <div class="col-md-5 mb-4">

                            <label class="form-label d-block">
                                Gênero
                            </label>

                            <div class="gender-options">

                                <div class="form-check form-check-inline">

                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="genero"
                                        id="macho"
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
                                        name="genero"
                                        id="femea"
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

                        </div>

                        <!-- Prontuário -->
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
                            Salvar pet
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