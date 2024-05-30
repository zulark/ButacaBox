var movies = [];
function fetchFornecedores() {
    fetch('../../api/fornecedores/getFornecedores.php')
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
fetchFornecedores();
function fetchMovies() {
    fetch('../../api/filmes/getMovies.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            movies = data;
            displayMovies(movies);
        })
        .catch(error => console.error(error));
}
function displayMovies(movies) {
    var tableBody = document.getElementById('movieTableBody');
    tableBody.innerHTML = '';
    movies.forEach(function (movie) {
        var row = document.createElement('tr');
        row.innerHTML = `
                <td class="text-center">${movie.id_filme}</td>
                <td class="text-center">${movie.titulo}</td>
                <td class="text-center">${movie.diretor}</td>
                <td class="text-center">${movie.genero}</td>
                <td class="text-center">${movie.duracao}</td>
                <td class="text-center">${movie.fornecedor_id}</td>
                <td class="text-center">${movie.status_filme}</td>
                <td class="text-center">${movie.youtube_url}</td>
                <td" class="d-flex">
                    <button style="background-color: #3ba6ff;" class="btn btn-sm w-50 text-white" id="editMovieButton" onclick="editMovie(${movie.id_filme})">Editar</button>
                    <button style="background-color: #d9534f;" class="btn btn-sm w-50 text-white" onclick="deleteMovie(${movie.id_filme})">Deletar</button>
                </td>
            `;
        tableBody.appendChild(row);
    });
}
function searchMovies() {
    var searchValue = document.getElementById('searchInput').value.trim();
    if (searchValue !== '') {
        var filteredMovies = movies.filter(function (movie) {
            return movie.id_filme.toString().indexOf(searchValue) !== -1 || movie.titulo.toLowerCase().includes(searchValue) || movie.status_filme.toLowerCase().includes(searchValue);
        });
        displayMovies(filteredMovies);
    } else {
        displayMovies(movies);
    }
}
document.getElementById('searchInput').addEventListener('input', searchMovies);
fetchMovies();
var editModal = new bootstrap.Modal(document.getElementById('editMovieModal'), {
    keyboard: false
});
document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();
    var id = document.getElementById('editMovieModalLabel').innerText.split(":")[1].trim();
    saveMovieChanges(id);
    editModal.hide();
});
function editMovie(id) {
    fetch(`../../api/filmes/getMovies.php?id=${id}`, {
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
            document.getElementById("titulo").value = data.titulo;
            document.getElementById("cartaz_filme").value = data.cartaz_filme;
            document.getElementById("diretor").value = data.diretor;
            document.getElementById("genero").value = data.genero;
            document.getElementById("duracao").value = data.duracao;
            document.getElementById("fornecedor_id").value = data.fornecedor_id;
            document.getElementById("descricao").value = data.descricao;
            document.getElementById("youtube_url").value = data.youtube_url;
            document.getElementById("status_filme").value = data.status_filme;
            editModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
        });

    const modalLabel = document.getElementById('editMovieModalLabel');
    modalLabel.innerText = `Editar filme: ${id}`;
}
function saveMovieChanges(id) {
    var titulo = document.getElementById('titulo').value;
    var cartaz_filme = document.getElementById('cartaz_filme').value;
    var diretor = document.getElementById('diretor').value;
    var genero = document.getElementById('genero').value;
    var duracao = document.getElementById('duracao').value;
    var fornecedor_id = document.getElementById('fornecedor_id').value;
    var descricao = document.getElementById('descricao').value;
    var youtube_url = document.getElementById('youtube_url').value;
    var status_filme = document.getElementById('status_filme').value;
    var filmeData = {
        titulo: titulo,
        cartaz_filme: cartaz_filme,
        diretor: diretor,
        genero: genero,
        duracao: duracao,
        fornecedor_id: fornecedor_id,
        descricao: descricao,
        status_filme: status_filme,
        youtube_url: youtube_url
    };
    fetch(`../../api/filmes/updateMovie.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(filmeData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            fetchMovies();
        })
        .catch(error => {
            console.error('Erro ao salvar alterações do filme:', error);
            alert('Erro ao salvar alterações do filme: ' + error.message);
        });
}
function deleteMovie(id_filme) {
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    confirmDeleteModal.show();

    const confirmButton = document.getElementById('confirmDeleteButton');
    const newButton = confirmButton.cloneNode(true);
    confirmButton.parentNode.replaceChild(newButton, confirmButton);

    newButton.addEventListener('click', function () {
        fetch(`../../api/filmes/deleteMovie.php?id_filme=${id_filme}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    fetchMovies();
                } else {
                    response.json().then(data => {
                        alert('Erro ao excluir filme: ' + data.error);
                    });
                }
            })
            .catch(error => {
                console.error('Erro ao excluir filme:', error);
                alert('Erro ao excluir filme: ' + error.message);
            });

        confirmDeleteModal.hide();
    });
}

