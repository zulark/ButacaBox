function fetchMovieData() {
    fetch('http://127.0.0.1/ButacaBox/ButacaBox/src/api/filmes/getMovies.php')
        .then(response => response.json())
        .then(data => {
            const estreiasRow = document.getElementById('estreias-row');
            const emCartazRow = document.getElementById('em_cartaz-row');
            const emBreveRow = document.getElementById('em_breve-row');

            data.forEach(movie => {
                const posterURL = movie.cartaz_filme;
                const id = movie.id_filme;
                const movieURL = `http://127.0.0.1/ButacaBox/ButacaBox/src/pages/ingresso/detalhes-filme.php?id=${id}`;

                let movieDiv = `
                    <div class="col mb-5">
                        <div class="movie-image d-flex justify-content-center align-items-center">
                            <a href="${movieURL}" class="movie-link">
                                <img class="img-fluid" src="${posterURL}" alt="">
                            </a>
                        </div>
                    </div>
                `;
                switch (movie.status_filme) {
                    case 'estreia':
                        estreiasRow.insertAdjacentHTML('beforeend', movieDiv);
                        break;
                    case 'cartaz':
                        emCartazRow.insertAdjacentHTML('beforeend', movieDiv);
                        break;
                    case 'em_breve':
                        emBreveRow.insertAdjacentHTML('beforeend', movieDiv);
                        break;
                    case 'desativado':
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
    loading.innerHTML =`
        <div class="spinner-border text-light" role="status"></div>`;
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