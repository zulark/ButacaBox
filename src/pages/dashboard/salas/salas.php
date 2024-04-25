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
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar">
      <a href="../../../index.php"
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
          <a href="../dashboard.php" class="nav-link text-white" aria-current="page">
            Filmes
          </a>
        </li>
        <li>
          <a href="../funcionarios/funcionarios.php" class="nav-link text-white">
            Funcionarios
          </a>
        </li>
        <li>
          <a href="salas.php" class="nav-link active">
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
                <th scope="col">Nome</th>
                <th scope="col">Capacidade</th>
                <th scope="col" class="text-center" style="width: 185px;">Ações</th>
              </tr>
            </thead>
            <tbody id="movieRoomTableBody">
            </tbody>
          </table>
        </div>
        <div class="p-3 text-end">
          <a href="salasCreate.php">
            <button class="btn btn-success ">Adicionar sala</button>
          </a>
        </div>
      </div>
    </div>

    <!-- Modal de Exclusão -->

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body label">
            Tem certeza de que deseja excluir esta sala?
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

    <!-- Modal de Edição -->
    <div class="modal fade" id="editMovieRoomModal" tabindex="-1" aria-labelledby="editMovieMovieMovieRoomModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editMovieRoomModalLabel">Editar Sala</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome">
              </div>
              <div class="mb-3">
                <label for="capacidade" class="form-label">Quantidade de assentos</label>
                <input type="number" class="form-control" id="capacidade" name="capacidade">
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
  <!-- Bootstrap JS files -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <script src="../../../js/salas.js"></script>

</body>

</html>