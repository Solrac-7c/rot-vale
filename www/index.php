<?php

require_once("includes/auth.php");

$tituloPagina = "Início";

require_once("includes/header.php");

?>

<div class="home-header mb-5">

    <h1 class="home-title">
        Sistema de Pets
    </h1>

    <p class="home-subtitle">
        Bem-vindo, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?>!
    </p>

    <p class="text-muted">
        Selecione uma das opções abaixo para continuar.
    </p>

</div>


<div class="row g-4">

    <!-- Espécies -->

    <div class="col-md-6">

        <div class="card home-card h-100 shadow-sm">

            <div class="card-body p-4">

                <div class="home-icon">
                    🐾
                </div>

                <h2 class="h4 mt-3">
                    Espécies
                </h2>

                <p class="text-muted">
                    Cadastre e gerencie as espécies
                    disponíveis no sistema.
                </p>

                <a
                    href="especies/mostrar.php"
                    class="btn btn-primary"
                >
                    Acessar espécies
                </a>

            </div>

        </div>

    </div>


    <!-- Pets -->

    <div class="col-md-6">

        <div class="card home-card h-100 shadow-sm">

            <div class="card-body p-4">

                <div class="home-icon">
                    🐶
                </div>

                <h2 class="h4 mt-3">
                    Pets
                </h2>

                <p class="text-muted">
                    Cadastre e gerencie os animais
                    registrados no sistema.
                </p>

                <a
                    href="pets/mostrar.php"
                    class="btn btn-primary"
                >
                    Acessar pets
                </a>

            </div>

        </div>

    </div>

</div>

<?php

require_once("includes/footer.php");

?>