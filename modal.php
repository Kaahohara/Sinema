<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <script src="script.js"></script>
    <body style="  background-color: rgba(98, 89, 89, 0.7);
  backdrop-filter: blur(5px);
 ">


                  <?php
                 require_once 'vendor/autoload.php';

                 use GuzzleHttp\Client;
                if(isset($_POST['movie_id'])){
                    $movieId = $_POST['movie_id'];

             
   

                    $apiKey = 'apykey';

        $client = new Client();



$url = "https://api.themoviedb.org/3/movie/{$movieId}/images?api_key={$apiKey}";

$client = new GuzzleHttp\Client();

// Enviar solicitação à API
$response = $client->get($url);

// Verificar se a solicitação foi bem-sucedida (código de status 200)
if ($response->getStatusCode() == 200) {
    // Decodificar a resposta JSON em um array associativo
    $data = json_decode($response->getBody(), true);
    
    // Extrair a URL da imagem de fundo (se houver)
    $backdrops = $data['backdrops'];
    if (!empty($backdrops)) {
        // Obter a URL da primeira imagem de fundo
        $backgroundUrl = 'https://image.tmdb.org/t/p/original' . $backdrops[0]['file_path'];
        
        // Agora você pode usar $backgroundUrl para carregar a imagem de fundo em sua página
        echo '<img src="' . $backgroundUrl . '" style="width:100%; heigth:200%"  class="blur" alt="Background Image">';
    } else {
        echo 'Nenhuma imagem de fundo encontrada para este filme.';
    }
} else {
    echo 'Falha ao acessar a API do TMDb.';
}








      
        $url = "https://api.themoviedb.org/3/movie/{$movieId}?api_key={$apiKey}";
        $response = $client->get($url);

        if ($response->getStatusCode() == 200) {
            $movie = json_decode($response->getBody());
        
            $title = $movie->title;
            $overview = $movie->overview;
            $posterPath = $movie->poster_path;
            $id = $movie->id;
            if (property_exists($movie, 'genres')) {
                $genres = $movie->genres;
                $firstGenre = isset($genres[0]->name) ? $genres[0]->name : 'N/A';
            } else {
                $firstGenre = 'N/A';
            }

$client = new GuzzleHttp\Client();
$response = $client->get("https://api.themoviedb.org/3/movie/{$id}/videos", [
    'query' => [
        'api_key' => 'apykey',
    ],
]);

$data = json_decode($response->getBody());

if (isset($data->results) && !empty($data->results)) {
     $trailer_key = $data->results[0]->key;
$youtubeApiKey = 'apikey';
$videoKey =  $trailer_key;

$apiEndpoint = "https://www.googleapis.com/youtube/v3/videos";
$apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$trailer_key}&key={$youtubeApiKey}&part=snippet";

$client = new GuzzleHttp\Client();

try {

    $response = $client->get($apiUrl);
    
    $data = json_decode($response->getBody());

} catch (Exception $e) {
    echo 'Error making API request: ' . $e->getMessage();
}



 $trailer_url = "https://www.youtube.com/embed/{$trailer_key}";

}
}                 echo '
<div style="margin-top:5%" class="modal_conteudo">
<div class="title">
'.$title.'
</div>
                                 <div  id="'. $id .'">  
                                  
                                    <div class="align">
                                        <div class="lado1">    
                                            <img style src= https://image.tmdb.org/t/p/w500' . $posterPath . '>
                                        </div>
                                        ';
                                        if (isset($trailer_url)) {
                                            echo'
                                            <div class="lado">
                                                  
                                       <iframe style="width:100%; height:350px"  src="' . $trailer_url . '" frameborder="0" allowfullscreen></iframe>
                                       <div class="text">
                                       ' . $overview . '
                                       </div> </div>
                                       ';
                                }else {
                                    echo'
                                       
                                    <div class="lado">
                                     <div style="width:100%; height:100% max-width:50%">
                               ' . $overview . '
                               </div>  </div>
                               ';
                        }
                                echo'
                                    </div>
                                    </div>
                                <br><br>
                                </div>
                                
                                                       ';
                                             
}
                                    
                                   $castUrl = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$apiKey";
                                   $castResponse = $client->get($castUrl);

                                   echo '
                                   <div class="cast">';
                                   if ($castResponse->getStatusCode() == 200) {
                                       $castData = json_decode($castResponse->getBody());
                                   
                                       if (isset($castData->cast)) {
                                           $cast = $castData->cast;
                                   
                                        
                                           $imageCount = 0;
                                   
                                           foreach ($cast as $actor) {
                                               $actorName = $actor->name;
                                               $characterName = $actor->character;
                                               $profilePath = $actor->profile_path;
                                               $actorImageUrl = "https://image.tmdb.org/t/p/w185$profilePath";
                                          
                                              
                                               if ($imageCount >= 7) {
                                                   break;
                                               }
                                   
                                               echo '
                                               <div class="actors">
                                                   <img src="' . $actorImageUrl . '" alt="' . $actorName . '" loading="lazy">
                                                   <div class="names">' . $actorName . ' como ' . $characterName . '</div>
                                                   
                                               </div>
                                             ';
                                   
                                              
                                               $imageCount++;
                                           }
                                       } else {
                                           echo 'Nenhuma informação de elenco disponível para este filme.';
                                       }
                                   } else {
                                       echo 'Erro ao buscar informações de elenco.';
                                   }
                                   echo '
                                   </div>
                                   <br>
                                   <div class="center">
                                       <button 
                                           type="button" id="coments' . $id . '" class="about coments" 
                                           onclick="exibirComentarios(' . $id . ')">
                                           Veja os comentários
                                       </button>
                                       <div class="comentsResponse" id="comentarios_modal_' . $id . '">
                                       </div>
                                           <br><br>
                                       

                                   ';
                                   
                               
                           
                        
                                   ?>

