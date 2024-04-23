<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ButacaBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2598/2598702.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid header d-flex justify-content-between align-items-center">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <span class="navbar-brand-logo">
                    <img class="d-none d-sm-block" src="https://cdn-icons-png.flaticon.com/512/2598/2598702.png" alt="">
                </span>
                <strong class="d-none d-sm-block">BUTACABOX</strong>
            </div>

            <div class="d-flex align-items-center">
                <?php
                session_start();
                if (!isset($_SESSION['id_usuario'])) {
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
                    echo
                        '
                        <div class="dropdown"">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                          data-bs-toggle="dropdown" aria-expanded="false">
                          <strong>'.$_SESSION['nome'].'</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow dropdown-menu-left">
                          <li><a class="dropdown-item" href="#">Perfil</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item" href="http://127.0.0.1\ButacaBox\ButacaBox\src\pages\login-usuario\logout.php">
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

    <nav class="navbar" id="navheader">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row w-100 text-center">
                <div class="col-12 col-lg-4 mb-2 mt-2 d-flex justify-content-center">
                    <a class="navbar-brand" href="#estreias">Estreias</a>
                </div>
                <div class="col-12 col-lg-4 mb-2 mt-2 d-flex justify-content-center">
                    <a class="navbar-brand" href="#em_cartaz">Em cartaz</a>
                </div>
                <div class="col-12 col-lg-4 mb-2 mt-2 d-flex justify-content-center">
                    <a class="navbar-brand" href="#em_breve">Pré Venda</a>
                </div>
            </div>
        </div>
    </nav>



    <div class="container-fluid carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/ingresso/detalhes-filme.html?id=16">
                        <img style="max-height: 543px; min-height: 500px;"
                            src="https://www.cinemark.com.br/Content/uploads/banner/banner_desk_guerra-civil_1920x550px.jpg"
                            class="d-block w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/ingresso/detalhes-filme.html?id=15">
                        <img style="max-height: 543px; min-height: 500px"
                            src="https://www.cinemark.com.br/Content/uploads/banner/banner_desk_jorge-da-capadocia_1920x550px.jpg"
                            class="d-block w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="http://127.0.0.1/ButacaBox/ButacaBox/src/pages/ingresso/detalhes-filme.html?id=3">

                        <img style="max-height: 543px; min-height: 500px;"
                            src="https://www.cinemark.com.br/Content/uploads/banner/banner_desk_ghostbusters_apocalipse-de-gelo_1920x550px.jpg"
                            class="d-block w-100" alt="...">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-fluid mt-5 mb-5" id="estreias">
        <div class="container text-center">
            <p class="h1 mb-4">Estreia</p>
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 justify-content-evenly">
                <div class="col w-33 mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_estreia img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col w-33 mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_estreia img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col w-33 mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_estreia img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 mb-5" id="em_cartaz">
        <div class="container text-center">
            <p class="h1 mb-4">Em cartaz</p>
            <div
                class="row row-cols-1 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 justify-content-between">
                <div class="col mb-5">
                    <div class="movie-image">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_cartaz img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 mb-5" id="em_breve">
        <div class="container text-center">
            <p class="h1 mb-4">Em breve</p>
            <div
                class="row row-cols-1 row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 justify-content-between">
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="movie-image d-flex justify-content-center align-items-center">
                        <a href="#" class="movie-link">
                            <img class="filmes_em_breve img-fluid" src="" alt="">
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid mt-5" style="padding: 0;">
        <footer class="bd-footer mt-5 bg-body-light">
            <div class="container pt-4  text-body-secondary text-center">
                <strong>Formas de Pagamento</strong>
                <div class="row row-cols-2">
                    <div class="pb-4 text-start">
                        <h3>Crédito</h3>
                        <div class="d-flex flex-wrap justify-content-start w-100">
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="40" height="30" viewBox="0 0 53 40" class="injected-svg"
                                        data-src="/images/payment/visa.svg" role="img" style="" alt="Logo da visa">
                                        <defs>
                                            <linearGradient id="prefix__c-112" x1="0%" x2="100%" y1="50%" y2="50%">
                                                <stop offset="0%" stop-color="#1F1F46"></stop>
                                                <stop offset="100%" stop-color="#194788"></stop>
                                            </linearGradient>
                                            <rect id="prefix__a" width="53" height="40" x="0" y="0" rx="4"></rect>
                                        </defs>
                                        <g fill="none" fill-rule="evenodd">
                                            <mask id="prefix__b-113" fill="#fff">
                                                <use xlink:href="#prefix__a"></use>
                                            </mask>
                                            <g mask="url(#prefix__b-113)">
                                                <path fill="url(#prefix__c-112)" fill-rule="nonzero" d="M0 0H53V40H0z">
                                                </path>
                                                <path fill="#FFF"
                                                    d="M27.857 18.225c-.02 1.717 1.542 2.673 2.72 3.244 1.209.584 1.615.959 1.61 1.481-.009.8-.965 1.153-1.86 1.167-1.56.024-2.467-.42-3.19-.753l-.562 2.612c.726.33 2.065.619 3.454.633 3.264 0 5.398-1.6 5.408-4.079.014-3.145-4.382-3.319-4.352-4.724.01-.428.42-.882 1.318-.999.444-.057 1.672-.102 3.062.534l.546-2.528c-.748-.27-1.71-.528-2.906-.528-3.07 0-5.231 1.62-5.248 3.94zm13.401-3.722c-.596 0-1.099.344-1.322.874l-4.66 11.046h3.26l.648-1.781h3.985l.375 1.78h2.873l-2.508-11.92h-2.65zm.455 3.22l.941 4.476h-2.576l1.635-4.476zm-17.808-3.22l-2.57 11.92h3.107l2.568-11.92h-3.105zm-4.595 0l-3.233 8.113-1.308-6.898c-.153-.77-.76-1.215-1.433-1.215H8.051l-.073.345c1.085.235 2.318.612 3.064 1.015.457.246.588.461.738 1.047l2.477 9.513h3.283l5.032-11.92H19.31z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg width="40" height="30" viewBox="0 0 41 31" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="injected-svg"
                                        data-src="/images/payment/mastercard.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da mastercard">
                                        <rect x="0.5" y="0.489258" width="40" height="30" rx="4" fill="white"></rect>
                                        <path d="M24.9993 7.62744H16.2429V23.3514H24.9993V7.62744Z" fill="#FF5F00">
                                        </path>
                                        <path
                                            d="M16.799 15.4892C16.7976 13.9749 17.141 12.4801 17.8032 11.118C18.4654 9.7559 19.4291 8.5622 20.6212 7.62726C19.1449 6.46771 17.3719 5.74661 15.5049 5.54637C13.6379 5.34613 11.7522 5.67482 10.0633 6.49489C8.37436 7.31496 6.95042 8.59332 5.9542 10.1838C4.95798 11.7744 4.42969 13.6129 4.42969 15.4892C4.42969 17.3656 4.95798 19.2041 5.9542 20.7946C6.95042 22.3852 8.37436 23.6635 10.0633 24.4836C11.7522 25.3037 13.6379 25.6324 15.5049 25.4321C17.3719 25.2319 19.1449 24.5108 20.6212 23.3512C19.4291 22.4163 18.4654 21.2226 17.8032 19.8605C17.141 18.4984 16.7976 17.0036 16.799 15.4892Z"
                                            fill="#EB001B"></path>
                                        <path
                                            d="M36.8121 15.4892C36.8122 17.3656 36.2839 19.2041 35.2878 20.7946C34.2916 22.3851 32.8677 23.6635 31.1788 24.4836C29.49 25.3036 27.6042 25.6324 25.7373 25.4321C23.8703 25.2319 22.0973 24.5108 20.6211 23.3512C21.8122 22.4153 22.7751 21.2214 23.4371 19.8596C24.0992 18.4977 24.4433 17.0033 24.4433 15.4892C24.4433 13.9751 24.0992 12.4808 23.4371 11.1189C22.7751 9.75704 21.8122 8.56314 20.6211 7.62726C22.0973 6.46771 23.8703 5.74661 25.7373 5.54637C27.6042 5.34613 29.49 5.67483 31.1788 6.49491C32.8677 7.31499 34.2916 8.59335 35.2878 10.1839C36.2839 11.7744 36.8122 13.6129 36.8121 15.4892Z"
                                            fill="#F79E1B"></path>
                                        <path
                                            d="M35.8574 21.6863V21.3641H35.9873V21.2985H35.6565V21.3641H35.7864V21.6863H35.8574ZM36.4997 21.6863V21.2979H36.3983L36.2817 21.565L36.165 21.2979H36.0635V21.6863H36.1351V21.3933L36.2445 21.6459H36.3188L36.4281 21.3926V21.6863H36.4997Z"
                                            fill="#F79E1B"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 53 40"
                                        class="injected-svg" data-src="/images/payment/elo.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da elo">
                                        <g fill="none" fill-rule="evenodd">
                                            <rect width="53" height="40" fill="#000" fill-rule="nonzero" rx="4"></rect>
                                            <path fill="#FFF"
                                                d="M13.082 21.665v-.343c0-2.197 1.814-3.913 3.975-3.913 1.186-.069 2.232.48 3 1.304l-6.975 2.952zm3.975-7.208c-3.835 0-6.973 3.02-6.973 6.865 0 1.373.418 2.677 1.185 3.775l6.904-2.952 2.86-1.235 2.789-1.236c-.697-2.952-3.487-5.217-6.765-5.217zM21.939 26.195c-2.51 2.334-5.788 2.54-8.717.824l1.674-2.471c1.673.961 3.277.824 4.95-.48l2.093 2.127zM24.798 24.48V11.504h2.51v12.631c0 .137 0 .206.21.275l2.162.823-.977 2.54-2.65-1.03c-.976-.411-1.255-1.03-1.255-2.265M34.213 24.273c-.907-.686-1.535-1.853-1.535-3.089 0-1.098.489-2.128 1.256-2.814L32.26 15.76c-1.604 1.236-2.65 3.227-2.65 5.423 0 2.334 1.186 4.462 3.068 5.698l1.535-2.609zM35.259 17.477c.418-.137.906-.206 1.325-.206 1.673 0 3.138 1.03 3.696 2.54l3.068-.274c-.767-3.02-3.487-5.286-6.834-5.286-.907 0-1.813.206-2.65.48l1.395 2.746zM40.559 21.39c-.07 2.06-1.813 3.707-3.975 3.707-.349 0-.628-.069-.977-.137l-1.185 2.746c.697.206 1.395.343 2.162.343 3.765 0 6.834-2.952 6.973-6.59l-2.998-.069z">
                                            </path>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="40" height="30" viewBox="0 0 53 40" class="injected-svg"
                                        data-src="/images/payment/aura.svg" role="img" style="" alt="Logo da aura">
                                        <defs>
                                            <rect id="prefix__a" width="53" height="40" x="0" y="0" rx="4"></rect>
                                            <rect id="prefix__c" width="53" height="36" x="0" y="0" rx="4"></rect>
                                        </defs>
                                        <g fill="none" fill-rule="evenodd">
                                            <mask id="prefix__b-114" fill="#fff">
                                                <use xlink:href="#prefix__a"></use>
                                            </mask>
                                            <rect width="51.94" height="38.94" x=".53" y=".53" stroke="#979797"
                                                stroke-width="1.06" rx="4"></rect>
                                            <rect width="53" height="25" y="15.231" fill="#FCEE1F" fill-rule="nonzero"
                                                mask="url(#prefix__b-114)" rx="4"></rect>
                                            <rect width="53" height="16.615" fill="#2C358A" fill-rule="nonzero"
                                                mask="url(#prefix__b-114)" rx="4"></rect>
                                            <path fill="#FCEE1F"
                                                d="M24.875 11.354c1.908 0 3.674 0 5.512.138 2.332.139 4.593.277 6.642.554h.142c-1.06-4.292-5.018-7.615-10.883-7.615-5.865-.139-9.257 3.323-10.67 7.338h.423c3.039-.277 6.007-.415 8.834-.415"
                                                mask="url(#prefix__b-114)"></path>
                                            <g mask="url(#prefix__b-114)">
                                                <g>
                                                    <path fill="#EB2227"
                                                        d="M30.387.346C28.62.276 26.783.208 24.875.208c-2.615 0-5.442.138-8.834.415C11.024 1.038 5.653 1.87 0 3.253v5.678c25.087-5.677 42.259-2.146 53 1.107V4.085C49.255 2.977 43.813 1.662 37.1.9 34.627.623 32.507.485 30.387.346"
                                                        transform="translate(0 11.077)"></path>
                                                    <path fill="#FCEE1F"
                                                        d="M14.628 13.085c-.141.346-.353.761-.565 1.107l-1.131 1.731h3.533l-1.06-1.592c-.353-.554-.636-.97-.777-1.246M38.513 16.615c-.212.07-.353.139-.494.208-.142.07-.212.208-.212.346 0 .208.141.346.353.485.283.138.636.208 1.13.208.495 0 .92-.07 1.343-.208.354-.139.636-.277.848-.485.142-.138.212-.415.212-.692V16.2c-.494.138-1.13.208-2.12.277-.494 0-.848.07-1.06.138"
                                                        transform="translate(0 11.077)"></path>
                                                    <path fill="#2C358A"
                                                        d="M32.153 16.062c0-.277.071-.554.212-.831.071-.139.283-.277.495-.416.212-.069.495-.138.777-.138.283 0 .636.07.919.138l.424-.692c-.424-.138-.848-.208-1.343-.208-.282 0-.565.07-.848.139-.282.07-.494.277-.848.623v-.623h-1.13v4.223h1.272l.07-2.215z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path stroke="#2C358A" stroke-width=".53"
                                                        d="M32.153 16.062c0-.277.071-.554.212-.831.071-.139.283-.277.495-.416.212-.069.495-.138.777-.138.283 0 .636.07.919.138l.424-.692c-.424-.138-.848-.208-1.343-.208-.282 0-.565.07-.848.139-.282.07-.494.277-.848.623v-.623h-1.13v4.223h1.272l.07-2.215h0z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path fill="#2C358A"
                                                        d="M24.521 17.792c-.353 0-.706-.069-.989-.138-.283-.139-.424-.277-.495-.416-.07-.138-.07-.415-.07-.761v-2.354h-1.272v2.63c0 .278 0 .555.07.693.071.208.212.416.424.554.212.138.495.277.848.346.354.07.778.139 1.272.139.99 0 1.838-.208 2.403-.693v.623h1.13v-4.223h-1.271v2.285c0 .346-.071.623-.212.83-.142.208-.354.347-.707.485-.424-.069-.777 0-1.13 0"
                                                        transform="translate(0 11.077)"></path>
                                                    <path stroke="#2C358A" stroke-width=".53"
                                                        d="M24.521 17.792c-.353 0-.706-.069-.989-.138-.283-.139-.424-.277-.495-.416-.07-.138-.07-.415-.07-.761v-2.354h-1.272v2.63c0 .278 0 .555.07.693.071.208.212.416.424.554.212.138.495.277.848.346.354.07.778.139 1.272.139.99 0 1.838-.208 2.403-.693v.623h1.13v-4.223h-1.271v2.285c0 .346-.071.623-.212.83-.142.208-.354.347-.707.485-.424-.069-.777 0-1.13 0h0z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path fill="#2C358A"
                                                        d="M12.932 15.923l1.13-1.73c.213-.347.425-.762.566-1.108.141.346.424.692.707 1.177l1.06 1.592h-3.463v.07zm.99-3.461l-4.029 5.815h1.484l1.131-1.8h4.381l1.202 1.8h1.554l-4.24-5.815h-1.484z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path stroke="#2C358A" stroke-width=".53"
                                                        d="M12.932 15.923l1.13-1.73c.213-.347.425-.762.566-1.108.141.346.424.692.707 1.177l1.06 1.592h-3.463v.07h0zm.99-3.461l-4.029 5.815h1.484l1.131-1.8h4.381l1.202 1.8h1.554l-4.24-5.815h-1.484 0z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path fill="#2C358A"
                                                        d="M41.693 16.477c0 .346-.07.554-.212.692-.212.208-.494.346-.848.485-.353.138-.848.208-1.342.208-.495 0-.848-.07-1.131-.208-.283-.139-.353-.277-.353-.485 0-.138.07-.207.212-.346.141-.138.282-.208.494-.208.212-.069.566-.069 1.131-.138.919-.07 1.625-.139 2.12-.277l-.07.277zm-2.261-.623c-.495 0-.919.07-1.13.138-.354.07-.637.139-.92.208-.282.07-.494.208-.635.415-.142.139-.283.347-.283.554 0 .346.212.623.636.9.424.208 1.06.346 1.908.346.495 0 .99-.069 1.413-.138.424-.07.919-.277 1.343-.485.07.208.141.346.283.554h1.342c-.141-.138-.282-.346-.353-.484-.07-.208-.07-.624-.07-1.247v-.969c0-.346 0-.554-.071-.692-.071-.208-.212-.346-.424-.485-.212-.138-.495-.207-.919-.346-.424-.07-.919-.138-1.555-.138-.636 0-1.201.069-1.696.138-.494.07-.848.208-1.13.415-.283.208-.424.416-.566.762l1.272.07c.142-.278.354-.485.636-.624.283-.138.707-.208 1.343-.208s1.13.07 1.484.277c.212.139.353.347.353.623v.208c-.494.07-1.272.139-2.261.208z"
                                                        transform="translate(0 11.077)"></path>
                                                    <path stroke="#2C358A" stroke-width=".53"
                                                        d="M41.693 16.477c0 .346-.07.554-.212.692-.212.208-.494.346-.848.485-.353.138-.848.208-1.342.208-.495 0-.848-.07-1.131-.208-.283-.139-.353-.277-.353-.485 0-.138.07-.207.212-.346.141-.138.282-.208.494-.208.212-.069.566-.069 1.131-.138.919-.07 1.625-.139 2.12-.277l-.07.277h0zm-2.261-.623c-.495 0-.919.07-1.13.138-.354.07-.637.139-.92.208-.282.07-.494.208-.635.415-.142.139-.283.347-.283.554 0 .346.212.623.636.9.424.208 1.06.346 1.908.346.495 0 .99-.069 1.413-.138.424-.07.919-.277 1.343-.485.07.208.141.346.283.554h1.342c-.141-.138-.282-.346-.353-.484-.07-.208-.07-.624-.07-1.247v-.969c0-.346 0-.554-.071-.692-.071-.208-.212-.346-.424-.485-.212-.138-.495-.207-.919-.346-.424-.07-.919-.138-1.555-.138-.636 0-1.201.069-1.696.138-.494.07-.848.208-1.13.415-.283.208-.424.416-.566.762l1.272.07c.142-.278.354-.485.636-.624.283-.138.707-.208 1.343-.208s1.13.07 1.484.277c.212.139.353.347.353.623v.208c-.494.07-1.272.139-2.261.208h0z"
                                                        transform="translate(0 11.077)"></path>
                                                </g>
                                            </g>
                                            <rect width="51.94" height="34.94" x=".53" y=".53" stroke="#FCEE1F"
                                                stroke-width="1.06" rx="4"></rect>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="40" height="30" viewBox="0 0 53 40" class="injected-svg"
                                        data-src="/images/payment/american-express.svg" role="img" style=""
                                        alt="Logo da american-express">
                                        <defs>
                                            <rect id="prefix__a" width="53" height="40" x="0" y="0" rx="4"></rect>
                                        </defs>
                                        <g fill="none" fill-rule="evenodd">
                                            <mask id="prefix__b-115" fill="#fff">
                                                <use xlink:href="#prefix__a"></use>
                                            </mask>
                                            <rect width="51.94" height="38.94" x=".53" y=".53" stroke="#979797"
                                                stroke-width="1.06" rx="4"></rect>
                                            <g mask="url(#prefix__b-115)">
                                                <path fill="#0077C4" fill-rule="nonzero" d="M0 0H53V40H0z"></path>
                                                <g>
                                                    <path fill="#FFF"
                                                        d="M48.053 11.05v-.276H43.78c-.07 0-.77 0-1.47.276v-.276h-7.496v.276c-.7-.276-1.33-.276-1.611-.276h-5.114v.207c-.63-.207-1.26-.207-1.47-.207H20.944s-.841.897-1.331 1.45c-.49-.553-1.331-1.45-1.331-1.45h-7.706v8.701h7.776s.77-.828 1.19-1.312c.42.484 1.191 1.312 1.191 1.312h4.764v-2.002h.42c.7 0 1.47-.07 2.171-.346v2.348h4.063v-2.21h.28v2.21H44.971c.49 0 .98-.069 1.471-.276v.276h4.343c.63 0 1.331-.138 1.891-.483v-8.218h-3.152c-.14 0-.77-.07-1.47.276zM2.592 8.77s.42-1.035.56-1.311h1.401c.14.276.56 1.312.56 1.312h5.184v-.138c0 .069.07.138.07.138h2.872s.07-.07.07-.138v.138h12.469V6.56h.28v2.21h6.444v-.553c.49.277.981.484 1.401.553H37.406s.42-1.036.56-1.312h1.401c.14.276.56 1.312.56 1.312h5.184V7.666c.07.138.7 1.105.7 1.105h4.134V.069h-4.063v1.105c-.07-.138-.63-1.105-.63-1.105h-4.204v1.036l-.42-1.036h-3.853C36.705.07 34.534 0 34.534 0c-.7 0-1.331.207-1.961.552V0H28.51v.276C27.81 0 27.179 0 26.899 0H12.819s-.7 1.52-.98 2.21c-.351-.69-.981-2.21-.981-2.21H6.304v1.105c0-.07-.49-1.105-.49-1.105H1.891L.07 4.213v4.489l2.522.069z"
                                                        transform="translate(0 10)"></path>
                                                    <path fill="#0077C4"
                                                        d="M24.657 3.867h1.681c.49 0 .91-.276.91-.621s-.42-.622-.91-.622h-1.681v1.243m2.662 3.66V6.286s-.07-.967-1.05-.967h-1.612v2.21h-1.611V1.174h3.923S29 .898 29 3.039c0 1.105-.91 1.45-.91 1.45s.77.345.77 1.45v1.589h-1.541M37.966 4.627h1.611l-.77-1.865-.84 1.865m8.615 2.9L43.99 3.316v4.213h-3.222l-.56-1.312h-2.942l-.56 1.312h-2.592s-2.172-.277-2.172-2.97c0-3.522 2.522-3.384 2.592-3.384l2.031.07v1.45h-1.68s-1.052 0-1.192 1.38v.415c0 2.14 1.892 1.45 1.962 1.45l2.031-4.696h2.312l2.451 5.732V1.243h2.172l2.522 4.144V1.243h1.68v6.354l-2.24-.07M3.082 4.627h1.611l-.77-1.865-.84 1.865zm11.488 2.9v-4.35l-2.031 4.35h-1.331l-2.102-4.35v4.35H5.954l-.56-1.311H2.382l-.56 1.312H0l2.732-6.354h2.311l2.452 5.801V1.174h2.592l1.821 3.937 1.751-3.937h2.592v6.354h-1.68zM17.092 7.528L17.092 1.243 22.205 1.243 22.205 2.693 18.773 2.693 18.773 3.66 22.135 3.66 22.135 5.111 18.773 5.111 18.773 6.216 22.205 6.216 22.205 7.528zM29.771 7.597L31.382 7.597 31.382 1.243 29.771 1.243zM30.961 14.572h1.682c.49 0 .91-.276.91-.622 0-.345-.42-.621-.91-.621H30.96v1.243m2.662 3.73v-1.244s-.07-.967-1.12-.967H30.89v2.21h-1.61v-6.353h3.922s2.031-.277 2.031 1.864c0 1.105-.91 1.45-.91 1.45s.77.346.77 1.45v1.59h-1.47M24.377 14.572h1.681c.49 0 .91-.276.91-.622 0-.345-.42-.621-.91-.621h-1.681v1.243M13.449 16.92h3.433l1.61-1.726-1.61-1.727h-3.433v.967h3.363v1.45h-3.363v1.036m7.285-1.796l2.032 2.21v-4.42l-2.032 2.21m2.032 3.177h-1.401l-1.751-1.864-1.752 1.864H11.838v-6.353H17.722l1.892 2.002 1.89-2.002h5.184s2.032-.208 2.032 1.864c0 1.865-.7 2.417-2.802 2.417h-1.611v2.003l-1.541.07M44.76 18.232H41.82v-1.45h2.522s.91.138.91-.483c0-.553-1.4-.553-1.4-.553s-2.242.207-2.242-1.865c0-2.071 2.031-1.933 2.031-1.933h3.152v1.45h-2.521s-.841-.138-.841.483c0 .553 1.19.484 1.19.484s2.453-.207 2.453 1.726c0 2.072-1.612 2.21-2.172 2.21-.07 0-.14-.069-.14-.069M36.005 18.301L36.005 11.948 41.118 11.948 41.118 13.398 37.686 13.398 37.686 14.365 41.048 14.365 41.048 15.815 37.686 15.815 37.686 16.92 41.118 16.92 41.118 18.301zM50.505 18.232h-2.872v-1.45h2.522s.91.138.91-.483c0-.553-1.4-.553-1.4-.553s-2.242.207-2.242-1.865c0-2.071 2.031-1.933 2.031-1.933h3.082v1.45h-2.521s-.841-.138-.841.483c0 .553 1.19.484 1.19.484s2.523-.207 2.523 1.726c0 2.072-1.612 2.21-2.172 2.21-.14 0-.21-.069-.21-.069"
                                                        transform="translate(0 10)"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 53 40"
                                        class="injected-svg" data-src="/images/payment/hipercard.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da hipercard">
                                        <g fill="none" fill-rule="evenodd">
                                            <rect width="53" height="40" fill="#FFF" fill-rule="nonzero" rx="4"></rect>
                                            <path fill="#842124"
                                                d="M16.183 9.4h-4.909c-2.17.104-3.942.987-4.454 2.808-.267.95-.414 1.993-.623 2.977-1.06 5.006-2.002 10.15-3.017 15.056H41.4c2.954 0 4.983-.632 5.531-3.002.255-1.1.499-2.348.742-3.558.95-4.717 1.901-9.434 2.874-14.281H16.183">
                                            </path>
                                            <path fill="#FFFFFE"
                                                d="M35.864 21.848c-.53.525-2.02.674-1.868-.581.127-1.042 1.25-1.264 2.466-1.113-.09.57-.194 1.294-.598 1.694zm-1.676-4.067c-.051.288-.129.548-.192.823.608-.154 2.5-.626 2.682.194.06.272-.044.562-.12.775-1.71-.164-3.105.123-3.472 1.355-.246.825.027 1.637.55 1.864 1.009.436 2.234-.064 2.659-.75-.044.237-.086.478-.072.774h.886c.01-.858.133-1.552.263-2.324.112-.657.321-1.308.288-1.888-.076-1.328-2.254-.858-3.472-.823zm8.884 4.478c-.693.015-1.038-.418-1.054-1.137-.027-1.26.519-2.658 1.629-2.784.516-.058.89.063 1.269.194-.348 1.414-.222 3.692-1.844 3.727zm2.299-6.656c-.089.782-.207 1.534-.36 2.251-2.525-.808-4.074 1.07-4.047 3.389.006.448.082.893.36 1.21.478.547 1.847.677 2.538.218.134-.089.27-.25.36-.363.066-.085.172-.306.19-.242-.035.245-.09.473-.095.75h.934c.18-2.61.737-4.839 1.15-7.213h-1.03zm-26.366 6.27c-.55.589-1.905.58-2.011-.412-.047-.432.113-.885.191-1.332.08-.452.137-.886.216-1.283.542-.67 2.137-.75 2.299.364.14.967-.239 2.174-.695 2.662zm.814-4.092c-.871-.33-1.933.065-2.394.44.002.017-.01.02-.024.02l.024-.02v-.004c.007-.161.064-.274.072-.436h-.887c-.369 2.483-.807 4.897-1.269 7.286h1.03c.149-.93.247-1.912.455-2.783.235.916 1.77.741 2.419.387 1.337-.73 2.368-4.209.574-4.89zm4.886 1.743h-2.42c.077-.562.578-1.18 1.366-1.21.742-.029 1.273.275 1.054 1.21zm-.982-1.84c-.744.059-1.373.275-1.82.751-.548.584-.992 1.874-.862 3.05.185 1.677 2.25 1.617 3.903 1.21.028-.294.099-.546.144-.823-.68.258-1.863.617-2.563.17-.528-.338-.531-1.194-.359-1.937 1.11-.036 2.265-.029 3.377 0 .07-.527.272-1.101.095-1.622-.233-.687-1.067-.864-1.915-.798zm-9.052.097c-.028.005-.026.039-.024.073-.227 1.715-.534 3.35-.862 4.962h1.03c.247-1.727.53-3.417.885-5.035h-1.03zm26.868.025c-.91-.46-1.667.311-1.963.774.084-.237.089-.555.167-.799h-.91c-.245 1.73-.541 3.407-.886 5.035h1.054c.007-.667.136-1.16.24-1.815.22-1.398.543-2.93 2.155-2.47.053-.236.075-.504.143-.725zM29.973 21.63c-.095-.248-.12-.657-.096-.968.053-.7.305-1.551.695-1.937.536-.532 1.597-.444 2.442-.145.026-.288.084-.545.12-.823-1.387-.229-2.703-.086-3.4.654-.684.724-1.131 2.39-.815 3.437.37 1.226 2.032 1.293 3.377.823.06-.246.09-.521.143-.775-.734.386-2.14.587-2.466-.266zm-.575-3.849c-.913-.372-1.63.258-1.963.848.075-.263.106-.57.167-.848h-.91c-.222 1.744-.55 3.382-.862 5.035h1.03c.144-.981.206-2.304.527-3.243.255-.75.925-1.39 1.891-1.041.014-.277.092-.488.12-.75zm-16.595-2.033c-.147.965-.313 1.91-.479 2.856-1.067.012-2.156.054-3.185-.024.194-.925.334-1.905.527-2.832h-1.15c-.411 2.36-.785 4.757-1.245 7.068h1.174c.184-1.185.356-2.383.598-3.51 1-.025 2.2-.068 3.161.025-.198 1.17-.438 2.3-.622 3.485h1.173c.377-2.394.774-4.768 1.245-7.068h-1.197zm2.921 1.065c.206-.143.47-.794.168-1.065-.096-.086-.256-.11-.479-.072-.207.035-.326.106-.407.217-.13.18-.25.72-.048.92.196.196.636.091.766 0z">
                                            </path>
                                        </g>
                                    </svg></div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-4 text-center">
                        <h4 class="">Débito</h4>
                        <div class="d-flex flex-wrap justify-content-end w-100">
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg width="40" height="30" viewBox="0 0 39 27" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="injected-svg"
                                        data-src="/images/payment/c6.svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        role="img" style="" alt="Logo da c6">
                                        <path
                                            d="M2.75424 0.5H36.2458C37.4907 0.5 38.5 1.19054 38.5 2.04237V24.9576C38.5 25.8095 37.4907 26.5 36.2458 26.5H2.75424C1.50925 26.5 0.5 25.8095 0.5 24.9576V2.04237C0.5 1.19054 1.50925 0.5 2.75424 0.5Z"
                                            fill="#242424" stroke="#666666"></path>
                                        <path
                                            d="M14.9215 16.0282C14.4286 16.4463 13.7925 16.6736 13.136 16.6662C12.2672 16.6662 11.5626 16.3744 11.0222 15.7909C10.4819 15.2074 10.2118 14.4439 10.2118 13.5002C10.2118 12.5504 10.4802 11.7836 11.0173 11.1999C11.5543 10.6161 12.2605 10.3242 13.136 10.3239C13.7625 10.3206 14.3712 10.525 14.8599 10.9028C15.3727 11.2888 15.7352 11.7984 15.9474 12.4316H20.9445C20.6843 10.5128 19.8361 8.96111 18.3998 7.77634C16.9637 6.59165 15.2021 5.99956 13.1154 6C11.5694 6 10.1775 6.32169 8.93944 6.96492C7.7014 7.60823 6.73512 8.50193 6.04044 9.64604C5.34684 10.7907 5 12.0754 5 13.5002C5 14.925 5.34707 16.2096 6.04121 17.354C6.73512 18.4993 7.70178 19.3932 8.94136 20.0354C10.1809 20.6778 11.5729 20.9993 13.1173 21C15.238 21 17.0237 20.3867 18.4745 19.1598C19.9253 17.9331 20.7671 16.33 21 14.3507H15.9271C15.7695 15.0437 15.4343 15.6029 14.9215 16.0282Z"
                                            fill="white"></path>
                                        <path
                                            d="M29.3436 16.7907C28.9992 17.1439 28.5538 17.3207 28.0074 17.3209C27.4611 17.3211 27.0157 17.1444 26.6712 16.7907C26.3268 16.4372 26.1546 15.9792 26.1549 15.4165C26.1551 14.8539 26.3272 14.3922 26.6712 14.0314C27.0151 13.6708 27.4605 13.4905 28.0074 13.4905C28.5542 13.4905 28.9996 13.6708 29.3436 14.0314C29.6874 14.3922 29.8593 14.8539 29.8596 15.4165C29.8598 15.9792 29.6878 16.4372 29.3436 16.7907ZM32.5676 11.8354C31.6122 10.9122 30.3796 10.4506 28.8697 10.4506C28.715 10.4506 28.5046 10.4577 28.2387 10.4719L30.9111 6H26.136L23.8759 9.78926C23.2362 10.8642 22.7639 11.8542 22.4588 12.7594C22.1594 13.6264 22.0043 14.5389 22 15.4589C22 17.0964 22.5568 18.4292 23.6703 19.4574C24.7838 20.4856 26.2288 20.9998 28.0056 21C29.8035 21 31.2522 20.4879 32.3516 19.4635C33.451 18.4391 34.0004 17.0901 34 15.4165C34 13.9523 33.5223 12.7579 32.5669 11.8335"
                                            fill="white"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 108 75" class="injected-svg" data-src="/images/payment/nubank.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style="" height="30"
                                        width="40" alt="Logo da nubank">
                                        <defs>
                                            <style>
                                                .nbk-1 {
                                                    fill: #820ad1;
                                                }

                                                .nbk-2 {
                                                    fill: #fff;
                                                }
                                            </style>
                                        </defs>
                                        <rect class="nbk-1" width="108" height="75" rx="8"></rect>
                                        <path class="nbk-2"
                                            d="M37.48,14.51a14,14,0,0,0-10.32,4.38H26.6a14.68,14.68,0,0,0-12.94,7.9,16.11,16.11,0,0,0-1.61,6.65c-.11,2.06,0,4.16,0,6.2V59.41H23.14s0-9.75,0-18.12c0-5.64,0-10.67,0-11.7.2-4.88,1.53-8.07,4-10.68,8.26,0,13.6,5.63,13.9,14.59.07,2,.09,13,.09,13V59.41H52.24V42c0-5.25,0-9.8-.33-12.93C50.89,20.35,45.54,14.51,37.48,14.51Z"
                                            transform="translate(0)"></path>
                                        <path class="nbk-2"
                                            d="M96,35.36V15.57H84.86s0,9.75,0,18.13c0,5.64,0,10.66,0,11.69-.2,4.88-1.53,8.07-4,10.68-8.26,0-13.6-5.63-13.9-14.58-.07-2.06-.1-7.16-.1-13.07V15.56H55.76V33c0,5.25,0,9.8.33,12.93,1,8.75,6.37,14.59,14.43,14.59a14,14,0,0,0,10.32-4.38h.56a14.66,14.66,0,0,0,12.94-7.9A16.07,16.07,0,0,0,96,41.55C96.06,39.49,96,37.4,96,35.36Z"
                                            transform="translate(0)"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg width="40" height="30" viewBox="0 0 54 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="injected-svg"
                                        data-src="/images/payment/itau.svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        role="img" style="" alt="Logo da itau">
                                        <rect width="54" height="40" rx="4" fill="#EC7000"></rect>
                                        <path
                                            d="M17.6202 5.68748L36.0927 5.68748C38.6459 5.68748 40.7113 7.75812 40.7113 10.3082V28.7833C40.7113 31.3328 38.6459 33.3988 36.0927 33.3988H17.6202C15.066 33.3988 13 31.3328 13 28.7833L13 10.3082C13 7.75812 15.066 5.68748 17.6202 5.68748"
                                            fill="#004990"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M34.1751 21.4071L35.4735 19.5403H37.5088L35.6779 21.4071H34.1751ZM19.4851 19.541V21.8529H18.5034V23.4321H19.4851V26.2474C19.4851 27.1787 19.6718 27.8781 20.0758 28.3035C20.4222 28.6753 21.0311 28.9509 21.7684 28.9509C22.4018 28.9509 22.6519 28.8562 22.9358 28.746V27.1376C22.8776 27.1652 22.7117 27.198 22.4959 27.198C21.7497 27.198 21.5771 26.7336 21.5771 25.885V23.4321H22.913V21.8529H21.5771V19.541H19.4851ZM15.3093 28.7805H17.4637V19.5412H15.3093V28.7805ZM24.2756 22.3086C24.8107 21.9971 25.7961 21.6539 27.1169 21.6539C29.5005 21.6539 30.318 23.0205 30.318 24.685V28.7805H28.5645L28.329 28.0608H28.3061C27.8355 28.6177 27.0607 28.9505 26.1429 28.9505C24.6021 28.9505 23.767 27.8871 23.767 26.8336C23.767 25.0433 25.4919 24.1364 28.2848 24.1483V24.074C28.2848 23.7495 28.0185 23.1089 26.7581 23.1125C26.0025 23.1125 25.1658 23.3761 24.6801 23.6699L24.2756 22.3086ZM28.3113 26.5731C28.3368 26.4598 28.3472 26.3344 28.3472 26.2247V25.491C28.2005 25.4889 28.0591 25.4905 27.9213 25.4952C27.6925 25.504 27.4788 25.5222 27.2848 25.5529C26.4549 25.6808 25.8985 26.0167 25.8985 26.6688C25.8985 27.2507 26.3067 27.5575 26.899 27.5575C27.5791 27.5575 28.0846 27.1326 28.2759 26.6813L28.29 26.6464C28.2941 26.636 28.3082 26.5877 28.3113 26.5731ZM36.2692 25.9161V21.8575H38.4023V28.7803H36.6961L36.4252 27.7969C36.355 27.902 36.2562 28.0205 36.1309 28.1531C36.0056 28.2868 35.8501 28.4105 35.6645 28.5234C35.4793 28.6378 35.2583 28.7355 35.0025 28.8156C34.7461 28.8967 34.4529 28.9373 34.1211 28.9373C33.7405 28.9373 33.391 28.8801 33.0754 28.7662C32.7597 28.6523 32.4883 28.4719 32.2621 28.2244C32.0359 27.9784 31.8581 27.6638 31.7281 27.2842C31.5975 26.9046 31.532 26.4439 31.532 25.9021V21.8528H33.6349V25.5173C33.6349 26.5978 34.0202 27.2442 34.8995 27.2442C35.5995 27.2442 36.0243 26.7725 36.1969 26.356C36.2489 26.225 36.2692 26.0794 36.2692 25.9161Z"
                                            fill="#FFE512"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg width="40" height="30" viewBox="0 0 40 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="injected-svg"
                                        data-src="/images/payment/bradesco.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da bradesco">
                                        <rect width="40" height="30" rx="4" fill="#CC092F"></rect>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.7405 10.0205L16.7406 10.0205C17.1178 9.98537 17.4892 9.95082 17.8624 9.92827C17.9646 9.92241 18.0666 9.91626 18.1687 9.91011C18.875 9.86753 19.5791 9.82509 20.2905 9.88186C20.5225 9.90175 20.7544 9.91397 20.9864 9.92619C21.2956 9.94248 21.6049 9.95877 21.9142 9.99325C23.5329 10.1696 25.1176 10.4898 26.6144 11.1256C27.4628 11.4876 28.2576 11.9285 28.9256 12.5643C29.5497 13.1537 29.969 13.8359 29.9982 14.6806C30.0275 15.4741 29.6911 16.161 29.1596 16.755C28.2966 17.7157 27.1898 18.3469 25.9903 18.8527C25.454 19.0801 24.9128 19.289 24.3569 19.456C24.2643 19.4839 24.1668 19.5117 24.0742 19.5164C23.8986 19.5211 23.7572 19.4468 23.6938 19.2797C23.6305 19.1126 23.689 18.9734 23.8352 18.8759C23.9328 18.8063 24.04 18.7553 24.1522 18.7089C25.1273 18.2912 26.0488 17.79 26.8046 17.0521C27.0435 16.82 27.2483 16.5555 27.3848 16.2538C27.6432 15.6876 27.5457 15.1493 27.1995 14.6481C26.8143 14.0865 26.2731 13.6781 25.6685 13.3533C24.2058 12.5643 22.6114 12.1652 20.9683 11.9146C20.1443 11.7893 19.3154 11.7243 18.4816 11.6733C17.8871 11.635 17.2926 11.6396 16.6981 11.6442L16.5362 11.6454C16.2176 11.6484 15.899 11.6728 15.5803 11.6972L15.5803 11.6972C15.4065 11.7105 15.2327 11.7238 15.0588 11.7336C14.9272 11.7429 14.8833 11.8218 14.8443 11.9239C14.3957 12.9773 14.2982 14.0633 14.4835 15.1771C14.7224 16.6065 15.4099 17.8178 16.5069 18.8202L16.5302 18.841C16.6111 18.9126 16.6926 18.9848 16.6971 19.1033C16.702 19.2565 16.6434 19.3725 16.5167 19.4607C16.3607 19.5674 16.2046 19.5257 16.0584 19.4421C15.4294 19.0708 14.8638 18.6253 14.3713 18.0916C13.7814 17.4419 13.3035 16.7272 12.9769 15.929C12.7769 15.4463 12.6356 14.9544 12.5624 14.4346L12.5461 14.3174C12.4927 13.9356 12.4401 13.5597 12.4356 13.1723C12.4308 12.8845 12.4698 12.6014 12.5137 12.3183C12.5478 12.1095 12.46 12.0863 12.2894 12.1281C12.0492 12.1857 11.8091 12.2443 11.5686 12.303C11.2669 12.3765 10.9647 12.4502 10.6609 12.5225C10.6433 12.5263 10.6257 12.5302 10.6082 12.5341C10.538 12.5496 10.4678 12.5652 10.3976 12.5689C10.2172 12.5782 10.0758 12.5133 10.0221 12.3369C9.96849 12.1559 10.0075 12.0028 10.1928 11.896C10.7145 11.5944 11.2752 11.367 11.8408 11.1535C12.1004 11.0538 12.3685 10.9703 12.6332 10.8878L12.6332 10.8878L12.6892 10.8704C12.8306 10.824 12.9135 10.7451 12.972 10.6105C14.1227 8.12296 16.1071 6.61931 18.9009 6.12273C20.5831 5.82107 22.2018 6.08561 23.728 6.80494C24.3911 7.11588 24.9957 7.51965 25.5369 8.01158C25.6763 8.1381 25.8092 8.27077 25.9429 8.40414L25.943 8.40427C26.0103 8.47144 26.0778 8.53879 26.1464 8.60561C26.3706 8.82374 26.4145 9.05578 26.2585 9.21821C26.0927 9.39457 25.8733 9.39457 25.61 9.19037C24.8835 8.62418 24.0546 8.24827 23.1526 8.0023C21.6119 7.58462 20.1053 7.68208 18.6279 8.24827C17.7015 8.60561 16.9116 9.1486 16.2144 9.82153C16.1592 9.87405 16.1113 9.93819 16.0622 10.0041L16.0622 10.0041C16.0418 10.0313 16.0212 10.0589 15.9998 10.0861C16.2506 10.066 16.4968 10.0431 16.7405 10.0205ZM22.2018 20.8855V23.5772C22.2018 24.0459 22.1238 24.1202 21.646 24.1202C21.5394 24.1202 21.4331 24.1199 21.3269 24.1196H21.3267C21.0106 24.1187 20.6958 24.1178 20.3783 24.1248C20.1735 24.1294 20.0858 24.0691 20.0858 23.8602C20.0906 22.1663 20.0906 20.4724 20.0858 18.7784C20.0858 18.6253 20.1443 18.5325 20.2759 18.4582C20.4904 18.3422 20.705 18.2239 20.9195 18.1055C21.134 17.9872 21.3486 17.8688 21.5631 17.7528C21.9483 17.5393 22.197 17.6693 22.197 18.1009C22.2018 19.0291 22.2018 19.9572 22.2018 20.8854L22.2018 20.8855ZM19.6658 22.0576C19.6662 21.8603 19.6665 21.6629 19.6665 21.4655L19.6665 21.4655V19.0986C19.6665 18.8619 19.6079 18.8294 19.3934 18.9455C19.0814 19.1125 18.7742 19.2842 18.467 19.456L18.467 19.456C18.2866 19.5581 18.1891 19.7019 18.1891 19.9108V23.8045C18.1891 24.0133 18.2866 24.1201 18.5109 24.1154C18.5914 24.1154 18.6722 24.1147 18.7533 24.1139C18.957 24.112 19.1618 24.1101 19.3642 24.1201C19.5982 24.134 19.6762 24.0505 19.6713 23.8277C19.664 23.2396 19.6649 22.649 19.6658 22.0576Z"
                                            fill="white"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40"
                                        height="30" viewBox="0 0 43 28" enable-background="new 0 0 43 28"
                                        xml:space="preserve" class="injected-svg" data-src="/images/payment/next.svg"
                                        role="img" style="" alt="Logo da next">
                                        <image id="image0" width="43" height="28" x="0" y="0"
                                            href="data:image/png;base64,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">
                                        </image>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg width="40" height="30" viewBox="0 0 40 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="injected-svg"
                                        data-src="/images/payment/banco-santander.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da banco-santander">
                                        <rect width="40" height="30" rx="4" fill="#EC0000"></rect>
                                        <path
                                            d="M24.3338 13.7156C24.3037 13.0184 24.1059 12.3387 23.7572 11.7341L20.6265 6.31167C20.3907 5.90455 20.2233 5.46142 20.1312 5L19.998 5.22638C19.223 6.56872 19.223 8.22255 19.998 9.56488L22.5042 13.9034C23.2791 15.2462 23.2791 16.9004 22.5042 18.2432L22.371 18.4696C22.2787 18.0086 22.1123 17.5657 21.8783 17.1579L19.5879 13.1856L18.123 10.6555C17.8883 10.2478 17.721 9.8049 17.6277 9.34383L17.4945 9.57021C16.7224 10.9078 16.7194 12.555 17.4865 13.8954L19.9993 18.2432C20.7743 19.5856 20.7743 21.2394 19.9993 22.5817L19.8662 22.8081C19.7728 22.347 19.6055 21.9041 19.3708 21.4964L16.2428 16.074C15.8295 15.359 15.6294 14.5407 15.6662 13.7156C12.3131 14.5879 10 16.4522 10 18.6041C10 21.599 14.477 24.0279 19.9993 24.0279C25.5217 24.0279 30 21.599 30 18.6041C30 16.4522 27.6856 14.5879 24.3338 13.7156Z"
                                            fill="white"></path>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 53 40"
                                        class="injected-svg" data-src="/images/payment/banco-do-brasil.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da banco-do-brasil">
                                        <g fill="none" fill-rule="evenodd">
                                            <rect width="53" height="40" x=".5" fill="#FFF22D" fill-rule="nonzero"
                                                rx="4"></rect>
                                            <path fill="#2360A5"
                                                d="M16.681 27.379l2.682 1.786L14 32.741v-3.576l2.681-1.786zm12.603-13.407l2.682 1.788-12.335 8.222 7.508 5.006 3.485-2.324-2.681-1.788 6.436-4.292 5.362 3.576-12.87 8.581L14 24.16l15.284-10.188zm-2.412-6.968l12.87 8.578L24.458 25.77l-2.681-1.787L34.11 15.76l-7.508-5.004-3.486 2.324 2.682 1.786-6.436 4.292L14 15.582l12.872-8.578zM39.742 7v3.577l-2.682 1.787-2.681-1.787L39.74 7z">
                                            </path>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 53 40"
                                        class="injected-svg" data-src="/images/payment/inter.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da inter">
                                        <g fill="none">
                                            <rect width="53" height="40" x=".1" y=".5" fill="#FF7A00" rx="4"></rect>
                                            <path fill="#FFF"
                                                d="M8.582 17.142H6.207c-.114 0-.207.092-.207.205v9.86c0 .114.093.206.207.206h2.375c.114 0 .207-.092.207-.205v-9.86c0-.114-.093-.206-.207-.206zM11.36 27.41h2.374c.055 0 .107-.022.146-.06.039-.039.06-.091.06-.146v-7.41c0-.05.018-.098.052-.136.033-.037.079-.062.128-.068.483-.056.97-.079 1.456-.069.864 0 1.45.223 1.764.676.186.268.279.615.279 1.046v5.965c0 .054.022.107.06.145.04.038.093.06.148.06h2.357c.055 0 .107-.022.146-.06.039-.039.06-.09.06-.145v-5.762c.01-.643-.095-1.283-.307-1.891-.61-1.692-2.127-2.656-4.3-2.656-1.622 0-3.374.194-4.435.487-.042.013-.08.039-.107.074-.027.035-.041.078-.041.123l-.044 9.624c.001.053.023.104.06.142.039.038.09.06.144.06zM41.767 27.208c0 .054.022.106.06.145.04.038.093.06.148.06h2.373c.055 0 .108-.022.147-.06.038-.039.06-.09.06-.145v-7.414c0-.05.017-.097.05-.134.032-.037.076-.062.125-.07.381-.05.766-.071 1.15-.064.449-.01.896.045 1.328.163.051.014.106.008.153-.017.046-.025.081-.068.097-.118l.699-2.15c.008-.027.01-.055.007-.083-.003-.028-.012-.055-.027-.08-.014-.024-.033-.045-.056-.062-.023-.016-.05-.028-.077-.034-.764-.17-1.546-.249-2.329-.237-1.063 0-2.619.14-3.769.498-.041.014-.078.04-.104.075-.026.036-.04.079-.039.122l.004 9.605zM39 24.781c-.016-.05-.051-.092-.098-.117-.046-.025-.1-.031-.152-.018-1.036.257-2.1.387-3.169.388-1.48 0-2.473-.702-2.473-2.756 0-.96.156-1.599.443-2.021.337-.497.856-.693 1.519-.736 1.1-.074 1.944.346 1.92 1.018l-1.067.543-1.718.875c-.024.013-.046.03-.063.05-.018.022-.03.045-.039.071-.008.026-.01.053-.008.08.002.027.01.053.023.077l1.007 1.904c.026.047.069.082.12.098.051.016.106.012.154-.011l3.55-1.709.834-.401c.036-.018.066-.045.087-.078.02-.034.031-.072.031-.112-.043-3.352-1.711-5.027-4.832-5.027-2.238 0-3.725.915-4.405 2.667-.281.723-.428 1.585-.428 2.59v.244c0 3.488 1.798 5.257 5.344 5.257 1.426 0 2.859-.191 3.972-.51.026-.008.05-.02.072-.038.021-.017.039-.039.051-.063.013-.024.02-.05.023-.078.003-.027 0-.054-.01-.08L39 24.78zM28.519 24.507c-.544.26-1.287.668-2.246.548-.83-.105-1.26-.452-1.26-1.335v-3.748c0-.054.022-.106.061-.145.039-.039.092-.06.146-.06h3.065c.027 0 .054-.006.08-.016.024-.01.047-.026.066-.045.02-.019.035-.041.045-.066.01-.025.016-.052.016-.079v-2.21c0-.055-.022-.107-.06-.145-.04-.039-.092-.06-.147-.061H25.22c-.027 0-.054-.005-.08-.016-.024-.01-.047-.026-.066-.045-.02-.019-.035-.042-.045-.067-.01-.025-.016-.052-.015-.079v-3.732c0-.036-.01-.07-.027-.102-.018-.03-.043-.056-.073-.075-.031-.018-.066-.028-.102-.029-.035 0-.07.007-.102.024l-2.373 1.231c-.034.018-.062.044-.082.076-.02.032-.03.069-.03.106v9.26c0 2.576 1.408 4.04 4.034 4.04 1.075 0 1.973-.23 3.373-.918l.392-.197c.048-.024.085-.066.103-.116.018-.05.014-.106-.009-.155l-.922-1.946c-.011-.025-.028-.047-.049-.065-.02-.019-.045-.033-.07-.042-.027-.009-.055-.012-.082-.01-.028.001-.055.009-.08.02l-.396.2z">
                                            </path>
                                        </g>
                                    </svg></div>
                            </div>
                            <div class="relative mb-2 mr-2 box-border inline-block" width="40" height="30">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 42 31"
                                        class="injected-svg" data-src="/images/payment/caixa-economica.svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" role="img" style=""
                                        alt="Logo da caixa-economica">
                                        <g fill="none" fill-rule="evenodd" transform="translate(.125 .671)">
                                            <rect width="39.75" height="30" x=".375" fill="#185EA8" fill-rule="nonzero"
                                                rx="3"></rect>
                                            <g>
                                                <path fill="#F39200"
                                                    d="M16.738 0L23.975 0 16.048 8.25 8.761 8.25zM7.977 9.05L15.214 9.05 7.286 17.3 0 17.3z"
                                                    transform="translate(8.275 6.75)"></path>
                                                <path fill="#FFF"
                                                    d="M4.7 0L11.811 0 16.055 8.25 8.769 8.25zM8 9.05L15.111 9.05 19.355 17.3 12.069 17.3z"
                                                    transform="translate(8.275 6.75)"></path>
                                            </g>
                                        </g>
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" px-0 pb-2 pt-4 text-center footer-text">
                    <p>ButacaBox.com Ltda / CNPJ: 008606400001-71 Endereço: R. Konrad Adenauer, 442 - Tarumã, Curitiba -
                        PR, 82820-540</p>
                    <p>© 2024 - Copyright
                        ButacaBox - todos os direitos reservados</p>
                </div>


            </div>
    </div>
    </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    <script src="src/js/cartaz_filmes.js"></script>


</body>

</html>