document.addEventListener('DOMContentLoaded', function () {

    let numberOfSelectedSeats = 0;
    let selectedSeatIds = [];
    let currentSessionData;

    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('id');
    function resetSelection() {
        numberOfSelectedSeats = 0;
        document.querySelector('.preco_total').innerText = 'R$0';
        document.querySelector('.quantidade_ingresso').innerText = '0x';
    }

    $('#buyTicketModalCenter').on('hidden.bs.modal', function () {
        resetSelection();
    });

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
        const titulo = document.querySelector('h5.card-title')
        fetch(`http://127.0.0.1/ButacaBox/Butacabox/src/api/filmes/getMovieSession.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    titulo.innerText = 'Ainda não temos sessões para este filme :(';
                    titulo.classList.add('text-center')
                }
                else {
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
            `
        <thead>
            <tr>
                <th class="h4 fw-bold" colspan="7">${filial}</th>
            </tr>
            <tr>
                <th>Dia</th>
                <th>Horário de inicio</th>
                <th>Sala</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
        `;
        const tbody = table.querySelector('tbody');
        sessions.forEach(session => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${formatDate(session.data_sessao)}</td>
            <td>${formatHour(session.hora_sessao)}</td>
            <td>${session.nome_sala}</td>
            <td class="text-center"><button class="btn w-100" data-toggle="modal" data-target="#buyTicketModalCenter">Compre aqui</button></td>
        `;
            row.querySelector('button').addEventListener('click', () => buyTicket(session));
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
        console.error('Movie ID not provided.');
    }

    function buyTicket(sessionData) {
        currentSessionData = sessionData;
        const formatedHour = formatHour(sessionData.hora_sessao);
        const formatedDate = formatDate(sessionData.data_sessao);
        document.querySelector('.movie-title').innerText = sessionData.nome_filme;
        document.querySelector('.movie-filial').innerText = sessionData.nome_filial;
        document.querySelector('.movie-date').innerText = `${formatedDate} - `;
        document.querySelector('.movie-hora').innerText = `${formatedHour} - `;
        document.querySelector('.movie-sala').innerText = `${sessionData.nome_sala}`;
        document.querySelector('.preco_ingresso').innerText = `R$${sessionData.preco_ingresso}`;
        const seatContainer = document.querySelector('.seat-container');
        seatContainer.innerHTML = '';
    
        const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    
        sessionData.assentos_disponiveis.forEach(seat => {
            const seatButton = document.createElement('button');
            seatButton.classList.add('btn', 'btn-seat', 'btn-outline-secondary');
            seatButton.id = `seat-${seat.id}-${sessionData.id}`;
            const numeracaoParts = seat.numeracao.split(' ');
            const seatNumber = parseInt(numeracaoParts[1]);
            const rowLetter = rows[seatNumber - 1 >= 0 ? Math.floor((seatNumber - 1) / 10) : 0];
            const resetSeatNumber = seatNumber % 10 === 0 ? 10 : seatNumber % 10;
            seatButton.innerText = rowLetter + resetSeatNumber;
            if (seat.disponibilidade !== 1) {
                seatButton.disabled = true;
            }
            toggleButtonClass(seatButton);
            seatContainer.appendChild(seatButton);
        });
    
        let numberOfSelectedSeats = 0;
        let selectedSeatIds = [];
    
        function toggleButtonClass(button) {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                if (button.classList.contains('btn-outline-secondary')) {
                    button.classList.remove('btn-outline-secondary');
                    button.classList.add('btn-secondary');
                    numberOfSelectedSeats++;
                    const id_assento = button.id.split('-')[1];
                    selectedSeatIds.push(id_assento);
                } else {
                    button.classList.remove('btn-secondary');
                    button.classList.add('btn-outline-secondary');
                    numberOfSelectedSeats--;
                    const id_assento = button.id.split('-')[1];
                    selectedSeatIds = selectedSeatIds.filter(id => id !== id_assento);
                }
                const precoIngresso = parseFloat(document.querySelector('.preco_ingresso').innerText.replace('R$', ''));
                const precoTotal = precoIngresso * numberOfSelectedSeats;
                document.querySelector('.preco_total').innerText = `R$${precoTotal}`;
                document.querySelector('.quantidade_ingresso').innerText = `${numberOfSelectedSeats}x`;
            });
        }
    
        const seatButtons = document.querySelectorAll('.btn-seat');
        seatButtons.forEach((button) => {
            toggleButtonClass(button);
        });
    
        const confirmarPagamentoButton = document.getElementById('confirmar-compra');
        confirmarPagamentoButton.addEventListener('click', function () {
            if (numberOfSelectedSeats > 0) {
                console.log(`Compra confirmada! Você selecionou os assentos com os IDs: ${selectedSeatIds.join(', ')}`);
                // Aqui você pode adicionar o código para processar a compra
            } else {
                console.log('Por favor, selecione pelo menos um assento antes de confirmar a compra.');
            }
        });
    }
    

});