var movieRooms = [];

function fetchMovieRooms() {
    fetch('../../../api/salas/getMovieRooms.php')
        .then(response => response.json())
        .then(data => {
            movieRooms = data;
            displayMovieRooms(movieRooms);
        })
        .catch(error => console.error(error));
}

function displayMovieRooms(movieRooms) {
    var tableBody = document.getElementById('movieRoomTableBody');
    tableBody.innerHTML = '';
    movieRooms.forEach(function (movieRoom) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${movieRoom.id_sala}</td>
            <td>${movieRoom.nome}</td>
            <td>${movieRoom.capacidade}</td>
            <td class="d-flex">
                <button style="background-color: #3ba6ff;" class="btn btn-sm w-50 text-white" id="editmovieRoomButton" onclick="editmovieRoom(${movieRoom.id_sala})">Editar</button>
                <button style="background-color: #d9534f;" class="btn btn-sm w-50 text-white" onclick="deletemovieRoom(${movieRoom.id_sala})">Deletar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}


function searchMovieRooms() {
    var searchValue = document.getElementById('searchInput').value.trim().toLowerCase();
    if (searchValue !== '') {
        var filteredMovieRooms = movieRooms.filter(function (movieRoom) {
            return movieRoom.id_sala.toString().indexOf(searchValue) !== -1 || movieRoom.nome.toLowerCase().includes(searchValue);
        });
        displayMovieRooms(filteredMovieRooms);
    } else {
        displayMovieRooms(movieRooms);
    }
}

document.getElementById('searchInput').addEventListener('input', searchMovieRooms);

fetchMovieRooms();

var editModal = new bootstrap.Modal(document.getElementById('editMovieRoomModal'));


document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();

    var id = document.getElementById('editMovieRoomModalLabel').innerText.split(":")[1].trim();

    savemovieRoomChanges(id);

    editModal.hide();
});

function editmovieRoom(id) {
    fetch(`../../../api/salas/getMovieRooms.php?id=${id}`, {
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
            document.getElementById("nome").value = data.nome;
            document.getElementById("capacidade").value = data.capacidade;
            editModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
        });

    const modalLabel = document.getElementById('editMovieRoomModalLabel');
    modalLabel.innerText = `Editar sala: ${id}`;
}

function savemovieRoomChanges(id) {
    var nome = document.getElementById('nome').value;
    var capacidade = document.getElementById('capacidade').value;

    var movieRoomData = {
        nome: nome,
        capacidade: capacidade,
    };

    fetch(`../../../api/salas/updateMovieRoom.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(movieRoomData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            fetchMovieRooms();
        })
        .catch(error => {
            console.error('Erro ao salvar alterações da sala:', error);
            alert('Erro ao salvar alterações da sala: ' + error.message);
        });
}

function deletemovieRoom(id) {
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const modalLabel = document.getElementById('confirmDeleteModalLabel');
    modalLabel.innerText = `Excluir sala: ${id}?`;
    confirmDeleteModal.show();

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        fetch(`../../../api/salas/deleteMovieRoom.php?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    fetchMovieRooms();
                }
            })
            .catch(error => {
                console.error('Erro ao excluir sala:', error);
                alert('Erro ao excluir sala: ' + error.message);
            });

        confirmDeleteModal.hide();
    });
}
