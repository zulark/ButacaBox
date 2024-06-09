var setores = [];
function fetchSetores() {
    fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/setores/getSetor.php')
        .then(response => response.json())
        .then(data => {
            setores = data;
            displaySetores(setores);
        })
        .catch(error => console.error(error));
}
function displaySetores(setores) {
    var tableBody = document.getElementById('TableBody');
    tableBody.innerHTML = '';
    setores.forEach(function (setor) {
        var row = document.createElement('tr');
        row.innerHTML =
            `<td class="text-center">${setor.id_setor}</td>
            <td class="text-center">${setor.nome}</td>
            <td class="text-center">${setor.nome_chefe}</td>
            <td class="d-flex">
                <button style="background-color: #3ba6ff;" class="btn btn-sm w-50 text-white" id="editButton" onclick="editSetor(${setor.id_setor})">Editar</button>
                <button style="background-color: #d9534f;" class="btn btn-sm w-50 text-white" onclick="deleteFornecedor(${setor.id_setor})">Deletar</button>
            </td>`;
        tableBody.appendChild(row);
    });
}
function searchSetores() {
    var searchValue = document.getElementById('searchInput').value.trim().toLowerCase();
    if (searchValue !== '') {
        var filteredSetores = setores.filter(function (setor) {
            return setor.id_setor.toString().indexOf(searchValue) !== -1 || setor.nome.toLowerCase().includes(searchValue) || setor.nome_chefe.toLowerCase().includes(searchValue);
        });
        displaySetores(filteredSetores);
    } else {
        displaySetores(setores);
    }
}
document.getElementById('searchInput').addEventListener('input', searchSetores);
fetchSetores();
var editModal = new bootstrap.Modal(document.getElementById('editModal'));
document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();
    var id = document.getElementById('editModalLabel').innerText.split(":")[1].trim();
    saveFornecedorChanges(id);
    editModal.hide();
});
function editSetor(id) {
    fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/setores/getSetor.php?id=${id}`, {
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
            document.getElementById("setor_nome").value = data.nome;
            document.getElementById("chefe_id").value = data.chefe_id;
            editModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    const modalLabel = document.getElementById('editModalLabel');
    modalLabel.innerText = `Editar setor: ${id}`;
}

function saveFornecedorChanges(id) {
    var nome = document.getElementById('setor_nome').value;
    var chefe_id = document.getElementById('chefe_id').value;
    var setorData = {
        nome: nome,
        chefe_id: chefe_id,
    };
    fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/setores/updateSetor.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(setorData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            fetchSetores();
        })
        .catch(error => {
            console.error('Erro ao salvar alterações do setor:', error);
            alert('Erro ao salvar alterações do setor: ' + error.message);
        });
}
function deleteFornecedor(id) {
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const modalLabel = document.getElementById('confirmDeleteModalLabel');
    modalLabel.innerText = `Excluir setor: ${id}?`;
    confirmDeleteModal.show();

    const confirmButton = document.getElementById('confirmDeleteButton');
    const newButton = confirmButton.cloneNode(true);
    confirmButton.parentNode.replaceChild(newButton, confirmButton);

    newButton.addEventListener('click', function () {
        fetch(`http://127.0.0.1/ButacaBox/ButacaBox/src/api/setores/deleteSetor.php?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    fetchSetores();
                }
            })
            .catch(error => {
                console.error('Erro ao excluir setor:', error);
                alert('Erro ao excluir setor: ' + error.message);
            });

        confirmDeleteModal.hide();
    });
}
function fetchChefia() {
    fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/funcionarios/getEmployee.php')
        .then(response => response.json())
        .then(data => {
            const selectChefia = document.getElementById('chefe_id');
            data.forEach(employee => {
                const option = document.createElement('option');
                option.value = employee.id_funcionario;
                option.textContent = employee.nome;
                selectChefia.appendChild(option)
            });
        })
        .catch(error => console.error(error))
}
fetchChefia();