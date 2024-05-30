<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar">
    <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="navbar-brand-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="">
        </span>
        <strong style="font-size: .8em;">BUTACABOX</strong>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php"
                class="nav-link <?php echo $current_page == 'dashboard.php' || $current_page == 'dashboard-create-movie.php' ? 'active' : 'text-white'; ?>">
                Filmes
            </a>
        </li>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/sessoes/sessoes.php"
                class="nav-link <?php echo $current_page == 'sessoes.php' || $current_page == 'sessoesCreate.php' ? 'active' : 'text-white'; ?>">
                Sessões
            </a>
        </li>
        <li>
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/fornecedores/fornecedores.php"
                class="nav-link <?php echo $current_page == 'fornecedores.php' || $current_page == 'fornecedoresCreate.php' ? 'active' : 'text-white'; ?>">
                Fornecedores
            </a>
        </li>
        <li>
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/funcionarios/funcionarios.php"
                class="nav-link <?php echo $current_page == 'funcionarios.php' || $current_page == 'funcionariosCreate.php' ? 'active' : 'text-white'; ?>">
                Funcionarios
            </a>
        </li>
        <li>
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/salas/salas.php"
                class="nav-link <?php echo $current_page == 'salas.php' || $current_page == 'salasCreate.php' ? 'active' : 'text-white'; ?>">
                Salas
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://cdn-icons-png.flaticon.com/512/5556/5556468.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong><?php echo $_SESSION['nome']; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item"
                    href="http://127.0.0.1/butacabox/butacabox/src/pages/login-funcionario/logout.php">
                    Encerrar Sessão
                </a></li>
        </ul>
    </div>
</div>