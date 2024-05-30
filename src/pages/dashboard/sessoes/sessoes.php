<?php
include ('../../../pages/login-funcionario/protect.php')
  ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ButacaBox</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2598/2598702.png">
  <link rel="stylesheet" href="http://127.0.0.1/ButacaBox/ButacaBox/src/css/dashboard.css">
</head>

<body class="vh-100">
  <main class="d-flex flex-nowrap h-100">
    <?php
    include ('../../../../components/sidebar.php');
    ?>

    <div class="container-fluid h-100">
      <div class="d-flex flex-column h-100">
        <div class="p-3">
          <input id="searchInput" type="text" class="form-control" placeholder="Buscar filme">
        </div>
        <div class="table-responsive small flex-grow-1">
          <table class="table table-responsive table-lg ">
            <thead>
              <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Data</th>
                <th scope="col" class="text-center">Horário</th>
                <th scope="col" class="text-center">Filme</th>
                <th scope="col" class="text-center">Sala</th>
                <th scope="col" class="text-center">Filial</th>
                <th scope="col" class="text-center">Assentos Disponíveis</th>
                <th scope="col" class="text-center">Preço do ingresso</th>
                <th scope="col" class="text-center" style="width: 185px;">Ações</th>
              </tr>
            </thead>
            <tbody id="movieSessionTableBody">
            </tbody>
          </table>
        </div>
        <div class="p-3 text-end">
          <a href="sessoesCreate.php">
            <button class="btn btn-success ">Adicionar sessão</button>
          </a>
        </div>
      </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body label">
            Tem certeza de que deseja excluir esta sessão?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" style="background-color: #3ba6ff; color: #fff;"
              data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn" style="background-color: #d9534f; color: #fff;"
              id="confirmDeleteButton">Excluir</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editMovieSessionModal" tabindex="-1"
      aria-labelledby="editMovieMovieMovieSessionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editMovieSessionModalLabel">Editar Sessão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <div class="mb-3">
                <label id="data_sessao_label" for="data_sessao" class="form-label">Data</label>
                <input type="date" class="form-control" id="data_sessao" name="data_sessao">
              </div>
              <div class="mb-3">
                <label id="hora_sessao_label" for="hora_sessao" class="form-label">Hora</label>
                <input type="text" class="form-control" id="hora_sessao" name="hora_sessao">
              </div>
              <div class="mb-3">
                <label for="nome_filme" class="form-label">Filme</label>
                <select class="form-select" id="nome_filme" name="nome_filme">
                  <option selected disabled>Selecionar filme</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="nome_sala" class="form-label">Filme</label>
                <select class="form-select" id="nome_sala" name="nome_sala">
                  <option selected disabled>Selecionar Sala</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="nome_filial" class="form-label">Filial</label>
                <select class="form-select form-select-md" name="nome_filial" id="nome_filial">
                  <option selected disabled class="disabled">Selecionar filial</option>
                  <option value="1">Matriz</option>
                  <option value="2">Tarumã</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="preco_ingresso" class="form-label">Preço do ingresso</label>
                <input type="text" class="form-control" id="preco_ingresso" name="preco_ingresso">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button style="background-color: #d9534f;" type="button" class="btn btn-sm text-white"
              data-bs-dismiss="modal">Cancelar</button>
            <button style="background-color: #3ba6ff;" type="submit" form="editForm" class="btn btn-sm text-white"
              id="saveChanges">Salvar Alterações</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="../../../js/sessoes.js"></script>
  <script>
    function fetchMovies() {
      fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/filmes/getMovies.php')
        .then(response => response.json())
        .then(data => {
          const selectFilme = document.getElementById('nome_filme');
          data.forEach(movie => {
            const option = document.createElement('option');
            option.value = movie.id_filme;
            option.textContent = movie.titulo;
            selectFilme.appendChild(option)
          });
        })
        .catch(error => console.error(error))
    }
    function fetchMovieRooms() {
      fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/salas/getMovieRooms.php')
        .then(response => response.json())
        .then(data => {
          const selectSala = document.getElementById('nome_sala');
          data.forEach(room => {
            const option = document.createElement('option');
            option.value = room.id_sala;
            option.textContent = room.nome;
            selectSala.appendChild(option)
          });
        })
        .catch(error => console.error(error))
    }
    fetchMovies();
    fetchMovieRooms();
  </script>
</body>

</html>