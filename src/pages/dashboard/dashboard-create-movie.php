<?php
include ('../../pages/login-funcionario/protect.php')
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butacabox Dashboard</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2598/2598702.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="http://127.0.0.1/ButacaBox/ButacaBox/src/css/dashboard.css">
</head>


<body>
    <main class="d-flex flex-nowrap vh-100">
        <!-- Sidebar -->
        <?php
        include ('../../../components/sidebarSmall.php');
        include ('../../../components/sidebar.php');
        ?>
        <div class="container-fluid h-100">
            <div class="d-flex flex-column h-100 d-flex align-items-center justify-content-center">
                <div class="p-5">
                    <form id="createForm" class="row g-3">
                        <div class="col-6">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="col-6">
                            <label for="cartaz_filme" class="form-label">Cartaz do Filme</label>
                            <input type="text" class="form-control" id="cartaz_filme" name="cartaz_filme">
                        </div>
                        <div class="col-6">
                            <label for="diretor" class="form-label">Diretor</label>
                            <input type="text" class="form-control" id="diretor" name="diretor">
                        </div>
                        <div class="col-6">
                            <label for="genero" class="form-label">Gênero</label>
                            <input type="text" class="form-control" id="genero" name="genero">
                        </div>
                        <div class="col-6">
                            <label for="duracao" class="form-label">Duração (min)</label>
                            <input type="number" min="1" max="999" class="form-control" id="duracao" name="duracao">
                        </div>
                        <div class="col-6">
                            <label for="fornecedor_id" class="form-label">ID do Fornecedor</label>
                            <select class="form-select" id="fornecedor_id" name="fornecedor_id">
                                <option selected disabled>Selecionar fornecedor</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="youtube_url" class="form-label">Link do trailer</label>
                            <input type="text" class="form-control" id="youtube_url" name="youtube_url">
                        </div>
                        <div class="col-12">
                            <label for="status_filme" class="form-label ">Status de lançamento</label>
                            <select class="form-select form-select-md" name="status_filme" id="status_filme">
                                <option selected disabled class="disabled">Selecionar status</option>
                                <option value="estreia">Estreia</option>
                                <option value="cartaz">Em cartaz</option>
                                <option value="em_breve">Em breve</option>
                                <option value="desativado">Desativado</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <div class="alert-message d-none m-2" id="alertMessage"></div>
                            <div id="errorMessage" class="alert alert-danger d-none m-2" role="alert"></div>
                        </div>
                    </form>
                    <div class="p-3 text-end">
                        <a href="dashboard.php">
                            <button class="btn btn-primary">
                                <svg style="color: #fff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24" height="24" fill="currentColor">
                                    <path fill="none" d="M0 0h24v24H0V0z" />
                                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function fecthMovie() {
            fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/fornecedores/getFornecedores.php')
                .then(response => response.json())
                .then(data => {
                    const selectFornecedor = document.getElementById('fornecedor_id');
                    data.forEach(provider => {
                        const option = document.createElement('option');
                        option.value = provider.id_fornecedor;
                        option.textContent = provider.nome;
                        selectFornecedor.appendChild(option);
                    });
                })
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('createForm').reset();
            fecthMovie();
        });
        document.getElementById('createForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var formData = {
                titulo: document.getElementById('titulo').value,
                cartaz_filme: document.getElementById('cartaz_filme').value,
                diretor: document.getElementById('diretor').value,
                genero: document.getElementById('genero').value,
                duracao: document.getElementById('duracao').value,
                fornecedor_id: document.getElementById('fornecedor_id').value,
                descricao: document.getElementById('descricao').value,
                status_filme: document.getElementById('status_filme').value,
                youtube_url: document.getElementById('youtube_url').value
            };

            var jsonData = JSON.stringify(formData);

            fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/filmes/createMovie.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: jsonData
            })
                .then(response => response.json())
                .then(data => {
                    var alertMessage = document.getElementById('alertMessage');
                    alertMessage.innerHTML = data.success ? '<div class="alert alert-success" role="alert">Filme adicionado com sucesso!</div>' : '<div class="alert alert-danger" role="alert">Erro ao adicionar filme!</div>';
                    alertMessage.classList.remove('d-none');
                    if (data.success) {
                        document.getElementById('createForm').reset();
                        setTimeout(() => {
                            alertMessage.classList.add('d-none');
                        }, 2000);
                    } else {
                        setTimeout(() => {
                            alertMessage.classList.add('d-none');
                        }, 2000);
                    }
                })
                .catch(error => {
                    var errorMessage = document.getElementById('errorMessage');
                    errorMessage.innerHTML = 'Erro ao salvar: ' + error;
                    errorMessage.classList.remove('d-none');
                    setTimeout(() => {
                        errorMessage.classList.add('d-none');
                    }, 5000);
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>