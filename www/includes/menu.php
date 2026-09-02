<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a
            class="navbar-brand"
            href="/index.php"
        >
            Sistema de Pets
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuPrincipal"
            aria-controls="menuPrincipal"
            aria-expanded="false"
            aria-label="Abrir menu"
        >

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="menuPrincipal"
        >

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/index.php"
                    >
                        Início
                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/especies/mostrar.php"
                    >
                        Espécies
                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/pets/mostrar.php"
                    >
                        Pets
                    </a>

                </li>

            </ul>

            <?php if (isset($_SESSION["usuario_nome"])) { ?>

                <span class="navbar-text text-white me-3">

                    Olá,
                    <?= htmlspecialchars($_SESSION["usuario_nome"]) ?>

                </span>

                <a
                    href="/logout.php"
                    class="btn btn-light btn-sm"
                >
                    Sair
                </a>

            <?php } ?>

        </div>

    </div>

</nav>