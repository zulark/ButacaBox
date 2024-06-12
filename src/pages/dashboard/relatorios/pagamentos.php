<?php
include ('../../login-funcionario/protect.php');

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butacabox Dashboard</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2598/2598702.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <div class="pt-3 pb-3 d-flex justify-content-between align-items-center">
                <h1>Relatório de pagamentos</h1>
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
                        <th class="text-center">Data</th>
                        <th class="text-center">Filial</th>
                        <th class="text-center">Valor total de pagamentos mensais</th>
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
            const filial_id = document.getElementById('filial_id').value;
            const formData = new FormData();
            if (filial_id) formData.append('filial_id', filial_id);
            fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/relatorios/pagamentos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const reportTable = document.getElementById('report-table');
                const errorMessage = document.getElementById('error-message');
                if (data.length > 0) {
                    var currentDate = new Date();
                    var dd = String(currentDate.getDate()).padStart(2, '0');
                    var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
                    var yy = currentDate.getFullYear();
                    currentDate = dd + '/' + mm + '/' + yy;
                    errorMessage.style.display = 'none';
                    reportTable.style.display = 'table';
                    const tbody = reportTable.querySelector('tbody');
                    tbody.innerHTML = '';
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="text-center">${currentDate}</td>
                            <td class="text-center">${row.nome}</td>
                            <td class="text-center">${parseFloat(row.valor_total_pagamentos).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</td>
                            `;
                            tbody.appendChild(tr);
                    });
                } 
                else {
                    errorMessage.style.display = 'block';
                    reportTable.style.display = 'none';
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>