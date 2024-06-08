<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
   <body>
    <style>
         textarea, input[type="text"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      white-space: pre-line; /* Torna o texto sensível às quebras de linha */
    }
    .container {
  display: flex;
}

.lados {
  flex: 1;
}
    </style>
    <div class="container">
    <?php
      session_start();
        require_once 'vendor/autoload.php';
      
        use GuzzleHttp\Client;
        
            function gerarURLRastreamento($publisherId, $advertiserId, $destinationUrl) {
                // Substitua 'SUA_CHAVE_DE_API' pelo seu token de API da Awin
                $chaveApiAwin = 'b2e90bf6-9ac4-4f67-a718-1ef391ee5e6b';
                $urlBase = 'https://api.awin.com';

                // Endpoint para gerar uma URL de rastreamento
                $endpoint = '/publishers/' . $publisherId . '/linkbuilder/generate';
            
                // Inicializando a sessão cURL
                $ch = curl_init($urlBase . $endpoint);
            
                // Configurando as opções da solicitação cURL
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer ' . $chaveApiAwin,
                    'Content-Type: application/json',
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
            
                // Parâmetros da solicitação em formato JSON
                $parametros = array(
                    'advertiserId' => $advertiserId,
                    'destinationUrl' => $destinationUrl,
                );
            
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parametros));
            
                // Realizando a solicitação à API
                $resposta = curl_exec($ch);
            
                // Verificando se houve erros
                if (curl_errno($ch)) {
                    echo 'Erro ao fazer a solicitação à API: ' . curl_error($ch);
                    return null;
                }
            
                // Fechando a sessão cURL
                curl_close($ch);
            
                // Decodificando a resposta JSON
                $dadosResposta = json_decode($resposta, true);
            
                // Imprimindo informações para depuração
           
                // Verificando se a resposta contém a URL gerada
                if (isset($dadosResposta['url'])) {
                    return $dadosResposta['url'];
                } else {
                    echo 'Erro ao gerar a URL de rastreamento';
                    return null;
                }
            }
            
    

        function cuttly($url){
        
            $apiKey = 'a409ab4c2043820a7c4a852da5ff0f26fa5ec';
            
            // URL original que você deseja encurtar
            $originalUrl = $url;
            
            // Crie um cliente Guzzle
            $client = new Client();
            
            // URL do endpoint da API do Cutt.ly para encurtar
            $apiUrl = 'https://cutt.ly/api/api.php';
            
            // Parâmetros para a solicitação
            $params = [
                'key' => $apiKey,
                'short' => $originalUrl,
            ];
            
            // Envie a solicitação para a API do Cutt.ly
            $response = $client->get($apiUrl, ['query' => $params]);
            
            // Obtenha a resposta da API
            $responseData = json_decode($response->getBody(), true);
            
            // Faça algo com a resposta, como imprimir a URL encurtada
            if ($responseData['url']['status'] == 7) 
            return $Url=$responseData['url']['shortLink'];
          }
      

          function marcas($marca){
           
                if($marca=='1')
               return 17658;
                if($marca=='2')
               return 32675;
            
                if($marca=='3')
               return  17806;
            
                if($marca=='4')
               return 17659;
    
                if($marca=='5')
                return  17870;
                
            }
            function valuemarcas($marca){
                if($marca=='1')
                return 'Natura 🌿';
                if($marca=='2')
                return 'Puma 👟';
                if($marca=='3')
                return 'Centauro 🏃‍♂️';
                if($marca=='4')
                return 'O Boticário 💄';
                if($marca=='5')
                return 'Cobasi 🐶';
                if($marca=='6')
                return 'Amazon 🛒';
                if($marca=='7')
                return 'Magazine Luiza 📦';
                if($marca=='8')
                return 'Mercado Livre 🛍️';
            }
        
    if(isset($_POST['nome'])){
    
  
        if($_POST['marca']==6){
             $_POST['url']=  $_POST['url'].'?whats';
            
         }

        $nome=$_POST['nome'];
        echo '<div class="lados">'. nl2br($nome).'<br><br> '; 
        if(isset($_POST['preco'])&&$_POST['preco']!=NULL)
        echo'            <br>🔥 Por:  R$ '.nl2br($_POST['preco']).'<br>
         ';
         if(isset($_POST['preco2'])&&$_POST['preco2']!=NULL)
         echo'            <br>🔥 Por:  R$ '.nl2br($_POST['preco2']).'<br>
          ';
         if($_POST['url']!=NULL){
            if(isset($_POST['marca'])&&$_POST['marca']!='6'&&$_POST['marca']!='7'&&$_POST['marca']!='8'){
               $marca=$_POST['marca'];
               $advertiserId= marcas($marca);     
               $publisherId = 1483594;
       
               $destinationUrl = $_POST['url'];
               $urlRastreamento = gerarURLRastreamento(1483594, $advertiserId, $destinationUrl);
               $url_cuttly=cuttly($urlRastreamento);
               }else{
             
           $url_cuttly=cuttly($_POST['url']);
              }
               echo'
               🛒 Compre aqui 👉 '.$url_cuttly;
           }
           if($_POST['url2']!=NULL){
            if(isset($_POST['marca'])&&$_POST['marca']!='6'&&$_POST['marca']!='7'&&$_POST['marca']!='8'){
               $marca=$_POST['marca'];
               $advertiserId= marcas($marca);     
               $publisherId = 1483594;
               $destinationUrl = $_POST['url2'];
               $urlRastreamento = gerarURLRastreamento(1483594, $advertiserId, $destinationUrl);
               $url_cuttly2=cuttly($urlRastreamento);
               }else{
             
             $url_cuttly2=cuttly($_POST['url2']);
              }
               echo'
               <br><br>'.$_POST['antes'].' '.$url_cuttly;
           }
            if(isset($_POST['Especial'])&&$_POST['Especial']!=NULL)
            echo '<br><br>'.nl2br($_POST['Especial']);
           if($_POST['marca']==6){
            echo'<br><br>✅ Assine AMAZON PRIME Grátis com Filmes, Series e tenha FRETE GRÁTIS 👉 https://cutt.ly/1w9fIQjF
';

           }
            echo'
            <br><br>Vendido por ';
            echo valuemarcas($_POST['marca']);
            $session['placeholder']=valuemarcas($_POST['marca']);

    echo'
        <br> 
        <br> Oferta por tempo limitado
        <br> O Link dessa oferta não ficou azul? 
        <br> Me adicione em seus contatos que resolve.<br><br></div>';
        }
        
      
    ?>
    </div>
   <form action="gerador.php" method="post">
   <label  for="inputText">Nome produto:</label>
  <textarea id="nome" name="nome" ></textarea>
  <br><br>
  <label  for="inputText">Preço:</label>
  <textarea type="text" id="preco" name="preco" ></textarea>
  <br>
  <label  for="inputText">Preço2:</label>
  <textarea type="text" id="preco2" name="preco2" ></textarea>
  <br><br>
  <label  for="inputText">url:</label>
  <textarea type="text" id="url" name="url" ></textarea>
 <br>
 <label  for="inputText">Antes:</label>
  <textarea type="text" id="antes" name="antes" ></textarea>
 <br>
 <label  for="inputText">url2:</label>
  <textarea type="text" id="url2" name="url2" ></textarea>
 <br>
  <label  for="inputText">Especial:</label>
  <textarea id="Especial" name="Especial" ></textarea>
<br><br>
<label for="marca">Selecione uma opção:</label>
  <select id="marca" name="marca" required>
    <option value="<?php echo $session['placeholder'];?> "><?php echo $session['placeholder']?></option>
    <option value='7'>Magazine Luiza 📦</option>
    <option value="8">Mercado Livre 🛍️</option>
    <option value="1">Natura 🌿</option>
    <option value="2">Puma 👟</option>
    <option value="3">Centauro 🏃‍♂️</option>
    <option value="4">O Boticário 💄</option>
    <option value="5">Cobasi 🐶</option>
    <option value="6">Amazon 🛒</option>

</select>
  <br><br>
  <button type="submit">Gerar Texto</button>
</form>
    
</body>
</html>