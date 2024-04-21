const urlParams = new URLSearchParams(window.location.search);
const movieId = urlParams.get('id');

function fetchMovieData() {
    fetch(`../../api/filmes/getMovies.php?id=${movieId}`)
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
    const titulo = document.querySelector   ('h5.card-title')
    fetch(`../../api/filmes/getMovieSession.php?id=${movieId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
               titulo.innerText = 'Ainda não temos sessões para este filme :(';
               titulo.classList.add('text-center')
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

    table.innerHTML = `
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
            <td>${formatDate(session.data)}</td>
            <td>${formatHour(session.hora)}</td>
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

let numberOfSelectedSeats = 0;

function buyTicket(sessionData) {
    const formatedHour = formatHour(sessionData.hora);
    const formatedDate = formatDate(sessionData.data)
    document.querySelector('.movie-title').innerText = sessionData.nome_filme
    document.querySelector('.movie-filial').innerText = sessionData.nome_filial
    document.querySelector('.movie-date').innerText = `${formatedDate} - `
    document.querySelector('.movie-hora').innerText = `${formatedHour} - `
    document.querySelector('.movie-sala').innerText = `${sessionData.nome_sala}`
    document.querySelector('.preco_ingresso').innerText = `RS${sessionData.preco_ingresso}`
    document.querySelector('.quantidade_ingresso').innerText = `${numberOfSelectedSeats}x`;

}

function toggleButtonClass(button) {
    button.addEventListener('click', () => {
        if (button.classList.contains('btn-outline-secondary')) {
            button.classList.remove('btn-outline-secondary');
            button.classList.add('btn-secondary');
            numberOfSelectedSeats++
        } else {
            button.classList.remove('btn-secondary');
            button.classList.add('btn-outline-secondary');
            numberOfSelectedSeats--;
        }
        document.querySelector('.quantidade_ingresso').innerText = `${numberOfSelectedSeats}x`;
    });
}

const seatButtons = document.querySelectorAll('.btn-seat');

seatButtons.forEach((button) => {
    toggleButtonClass(button);
});

function formatExpirationDate(event) {
    const input = event.target;
    const value = input.value.replace(/\D/g, '').substring(0, 6);
    let month = value.substring(0, 2);
    const year = value.substring(0, 2);

    if (value.length > 2) {
        input.value = `${month.toString().padStart(2, '0')}/${year}`;
    } else {
        input.value = month;
    }
}
