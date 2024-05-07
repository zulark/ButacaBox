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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/ButacaBox/ButacaBox/src/css/detalhes-filme.css">
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid header d-flex justify-content-between align-items-center">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <span class="navbar-brand-logo">
                    <img class="d-none d-sm-block" src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="">
                </span>
                <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/index.php">
                    <strong class="d-none d-sm-block">BUTACABOX</strong>
                </a>
            </div>

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

    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img id="cartaz_filme" class="d-block mx-lg-auto img-fluid" src="" alt="cartaz do filme" width="700"
                    height="700" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 id="titulo" class="display-5 fw-bold lh-1 mb-3"></h1>
                <p id="genero" class="lead text-white"></p>
                <p id="descricao" class="blog-post-meta"></p>
                <figcaption class="blockquote-footer text-white">
                    <p id="diretor"></p>
                    <p id="duracao"></p>
                </figcaption>
                <div class="youtube-video"></div>
            </div>
        </div>
    </div>

    <div class="container col-xxl-8 px-4 py-5">
        <div class="card sessoes mt-4">
            <div class="card-body text-bg-dark">
                <h5 class="card-title">Sessões</h5>
            </div>
        </div>
    </div>

    <div class="paymentConfirmation">
        <div class="modal fade" id="buyTicketModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="buyTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content" style="background-color: #f2f2f2; color: #000; border-radius: 5px;">
                    <div class="modal-header" style="border: none;">
                        <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-5">
                            <div class="col-md-5 col-lg-4 order-md-last">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-primary">Seu carrinho</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h6 class="my-0 movie-title"></h6>
                                            <small class="text-muted movie-filial text-uppercase"></small><br>
                                            <small class="text-muted movie-date"></small>
                                            <small class="text-muted movie-hora"></small>
                                            <small class="text-muted movie-sala"></small>
                                        </div>
                                        <span class="fw-bold preco_ingresso"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Quantidade:</span>
                                        <strong class="quantidade_ingresso"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (BRL):</span>
                                        <strong class="preco_total"></strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <form class="needs-validation" novalidate="">
                                    <hr class="my-4">

                                    <h4 class="mb-3">Seleção de Assentos</h4>

                                    <div class="row gy-3">
                                        <!-- Layout de grade para a seleção de assentos -->
                                        <div class="col text-center">

                                            <!-- Assentos -->
                                            <div class="seat-container"></div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <h4 class="mb-3">Pagamento</h4>

                                    <div class="my-3">
                                        <div class="form-check">
                                            <input id="credit" name="paymentMethod" type="radio"
                                                class="form-check-input" checked="">
                                            <label class="form-check-label" for="credit">Crédito</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="debit" name="paymentMethod" type="radio"
                                                class="form-check-input">
                                            <label class="form-check-label" for="debit">Débito</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="paypal" name="paymentMethod" type="radio"
                                                class="form-check-input">
                                            <label class="form-check-label" for="paypal">PIX</label>
                                        </div>
                                    </div>

                                    <div class="row gy-3">
                                        <div class="col-md-6">
                                            <label for="cc-name" class="form-label">Nome do Títular</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder=""
                                                required="">
                                            <small class="text-muted">Nome completo</small>
                                            <div class="invalid-feedback">
                                                Nome completo é obrigatório
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cc-number" class="form-label">Número do cartão</label>
                                            <input type="text" class="form-control" id="cc-number"
                                                placeholder="0000 0000 0000 0000" required="">
                                            <div class="invalid-feedback">
                                                Número do cartão é obrigatório
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-expiration" class="form-label">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration"
                                                placeholder="MM/YYYY" maxlength="7"
                                                oninput="formatExpirationDate(event)" required="">


                                            <div class="invalid-feedback">
                                                Data de expiração
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-cvv" class="form-label">CVV</label>
                                            <input type="numer" min="1" max="999" class="form-control" id="cc-cvv"
                                                placeholder="000" required="">
                                            <div class="invalid-feedback">
                                                Código de Segurança é obrigatório
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m">

                                    <div class="d-flex flex-direction row px-2">
                                        <button id="continuar-compra" class="btn btn-secondary btn-lg mb-2"
                                            type="button" data-dismiss="modal" aria-label="Close">Alterar
                                            sessão</button>
                                        <button id="confirmar-compra" class="btn btn-primary btn-lg mb-2"
                                            type="button">Confirmar
                                            Pagamento</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <script async src="http://127.0.0.1/ButacaBox/ButacaBox/src/js/detalhes-filme.js"></script>

</body>

</html>