<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilo.css">
    <script src="script.js"></script>
</head>
<body>

<?php
    session_start();
    require_once 'vendor/autoload.php';

    use GuzzleHttp\Client;

    $apiKey = '66b674b987aded432d2ceb9f8d78dd18';

    $client = new Client();
    $registros_por_pagina = 5;
    $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    // Obtendo a lista de gêneros disponíveis
    $genresUrl = "https://api.themoviedb.org/3/genre/movie/list?api_key=$apiKey&language=pt-BR";
    $genresResponse = $client->get($genresUrl);
    $genresData = json_decode($genresResponse->getBody());
    $genres = $genresData->genres;

    $selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : null;

    // Modificando a URL da API para incluir o gênero selecionado
    $url = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=pt-BR&page=$pagina_atual";
    if ($selectedGenre) {
        $url .= "&with_genres=$selectedGenre";
    }

    $response = $client->get($url);

?>

<div class='card-menu'>
    <a style="margin-top:-1%; font-size:22px" class='menu-inicio' href="index.php">Home</a>
</div>
<br><br>

<div class="titulosSecao">
    <h3>Lançamentos 2023</h3>
 
</div>

<div class='container'>


    <?php
    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody());
        $total_registros = $data->total_results;

        foreach ($data->results as $movie) {
            $title = $movie->title;
            $overview = $movie->overview;
            $posterPath = $movie->poster_path;
            $id = $movie->id;
            if ($posterPath) {
                echo '
                    <div class="selecao">
                        <form id="movie_form_' . $id . '" action="modal.php" method="POST">
                            <input type="hidden" name="movie_id" value="' . $id . '">
                            <button type="submit" id="movie_button_' . $id . '" class="button-modal">
                                <img loading="lazy"  src="https://image.tmdb.org/t/p/w500' . $posterPath . '" alt="Movie Poster">
                                <br><p class="center">' . $title . '</p>
                            </button>
                        </form>
                    </div>
                ';
            } else {
                echo "<p>Pôster não disponível</p>";
            }
        }
    } else {
        echo "Erro ao acessar a API da TMDb.";
    }
    ?>

</div>

<?php
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    echo '<center><div class="pagination">';

    $max_links_paginacao = 5;
    $inicio = max(1, $pagina_atual - floor($max_links_paginacao / 2));
    $fim = min($total_paginas, $inicio + $max_links_paginacao - 1);

    if ($pagina_atual > 1) {
        echo '<a href="?pagina=' . ($pagina_atual - 1) . '&genre=' . $selectedGenre . '">&laquo; Anterior </a>';
    }

    for ($i = $inicio; $i <= $fim; $i++) {
        if ($i == $pagina_atual) {
            echo '<span class="active">'  . $i . '</span>';
        } else {
            echo '<a href="?pagina= '. $i .'  &genre=' . $selectedGenre . '">' . $i . '</a>';
        }
    }

    if ($pagina_atual < $total_paginas) {
        echo '<a href="?pagina= ' . ($pagina_atual + 1) . ' &genre=' . $selectedGenre . '"> Próximo &raquo;</a>';
    }

    echo '</div></center>';
?>
</body>
</html>
<script>
        function submitForm() {
            document.getElementById("genreForm").submit();
        }
    </script>