function fetchMovieData() {
    fetch('../api/filmes/getMovies.php')
        .then(response => response.json())
        .then(data => {
            const filmes_estreia = document.querySelectorAll('.filmes_estreia');
            const filmes_cartaz = document.querySelectorAll('.filmes_cartaz');
            const filmes_em_breve = document.querySelectorAll('.filmes_em_breve');
            data.forEach((movie, index) => {
                const posterURL = movie.cartaz_filme;
                if (index < 3 && index < filmes_estreia.length) {
                    filmes_estreia[index].src = posterURL;
                } else if (index < 9 && (index - 3) < filmes_cartaz.length) {
                    filmes_cartaz[index - 3].src = posterURL;
                } else if ((index - 9) < filmes_em_breve.length) {
                    const em_breve_index = index - 9;
                    filmes_em_breve[em_breve_index].src = posterURL;
                }
            });
            hideLoadingIndicator();
        })
        .catch(error => {
            displayLoadingIndicator();  
            displayErrorMessage();
            console.error('Error:', error);
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

function displayErrorMessage() {
    alert("Oops! Something went wrong. Please try again later.");
}

fetchMovieData();