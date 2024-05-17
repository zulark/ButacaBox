document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('id');
    const userIdToken = id_usuario;

    function fetchMovieData() {
        fetch(`http://127.0.0.1/ButacaBox/Butacabox/src/api/filmes/getMovies.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('cartaz_filme').src = data.cartaz_filme;
                document.getElementById('titulo').innerText = data.titulo;
                document.getElementById('diretor').innerText = `Direção: ${data.diretor}`;
                document.getElementById('genero').innerText = data.genero;
                document.getElementById('duracao').innerText = `Duração: ${data.duracao} minutos`;
                document.getElementById('descricao').innerText = data.descricao;
                document.querySelector('.youtube-video').innerHTML = `<iframe width="560" height="315" src="${data.youtube_url}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>`;
            })
            .catch(error => console.error('Error:', error));
    }
    function fetchMovieSession(movieId) {
        const sessionContainer = document.querySelector('.card-body.text-bg-dark');
        const titulo = document.querySelector('h5.card-title');
        fetch(`http://127.0.0.1/ButacaBox/Butacabox/src/api/filmes/getMovieSession.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    titulo.innerText = 'Ainda não temos sessões para este filme :(';
                    titulo.classList.add('text-center');
                } else {
                    const groupedSessions = groupSessionsByFilial(data);
                    for (const filial in groupedSessions) {
                        const sessions = groupedSessions[filial];
                        const table = createSessionTable(filial, sessions);
                        sessionContainer.appendChild(table);
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    }
    function groupSessionsByFilial(sessions) {
        const groupedSessions = {};
        sessions.forEach(session => {
            if (!groupedSessions[session.nome_filial]) {
                groupedSessions[session.nome_filial] = [];
            }
            groupedSessions[session.nome_filial].push(session);
        });
        return groupedSessions;
    }
    function createSessionTable(filial, sessions) {
        const table = document.createElement('table');
        table.classList.add('session-table');
        table.innerHTML =
            `<thead>
                <tr>
                    <th class="h4 fw-bold" colspan="7">${filial}</th>
                </tr>
                <tr>
                    <th class="text-center">Dia</th>
                    <th class="text-center">Horário de inicio</th>
                    <th class="text-center">Sala</th>
                    <th class="text-center">Assentos disponíveis</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody></tbody>`;
        const tbody = table.querySelector('tbody');
        sessions.forEach(session => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${formatDate(session.data_sessao)}</td>
                <td class="text-center">${formatHour(session.hora_sessao)}</td>
                <td class="text-center">${session.nome_sala}</td>
                <td class="text-center">${session.assentos_disponiveis}</td>
                <td class="text-center"><button class="btn w-100" ${userIdToken ? 'data-toggle="modal" data-target="#buyTicketModalCenter"' : ''}>Compre aqui</button></td>`;
            const button = row.querySelector('button');
            if (!userIdToken) {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    alert('Por favor, logue sua conta antes de comprar.');
                });
            } else {
                button.addEventListener('click', () => buyTicket(session));
            }
            tbody.appendChild(row);
        });
        return table;
    }
    function formatDate(dateString) {
        const date = new Date(dateString);
        return `${("0" + date.getDate()).slice(-2)}/${("0" + (date.getMonth() + 1)).slice(-2)}`;
    }
    function formatHour(hourString) {
        return hourString.slice(0, 5);
    }
    if (movieId) {
        fetchMovieData();
        fetchMovieSession(movieId);
    } else {
        console.error('ID do filme não inserida.');
    }
    function buyTicket(sessionData) {
        let numberOfTickets = 1;
        const formatedHour = formatHour(sessionData.hora_sessao);
        const formatedDate = formatDate(sessionData.data_sessao);
        const confirmarPagamentoButton = document.getElementById('confirmar-compra');
        document.querySelector('.movie-title').innerText = sessionData.nome_filme;
        document.querySelector('.movie-filial').innerText = sessionData.nome_filial;
        document.querySelector('.movie-date').innerText = `${formatedDate} - `;
        document.querySelector('.movie-hora').innerText = `${formatedHour} - `;
        document.querySelector('.movie-sala').innerText = `${sessionData.nome_sala}`;
        document.querySelector('.preco_ingresso').innerText = `R$${sessionData.preco_ingresso}`;
        document.getElementById('ticket-quantity').value = numberOfTickets;
        document.querySelector('.quantidade_ingresso').innerText = `${numberOfTickets}x`;
        document.querySelector('.preco_total').innerText = `R$${(numberOfTickets * parseFloat(sessionData.preco_ingresso)).toFixed(2)}`;

        confirmarPagamentoButton.addEventListener('click', function () {
            if (numberOfTickets > 0) {
                const dadosDaVenda = {
                    id_usuario: userIdToken,
                    id_sessao: sessionData.id_sessao,
                    qntd_ingressos: numberOfTickets,
                    valor_venda: parseFloat(document.querySelector('.preco_total').innerText.substring(2)),
                    filial_id: sessionData.id_filial
                };
                console.log(dadosDaVenda);
                fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/venda/vendaIngresso.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(dadosDaVenda)
                })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status >= 200 && status < 300) {
                            if (body.success) {
                                alert('Compra realizada com sucesso');
                                location.reload(true);
                            } else {
                                alert(`Erro ao confirmar a compra: ${body.error}`);
                            }
                        } else {
                            alert(`Erro ao confirmar a compra: ${body.error}`);
                        }
                    })
                    .catch(error => {
                        alert('Erro ao confirmar a compra:', error);
                    });
            } else {
                alert('Por favor, selecione pelo menos um assento antes de confirmar a compra.');
            }
        });

        function updateTotalPrice() {
            const totalPrice = numberOfTickets * parseFloat(sessionData.preco_ingresso);
            document.querySelector('.quantidade_ingresso').innerText = `${numberOfTickets}x`;
            document.querySelector('.preco_total').innerText = `R$${totalPrice.toFixed(2)}`;
        }
        document.getElementById('decrease-btn').addEventListener('click', () => {
            if (numberOfTickets > 1) {
                numberOfTickets--;
                document.getElementById('ticket-quantity').value = numberOfTickets;
                updateTotalPrice();
            }
        });
        document.getElementById('increase-btn').addEventListener('click', () => {
            numberOfTickets++;
            document.getElementById('ticket-quantity').value = numberOfTickets;
            updateTotalPrice();
        });
    }
});
