var fornecedores = [];
function fetchFornecedores() {
    fetch('../../../api/fornecedores/getFornecedores.php')
        .then(response => response.json())
        .then(data => {
            fornecedores = data;
            displayFornecedores(fornecedores);
        })
    .catch(error => console.error(error));
}
function displayFornecedores(fornecedores) {
    var tableBody = document.getElementById('fornecedorTableBody');
    tableBody.innerHTML = '';
    fornecedores.forEach(function (fornecedor) {
        var row = document.createElement('tr');
        row.innerHTML =
            `<td>${fornecedor.id_fornecedor}</td>
            <td>${fornecedor.nome}</td>
            <td>${fornecedor.email}</td>
            <td>${fornecedor.telefone}</td>
            <td class="d-flex">
                <button style="background-color: #3ba6ff;" class="btn btn-sm w-50 text-white" id="editFornecedorButton" onclick="editFornecedor(${fornecedor.id_fornecedor})">Editar</button>
                <button style="background-color: #d9534f;" class="btn btn-sm w-50 text-white" onclick="deleteFornecedor(${fornecedor.id_fornecedor})">Deletar</button>
            </td>`;
        tableBody.appendChild(row);
    });
}
function searchFornecedores() {
    var searchValue = document.getElementById('searchInput').value.trim().toLowerCase();
    if (searchValue !== '') {
        var filteredFornecedores = fornecedores.filter(function (fornecedor) {
            return fornecedor.id_fornecedor.toString().indexOf(searchValue) !== -1 || fornecedor.nome.toLowerCase().includes(searchValue);
        });
        displayFornecedores(filteredFornecedores);
    } else {
        displayFornecedores(fornecedores);
    }
}
document.getElementById('searchInput').addEventListener('input', searchFornecedores);
fetchFornecedores();
var editModal = new bootstrap.Modal(document.getElementById('editFornecedorModal'));
document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();
    var id = document.getElementById('editFornecedorModalLabel').innerText.split(":")[1].trim();
    saveFornecedorChanges(id);
    editModal.hide();
});
function editFornecedor(id) {
    fetch(`../../../api/fornecedores/getFornecedores.php?id=${id}`, {
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
            document.getElementById("email").value = data.email;
            document.getElementById("telefone").value = data.telefone;
            editModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    const modalLabel = document.getElementById('editFornecedorModalLabel');
    modalLabel.innerText = `Editar fornecedor: ${id}`;
}
function saveFornecedorChanges(id) {
    var nome = document.getElementById('nome').value;
    var email = document.getElementById('email').value;
    var telefone = document.getElementById('telefone').value;
    var fornecedorData = {
        nome: nome,
        email: email,
        telefone: telefone,
    };
    fetch(`../../../api/fornecedores/updateFornecedores.php?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(fornecedorData)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro HTTP! status: ${response.status}`);
            }
            fetchFornecedores();
        })
        .catch(error => {
            console.error('Erro ao salvar alterações do fornecedor:', error);
            alert('Erro ao salvar alterações do fornecedor: ' + error.message);
        });
}
function deleteFornecedor(id) {
    var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const modalLabel = document.getElementById('confirmDeleteModalLabel');
    modalLabel.innerText = `Excluir fornecedor: ${id}?`;
    confirmDeleteModal.show();
    
    const confirmButton = document.getElementById('confirmDeleteButton');
    const newButton = confirmButton.cloneNode(true);
    confirmButton.parentNode.replaceChild(newButton, confirmButton);

    newButton.addEventListener('click', function () {
        fetch(`../../../api/fornecedores/deleteFornecedores.php?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    fetchFornecedores();
                }
            })
            .catch(error => {
                console.error('Erro ao excluir fornecedor:', error);
                alert('Erro ao excluir fornecedor: ' + error.message);
            });

        confirmDeleteModal.hide();
    });
}
