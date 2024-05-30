<?php
include ('../../pages/login-funcionario/protect.php');

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

    <!-- Sidebar -->
    <?php 
    include('../../../components/sidebar.php');
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
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Diretor</th>
                <th scope="col">Gênero</th>
                <th scope="col">Duração (min)</th>
                <th scope="col">ID do Fornecedor</th>
                <th scope="col">Status</th>
                <th scope="col">URL Trailer</th>
                <th scope="col" class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody id="movieTableBody">
            </tbody>
          </table>
        </div>
        <div class="p-3 text-end">
          <a href="dashboard-create-movie.php">
            <button class="btn btn-success ">Adicionar Filme</button>
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
            Tem certeza de que deseja excluir este filme?
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

    <div class="modal fade" id="editMovieModal" tabindex="-1" aria-labelledby="editMovieModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editMovieModalLabel">Editar Filme</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
              </div>
              <div class="mb-3">
                <label for="cartaz_filme" class="form-label">URL do Cartaz</label>
                <input type="text" class="form-control" id="cartaz_filme" name="cartaz_filme">
              </div>
              <div class="mb-3">
                <label for="diretor" class="form-label">Diretor</label>
                <input type="text" class="form-control" id="diretor" name="diretor">
              </div>
              <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <input type="text" class="form-control" id="genero" name="genero">
              </div>
              <div class="mb-3">
                <label for="duracao" class="form-label">Duração</label>
                <input type="number" class="form-control" id="duracao" name="duracao">
              </div>
              <div class="mb-3">
                <label for="fornecedor_id" class="form-label">ID do Fornecedor</label>
                <select class="form-select" id="fornecedor_id" name="fornecedor_id">
                  <option selected disabled>Selecionar fornecedor</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="youtube_url" class="form-label">Link do trailer</label>
                <input type="text" class="form-control" id="youtube_url" name="youtube_url">
              </div>
              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao"></textarea>
              </div>
              <div class="mb-3">
                <label for="status_filme" class="form-label ">Status de lançamento</label>
                <select class="form-select form-select-md" name="status_filme" id="status_filme">
                  <option selected disabled class="disabled">Selecionar filial</option>
                  <option value="estreia">Estreia</option>
                  <option value="cartaz">Em cartaz</option>
                  <option value="em_breve">Em breve</option>
                  <option value="desativado">Desativado</option>
                </select>
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
  <script src="../../js/dashboard.js"></script>

</body>

</html>