<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="offcanvas offcanvas-start bg-dark text-bg-dark text-white sidebar" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header text-center">
        <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="" class="bi pe-none me-2" width="40"
                height="32">
            <strong>BUTACABOX</strong>
        </a>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-3">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/dashboard.php"
                    class="nav-link <?php echo $current_page == 'dashboard.php' || $current_page == 'dashboard-create-movie.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-camera-reels"></i>
                    Filmes
                </a>

            </li>
            <li class="nav-item">
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/sessoes/sessoes.php"
                    class="nav-link <?php echo $current_page == 'sessoes.php' || $current_page == 'sessoesCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-clock"></i>
                    Sessões
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/fornecedores/fornecedores.php"
                    class="nav-link <?php echo $current_page == 'fornecedores.php' || $current_page == 'fornecedoresCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-box"></i>
                    Fornecedores
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/funcionarios/funcionarios.php"
                    class="nav-link <?php echo $current_page == 'funcionarios.php' || $current_page == 'funcionariosCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-people-fill"></i>
                    Funcionarios
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/setores/setores.php"
                    class="nav-link <?php echo $current_page == 'setores.php' || $current_page == 'setoresCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-people-fill"></i>
                    Setor
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/salas/salas.php"
                    class="nav-link <?php echo $current_page == 'salas.php' || $current_page == 'salasCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-door-open"></i>
                    Salas
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/relatorios/vendas.php"
                    class="nav-link <?php echo $current_page == 'vendas.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-cart"></i>
                    Vendas
                </a>
            </li>
            <li>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/dashboard/relatorios/pagamentos.php"
                    class="nav-link <?php echo $current_page == 'pagamentos.php' || $current_page == 'pagamentosCreate.php' ? 'active' : 'text-white'; ?>">
                    <i class="bi bi-currency-dollar"></i>
                    Pagamentos
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="navbar-toggler-icon font fs-4"><i class="bi bi-person-circle"></i></span>
                <strong><?php echo $_SESSION['nome_funcionario']; ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item"
                        href="http://127.0.0.1/butacabox/butacabox/src/pages/login-funcionario/logout.php">Encerrar
                        Sessão</a></li>
            </ul>
        </div>
    </div>
</div>