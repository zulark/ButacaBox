<?php
include ('../../login-funcionario/protect.php');

?><!DOCTYPE html>
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

<body class="vh-100">
    <main class="d-flex flex-nowrap h-100">
        <?php
        include ('../../../../components/sidebarSmall.php');
        include ('../../../../components/sidebar.php');
        ?>
        <div class="container">
            <div class="pt-3 pb-3 text-center">
                <h1>Relatório de Vendas</h1>
                <button id="mobileBtn" class="btn btn-dark d-flex d-md-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                    <span class="navbar-toggler-icon">
                        <i class="bi bi-list text-white"></i>
                    </span>
                </button>
            </div>
            <form id="filter-form">
                <div class="row mb-3">
                    <div class="col-12 col-sm-4">
                        <label for="ano" class="form-label">Ano</label>
                        <select class="form-select" id="ano" name="ano">
                            <option value="">Todos os anos</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label for="mes" class="form-label">Mês</label>
                        <select class="form-select" id="mes" name="mes">
                            <option value="">Todos os meses</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-4">
                        <label for="filial_id" class="form-label">Filial</label>
                        <select class="form-select" id="filial_id" name="filial_id">
                            <option value="">Todas as filiais</option>
                            <option value="1">Butacabox Centro</option>
                            <option value="2">Butacabox Tarumã</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
            <hr>
            <div id="error-message" class="alert alert-danger mt-3" style="display: none;">Nenhum dado encontrado.</div>
            <table id="report-table" class="table table-striped mt-4" style="display: none;">
                <thead>
                    <tr>
                        <th class="text-center">Filial</th>
                        <th class="text-center">Período</th>
                        <th class="text-center">Valor total de vendas</th>
                        <th class="text-center">Quantidade de Ingressos vendidos</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        document.getElementById('filter-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const ano = document.getElementById('ano').value;
            const mes = document.getElementById('mes').value;
            const filial_id = document.getElementById('filial_id').value;
            const formData = new FormData();
            if (filial_id) formData.append('filial_id', filial_id);
            if (ano) formData.append('ano', ano);
            if (mes) formData.append('mes', mes);
            fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/relatorios/vendas.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const reportTable = document.getElementById('report-table');
                const errorMessage = document.getElementById('error-message');
                if (data.length > 0) {
                    errorMessage.style.display = 'none';
                    reportTable.style.display = 'table';
                    const tbody = reportTable.querySelector('tbody');
                    tbody.innerHTML = '';
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td class="text-center">${row.nome}</td>
                        <td class="text-center">${row.periodo}</td>
                        <td class="text-center">${parseFloat(row.valor_total_vendas).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</td>
                        <td class="text-center">${row.total_ingressos_vendidos}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                } else {
                    errorMessage.style.display = 'block';
                    reportTable.style.display = 'none';
                }
                })
            .catch(error => console.error('Erro:', error));
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