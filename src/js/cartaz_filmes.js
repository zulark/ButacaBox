function fetchMovieData() {
    fetch('../api/filmes/getMovies.php')
        .then(response => response.json())
        .then(data => {
            const filmes_estreia = document.querySelectorAll('.filmes_estreia');
            const filmes_cartaz = document.querySelectorAll('.filmes_cartaz');
            const filmes_em_breve = document.querySelectorAll('.filmes_em_breve');
            let indexEstreia = 0;
            let indexCartaz = 0;
            let indexEmBreve = 0;

            data.forEach(movie => {
                const posterURL = movie.cartaz_filme;
                const id = movie.id_filme;
                const movieURL = `../pages/ingresso/detalhes-filme.html?id=${id}`;


                switch (movie.status_filme) {
                    case 'estreia':
                        if (indexEstreia < filmes_estreia.length) {
                            filmes_estreia[indexEstreia].src = posterURL;
                            filmes_estreia[indexEstreia].parentNode.href = movieURL;
                            indexEstreia++;
                        }
                        break;
                    case 'cartaz':
                        if (indexCartaz < filmes_cartaz.length) {
                            filmes_cartaz[indexCartaz].src = posterURL;
                            filmes_cartaz[indexCartaz].parentNode.href = movieURL;
                            indexCartaz++;
                        }
                        break;
                    case 'em_breve':
                        if (indexEmBreve < filmes_em_breve.length) {
                            filmes_em_breve[indexEmBreve].src = posterURL;
                            filmes_em_breve[indexEmBreve].parentNode.href = movieURL;
                            indexEmBreve++;
                        }
                        break;
                    default:
                        break;
                }
            });
            hideLoadingIndicator();
        })
        .catch(error => {
            displayLoadingIndicator();
            console.error('Error:', error);
        });
}

function toggleLoadingIndicator(show) {
    const loadingElements = document.querySelectorAll('.spinner-border');
    loadingElements.forEach(element => {
        element.parentElement.style.display = show ? 'block' : 'none';
    });
}



function displayLoadingIndicator() {
    const loading = document.createElement('div');
    loading.classList.add("d-flex");
    loading.classList.add("justify-content-center");
    loading.innerHTML =
        `<div class="spinner-border text-light" role="status"></div>`;
    const colElements = document.querySelectorAll('.col');
    colElements.forEach(col => {
        col.appendChild(loading.cloneNode(true));
    });
}

function hideLoadingIndicator() {
    const loadingElements = document.querySelectorAll('.spinner-border');
    loadingElements.forEach(element => {
        element.parentElement.remove();
    });
}

fetchMovieData();
