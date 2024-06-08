<?php

session_start();
include_once('conexao.php');

?>
<!DOCTYPE html>
    <head>
    <title>Logar</title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

</head>
<body>
     <form method='POST'>
        <br> <br> <br>
        <div class='card card-login'>
       <?php
      

       
       if(isset($_POST['logar'])){
        
        $login = mysqli_query($con, 'SELECT * FROM usuarios WHERE Email="' . $_POST['email'] .
         '"AND Senha="'.$_POST['Senha'].'"');
         if (empty(mysqli_num_rows($login))) {
            echo '<center>Algo deu errado</center>';
        } else {
            header("Location: index.php");
               $_SESSION['login'] = $_POST['email'];
        }
      }
      ?>
        
        <br><h5>Faça login</h5>
       
        <label>E-mail:
        <input type='email' name='email'required></label>
       
        <label>Senha:
        <input type='password' name='Senha'required></label>
        
        <button type='submit' class="insert-button" name='logar' class='btn btn-secondary'>Login</button>


       <br> <a style='text-decoration:none;color:#fff;'href='cadastro.php'>Não possui uma conta?</a>  
          
    </div>