<script>


        moviesGenger(35);
 

async function moviesGenger(genger) {
    var apiKey = 'apikey';
    var url = `https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=${apiKey}&page=1&with_genres=${genger}`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        var movies = data.results.slice(0, 10);

        var container = document.createElement('div');
        container.classList.add('container-movies');

        

    

        var moviesDiv = document.createElement('div');
        moviesDiv.classList.add('movies');

        movies.forEach(movie => {
            var posterPath = movie.poster_path;
            var id = movie.id;

            if (posterPath) {
                var movieForm = document.createElement('form');
                movieForm.setAttribute('id', 'movie_form_' + id);
                movieForm.setAttribute('action', 'modal.php'); // Definindo a ação do formulário para modal.php
                movieForm.setAttribute('method', 'POST'); // Definindo o método como POST
            
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'movie_id'); // Definindo o nome do campo
                hiddenInput.setAttribute('value', id); // Definindo o valor do campo como o ID do filme
            
                var movieButton = document.createElement('button'); // Criando o botão
                movieButton.setAttribute('type', 'submit'); // Definindo o tipo de botão como 'submit'
                movieButton.setAttribute('id', 'movie_button_' + id); // Definindo um ID para o botão
                movieButton.style.border = 'none'; 
                movieForm.style.marginLeft = '20px'; // Margem esquerda
          
                movieForm.style.marginTop = '20px'; 
                movieButton.style.background = 'none'; // Removendo o fundo para que pareça uma imagem
                movieButton.style.padding = '10px'; // Removendo o preenchimento para que pareça uma imagem
                movieButton.style.cursor = 'pointer'; // Mudando o cursor para indicar que é clicável
                movieButton.innerHTML = `<img loading="lazy" width="220px" height="250px" src="https://image.tmdb.org/t/p/w500${posterPath}" alt="Movie Poster">`; // Adicionando a imagem ao botão
            
                movieForm.appendChild(hiddenInput);
                movieForm.appendChild(movieButton);
            
                moviesDiv.appendChild(movieForm);
                container.style.marginBottom = '50px'; // Ajuste a quantidade de margem conforme necessário
          
            }
            
        });

        container.appendChild(moviesDiv);

        document.body.appendChild(container);
    } catch (error) {
        console.error('Erro ao obter os filmes:', error);
    }
}
        
</script>
</div>
<br><br>
