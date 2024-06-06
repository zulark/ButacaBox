var movieSessions = [];

function fetchMovieSessions() {
    fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/sessoes/getMovieSessions.php')
        .then(response => response.json())
        .then(data => {
            movieSessions = data;
            displayMovieSessions(movieSessions);
        })
        .catch(error => console.error(error));
}
function displayMovieSessions(movieSessions) {
    var tableBody = document.getElementById('movieSessionTableBody');
    tableBody.innerHTML = '';
    movieSessions.forEach(function (movieSession) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center">${movieSession.id_sessao}</td>
            <td class="text-center">${movieSession.data_sessao}</td>
            <td class="text-center">${movieSession.hora_sessao}</td>
            <td class="text-justify">${movieSession.nome_filme}</td> 
            <td class="text-center">${movieSession.nome_sala}</td>
            <td class="text-center">${movieSession.nome_filial}</td>
            <td class="text-center">${movieSession.assentos_disponiveis}</td>
            <td class="text-center">R$${movieSession.preco_ingresso}</td>
            <td class="d-flex">
                <button style="background-color: #3ba6ff;" class="btn btn-sm w-50 text-white" id="editmovieSessionButton" onclick="editMovieSession(${movieSession.id_sessao})">Editar</button>
                <button style="background-color: #d9534f;" class="btn btn-sm w-50 text-white" onclick="deletemovieSession(${movieSession.id_sessao})">Deletar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
function searchMovieSessions() {
    var searchValue = document.getElementById('searchInput').value.trim().toLowerCase();
    if (searchValue !== '') {
        var filteredMovieSessions = movieSessions.filter(function (movieSession) {
            return movieSession.id_sessao.toString().indexOf(searchValue) !== -1
                || movieSession.nome_filme.toLowerCase().includes(searchValue)
                || movieSession.nome_filial.toLowerCase().includes(searchValue);

        });
        displayMovieSessions(filteredMovieSessions);
    } else {
        displayMovieSessions(movieSessions);
    }
}
document.getElementById('searchInput').addEventListener('input', searchMovieSessions);
fetchMovieSessions();
var editModal = new bootstrap.Modal(document.getElementById('editMovieSessionModal'));
document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();
    var id = document.getElementById('editMovieSessionModalLabel').innerText.split(":")[1].trim();
    savemovieSessionChanges(id);
    editModal.hide();
});
function editMovieSession(id) {
    fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/sessoes/getMovieSessions.php?id=${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('data_sessao').value = data.data_sessao;
            document.getElementById('hora_sessao').value = data.hora_sessao;
            document.getElementById('nome_filme').value = data.filme_id;
            document.getElementById('nome_sala').value = data.sala_id;
            document.getElementById('nome_filial').value = data.filial_id;
            document.getElementById('preco_ingresso').value = data.preco_ingresso;
            editModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    const modalLabel = document.getElementById('editMovieSessionModalLabel');
    modalLabel.innerText = `Editar sessão: ${id}`;
}
function savemovieSessionChanges(id) {
    var data_sessao = document.getElementById('data_sessao').value;
    var hora_sessao = document.getElementById('hora_sessao').value;
    var nome_filme = document.getElementById('nome_filme').value;
    var nome_sala = document.getElementById('nome_sala').value;
    var nome_filial = document.getElementById('nome_filial').value;
    var preco_ingresso = document.getElementById('preco_ingresso').value;

    var movieSessionData = {
        data_sessao: data_sessao,
        hora_sessao: hora_sessao,
        filme_id: nome_filme,
        sala_id: nome_sala,
        filial_id: nome_filial,
        preco_ingresso: preco_ingresso
    };
    fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/sessoes/updateMovieSessions.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(movieSessionData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            fetchMovieSessions();
        })
        .catch(error => {
            console.error('Erro ao salvar alterações da sessão:', error);
            alert('Erro ao salvar alterações da sessão: ' + error.message);
        });
}
function deletemovieSession(id) {
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const modalLabel = document.getElementById('confirmDeleteModalLabel');
    modalLabel.innerText = `Excluir sessão: ${id}?`;
    confirmDeleteModal.show();
    const confirmButton = document.getElementById('confirmDeleteButton');
    const newButton = confirmButton.cloneNode(true);
    confirmButton.parentNode.replaceChild(newButton, confirmButton);

    newButton.addEventListener('click', function () {
        fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/sessoes/deleteMovieSessions.php?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    fetchMovieSessions();
                }
            })
            .catch(error => {
                console.error('Erro ao excluir sessão:', error);
                alert('Erro ao excluir sessão: ' + error.message);
            });
        confirmDeleteModal.hide();
    });
}
