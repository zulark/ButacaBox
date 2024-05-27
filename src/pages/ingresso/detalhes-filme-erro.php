<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ButacaBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2598/2598702.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/ButacaBox/ButacaBox/src/css/detalhes-filme.css">
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid header d-flex justify-content-between align-items-center">
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <span class="navbar-brand-logo">
                        <img class="d-none d-sm-block" src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png"
                            alt="">
                    </span>
                    <strong class="d-none d-sm-block">BUTACABOX</strong>
                </div>
            </a>

            <div class="d-flex align-items-center">
                <?php
                session_start();
                if (!isset($_SESSION['id_usuario'])) {
                    echo '<script>window.id_usuario = null;</script>';
                    echo
                        '
                    <div class=" d-none d-sm-block svg m-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                    </div>
                                    <div class="fs-2">
                                    <a class="d-xs-flex flex-direction column d-block fs-sx-1" id="loginbutton" href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/login.php">Entrar </br>ou cadastrar-se</a>
                                    </div>
                                    ';
                } else {
                    echo '<script>window.id_usuario = ' . $_SESSION['id_usuario'] . ';</script>';
                    echo
                        '
                            <div class="dropdown"">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>' . $_SESSION['nome'] . '</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow dropdown-menu-left">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-usuario/logout.php">
                                Encerrar Sessão
                                </a></li>
                            </ul>
                        </div>        
                        ';
                }
                ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="d-block text-center">
            <h1 class="h1 display-4">
                Filme não disponível.
            </h1>
            <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php">
                <button class="btn text-white" style="background-color: #E8751A;">
                    Clique aqui para voltar
                </button>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>