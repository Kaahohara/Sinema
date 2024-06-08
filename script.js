/*
function clique() {

    if (document.getElementById('submenu').style.display == 'block') {
        document
            .getElementById('submenu')
            .style
            .display = 'none';
    } else {
        document
            .getElementById('submenu')
            .style
            .display = 'block';
    }
    window.onclick = function (event) {
        if (event.target == document.getElementById('submenu')) {
            document
                .getElementById('submenu')
                .style
                .display = "none";

        }
    }
}function modal(movieId) {
    var comentariosModal = document.getElementById('comentarios_modal_' + movieId).style.display = 'none';
    document.getElementById('coments' + movieId).style.display = 'block';
    document.getElementById('div_modal').style.display = 'block';
    document.getElementById(movieId).style.display = 'block';

    window.onclick = function(event) {
        if (event.target == document.getElementById('div_modal')) {
            document.getElementById('div_modal').style.display = "none";
            document.getElementById(movieId).style.display = 'none';
            document.getElementById('comentarios_modal').style.display = "none";
        }
    }

    // Fetching movie data asynchronously using Fetch API
    fetch("index.php?movieId=" + movieId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(movieData => {
            // Display the movie data
            displayMovieData(movieData);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function displayMovieData(movieData) {
    // Extract movie details from JSON response
    var title = movieData.title;
    var overview = movieData.overview;
    var posterPath = movieData.poster_path;
    var trailerKey = movieData.trailer_key;

    // Construct trailer URL
    var trailerUrl = "https://www.youtube.com/embed/" + trailerKey;

    // Construct HTML to display movie details
    var movieHtml = `
        <div class="invisivel">
            <div class="title">${title}</div>
            <div class="align">
                <div class="lado1">
                    <img src="https://image.tmdb.org/t/p/w500/${posterPath}">
                </div>
                <div class="lado">
                    <iframe style="width:100%; height:315px;" src="${trailerUrl}" frameborder="0" allowfullscreen></iframe>
                    <div class="text">${overview}</div>
                </div>
            </div>
            <br><br>
        </div>
    `;

    // Append movie HTML to modal
    document.getElementById(movieId).innerHTML = movieHtml;
}
*/ function modal(movieId) {
    var comentariosModal = document.getElementById('comentarios_modal_' + movieId).style.display = 'none';
    document.getElementById('coments' + movieId).style.display = 'block';
    document.getElementById('div_modal').style.display = 'block';
    document.getElementById(movieId).style.display = 'block';

    window.onclick = function(event) {
        if (event.target == document.getElementById('div_modal')) {
            document.getElementById('div_modal').style.display = "none";
            document.getElementById(movieId).style.display = 'none';
            document.getElementById('comentarios_modal').style.display = "none";
        }
    }

    // Fetching movie data asynchronously using Fetch API
    fetch("index.php?movieId=" + movieId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(movieData => {
            // Display the movie data
            displayMovieData(movieData);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function casts(cast_actors) {
    document
        .getElementById('div_casts')
        .style
        .display = 'block';
    document
        .getElementById(cast_actors)
        .style
        .display = 'block';

    window.onclick = function (event) {
        if (event.target == document.getElementById('div_casts')) {
            document
                .getElementById('div_casts')
                .style
                .display = "none";
            document
                .getElementById(cast_actors)
                .style
                .display = 'none';
        }
    }
}
function exibirComentarios(movieId) {
var apiKey = '66b674b987aded432d2ceb9f8d78dd18';
var url = 'https://api.themoviedb.org/3/movie/' + movieId + '/reviews?api_key=' + apiKey + '&language=pt-BR';

var comentariosModal = document.getElementById('comentarios_modal_' + movieId);
document.getElementById('coments' + movieId).style
        .display = 'none';

if (comentariosModal) {
comentariosModal.style.display = 'block';
comentariosModal.style.display = 'block';

fetch(url)
.then(response => response.json())
.then(data => {
    var comentarios = data.results;
    var comentariosHtml = '';

    if (comentarios.length > 0) {
        comentariosHtml += ' <br>  <br><h2>Comentários</h2>';
        for (var i = 0; i < comentarios.length; i++) {
            var comentario = comentarios[i];
                    comentariosHtml += ' <br>  <br> <div class="comentario" style="text-align: justify;">';
                    comentariosHtml += '	 <br>	<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""/></div><b><div class="descricao">' + comentario.author+'</b> ';
                    comentariosHtml +=  comentario.author_details.rating;
                    comentariosHtml += ' <br> ' + comentario.content ;
                    comentariosHtml += '</div></div></div> <br>  <br> ';
        }
    } else {
        comentariosHtml += '<p >Nenhum comentário disponível.</p>';
    }
    comentariosModal.innerHTML = comentariosHtml;
})
.catch(error => {
    console.error('Erro ao buscar comentários:', error);
});
} else {
console.error('comentarios_modal_' + movieId + ' not found.');
}
}
