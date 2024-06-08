<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div id="smallSidebarMenu" class="d-none d-sm-flex flex-column flex-shrink-0 text-bg-dark" style="width: 4.5rem;">
    <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php"
        class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right"
        data-bs-original-title="Icon-only">
        <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="" class="bi pe-none me-2" width="40"
            height="32">
    </a>
    <hr>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu">
                <span class="navbar-toggler-icon">
                    <i class="bi bi-list text-white"></i>
                </span>
            </button>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php">
                <button
                    class="btn <?php echo $current_page == 'dashboard.php' || $current_page == 'dashboard-create-movie.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <?php echo $current_page == 'dashboard.php' || $current_page == 'dashboard-create-movie.php' ? '<i class="bi bi-camera-reels"></i>' : '<i class="bi bi-camera-reels-fill"></i>'; ?>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/sessoes/sessoes.php">
                <button
                    class=" btn <?php echo $current_page == 'sessoes.php' || $current_page == 'sessoesCreate.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <?php echo $current_page == 'sessoes.php' || $current_page == 'sessoesCreate.php' ? '<i class="bi bi-clock"></i>' : '<i class="bi bi-clock-fill"></i>'; ?>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/fornecedores/fornecedores.php">
                <button
                    class=" btn <?php echo $current_page == 'fornecedores.php' || $current_page == 'fornecedoresCreate.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <?php echo $current_page == 'fornecedores.php' || $current_page == 'fornecedoresCreate.php' ? '<i class="bi bi-box"></i>' : '<i class="bi bi-box-fill"></i>'; ?>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/funcionarios/funcionarios.php">
                <button
                    class=" btn <?php echo $current_page == 'funcionarios.php' || $current_page == 'funcionariosCreate.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <?php echo $current_page == 'funcionarios.php' || $current_page == 'funcionariosCreate.php' ? '<i class="bi bi-people-fill"></i>' : '<i class="bi bi-people"></i>'; ?>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/salas/salas.php">
                <button
                    class=" btn <?php echo $current_page == 'salas.php' || $current_page == 'salasCreate.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <?php echo $current_page == 'salas.php' || $current_page == 'salasCreate.php' ? '<i class="bi bi-door-open"></i>' : '<i class="bi bi-door-open-fill"></i>'; ?>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/relatorios/vendas.php">
                <button class=" btn <?php echo $current_page == 'vendas.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <i class="bi bi-cart"></i>
                    </span>
                </button>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/relatorios/pagamentos.php">
                <button class=" btn <?php echo $current_page == 'pagamentos.php' ? 'btn-light' : 'btn-dark'; ?>"
                    type="button">
                    <span class="navbar-toggler-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </span>
                </button>
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown p-2">
        <a href="#"
            class="d-flex align-items-center justify-content-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="navbar-toggler-icon font fs-4"><i class="bi bi-person-circle"></i></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item"
                    href="http://127.0.0.1/butacabox/butacabox/src/pages/login-funcionario/logout.php">Encerrar
                    Sessão</a></li>
        </ul>
    </div>
</div>