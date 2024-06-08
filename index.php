<!DOCTYPE html>

<?php
 session_start();

 ?>

<head>
    <title>Sinema</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilo.css">
    <script src="script.js"></script>
    <body>

     

        <?php
        require_once 'vendor/autoload.php';

        use GuzzleHttp\Client;

        $apiKey = 'apikey';

        $client = new Client();
        
      
        $url = "https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=$apiKey&page=1";
        $response = $client->get($url);


    ?>

<div class='card-menu'>
            <a class='menu-inicio' href="filmes.php">Filmes</a>

            </div>
          
            <div class="fundo-embarcado">
    <div class="loading"></div>
</div>

        <br><br>
        <div class="carrosel">
            <ul>
        <?php
         
                if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody());
                    $total_registros = $data->total_results;

                    foreach ($data->results as $movie) {
                        $title = $movie->title;
                        $overview = $movie->overview;
                        $posterPath = $movie->poster_path;
                        $id=$movie->id;
                        if ($posterPath) {
                                echo '
                        
                      <li>
                        <div class="banner">
                            <img src=https://image.tmdb.org/t/p/w500'. $posterPath . ' >
                          
                        </div>
                    </li>
                    
                           
                    ';
                        } else {
                            echo "<p>Pôster não disponível</p>";
                        }
                        }
                        } else {
                            echo "Erro ao acessar a API da TMDb.";
                }
            
            ?>
           
            </ul>
            </div>

         
    </body>
<script>
            moviesGenger(35);
            moviesGenger(28);
            moviesGenger(16);
            moviesGenger(99);
            function getGenreName(genre_id) {
    var apiKey = 'apiKey';
    var genresUrl = `https://api.themoviedb.org/3/genre/movie/list?api_key=${apiKey}`;

    return fetch(genresUrl)
        .then(response => response.json())
        .then(genresData => {
            var genreMap = {};
            genresData.genres.forEach(genre => {
                genreMap[genre.id] = genre.name;
            });

            var genreName = genreMap[genre_id] || "Gênero Desconhecido";
            return genreName;
        })
        .catch(error => console.error('Erro ao obter os gêneros:', error));
}

async function moviesGenger(genger) {
    var apiKey = 'apiKey';
    var url = `https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=${apiKey}&page=1&with_genres=${genger}`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        var movies = data.results.slice(0, 10);

        var container = document.createElement('div');
        container.classList.add('container-movies');

      
        const genreName = await getGenreName(genger);

        var nameGenre = document.createElement('div');
        nameGenre.classList.add('name_genger');
        nameGenre.innerHTML = `<b>${genreName}</b>`;
        container.appendChild(nameGenre);

        var moviesDiv = document.createElement('div');
        moviesDiv.classList.add('movies');

        movies.forEach(movie => {
            var posterPath = movie.poster_path;
            var id = movie.id;

            if (posterPath) {
                var movieForm = document.createElement('form');
                movieForm.setAttribute('id', 'movie_form_' + id);
                movieForm.setAttribute('action', 'modal.php');
                movieForm.setAttribute('method', 'POST');
            
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'movie_id');
                hiddenInput.setAttribute('value', id);
            
                var movieButton = document.createElement('button');
                movieButton.setAttribute('type', 'submit');
                movieButton.setAttribute('id', 'movie_button_' + id);
                movieButton.style.border = 'none';
                movieForm.style.marginLeft = '10px';
                movieForm.style.marginRight = '10px';
                movieButton.style.background = 'none';
                movieButton.style.padding = '0';
                movieButton.style.cursor = 'pointer';
                movieButton.innerHTML = `<img loading="lazy" width="220px" height="250px" src="https://image.tmdb.org/t/p/w500${posterPath}" alt="Movie Poster">`; // Adicionando a imagem ao botão
            
                movieForm.appendChild(hiddenInput);
                movieForm.appendChild(movieButton);
            
                moviesDiv.appendChild(movieForm);
            }
            
        });

        container.appendChild(moviesDiv);

        document.body.appendChild(container);
    } catch (error) {
        console.error('Erro ao obter os filmes:', error);
    }
}

window.addEventListener("load", function() {
    document.querySelector('.fundo-embarcado').style.display = 'none';
    });
</script>
</html>
