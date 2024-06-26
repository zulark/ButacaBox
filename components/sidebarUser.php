<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
    header {
        background-color: #ce6b1a;
    }

    .navbar-brand-logo {
        margin-left: 40px;
    }

    .navbar-brand-logo img {
        width: 50px;
        transform: rotate(25deg);
    }

    @media (min-width: 576px) {
        #dropdownuser {
            right: 0;
            left: auto;
        }
    }

    @media (max-width: 768px) {
        #dropdownuser {
            left: 0;
            right: auto;
        }
    }
</style>
<header class="navbar">
    <div class="container-fluid px-3 py-3  d-flex align-items-center justify-content-between">
        <a class="navbar-brand-logo  flex-column align-items-center justify-content-center d-none d-md-flex"
            href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php">
            <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="Logo"
                class="d-inline-block align-top me-2" width="40">
            <span class="d-none d-sm-block">BUTACABOX</span>
        </a>

        <ul class="nav nav-pills mx-auto <?php echo $current_page == 'detalhes-filme.php' ? 'd-none' : 'd-none d-md-flex'; ?>">
            <li class="nav-item"><a href="#estreias" class="nav-link text-white">Estreia</a></li>
            <li class="nav-item"><a href="#em_cartaz" class="nav-link text-white">Em cartaz</a></li>
            <li class="nav-item"><a href="#em_breve" class="nav-link text-white">Em breve</a></li>
        </ul>
        <div id="dropdown" class="dropdown">
            <?php
            session_start();
            if (!isset($_SESSION['id_usuario'])) {
                echo '<div id="user-data" data-id-usuario=""></div>';
                echo '  <div class="d-flex justify-content-center align-items-center">
        <div class="btn text-uppercase">
        <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/login.php" class="nav-link text-white">Entrar</a>
        </div>
        <div class="btn text-uppercase">
        <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/register.php" class="nav-link text-white">Cadastrar-se</a>
        </div>
        </div>';
            } else {
                echo '<div id="user-data" data-id-usuario="' . $_SESSION['id_usuario'] . '"></div>';
                echo '  <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fw-light">' . $_SESSION['nome_usuario'] . '</span>
        </a>
        <ul id="dropdownuser" class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/logout.php" class="dropdown-item">Encerrar Sessão</a></li>
        </ul>
        </div>';
            }
            ?>


            </li>
        </div>
        <button class="navbar-toggler d-xs-block d-md-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>

<div class="offcanvas offcanvas-end bg-dark text-bg-dark text-white sidebar" tabindex="-1" id="sidebarMenu"
    aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header mb-3 mt-3">
        <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php"
            class="d-flex align-items-center text-white text-decoration-none">
            <img src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="" width="40" height="32"
                class="me-2">
            <strong>BUTACABOX</strong>
        </a>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#estreias" class="nav-link text-white">Estreias</a>
            </li>
            <li>
                <hr>
            </li>
            <li class="nav-item">
                <a href="#em_cartaz" class="nav-link text-white">Em cartaz</a>
            </li>
            <li>
                <hr>
            </li>
            <li class="nav-item">
                <a href="#em_breve" class="nav-link text-white">Pré Venda</a>
            </li>
        </ul>
    </div>
</div>