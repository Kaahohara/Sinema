<?php
session_start();
include_once('conexao.php');

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['Senha'];

    $verificaEmail = mysqli_query($con, 'SELECT Email FROM Usuarios WHERE Email = "'.$email.'"');

    if (mysqli_num_rows($verificaEmail) > 0) {
        echo '<center>Este email já está em uso.</center>';
    } else {
      
     
        $insere = mysqli_query($con, 'INSERT INTO Usuarios (Nome, Email, Senha) VALUES ("'.$nome.'", "'.$email.'", "'.$senha.'")');

        if ($insere) {
            $_SESSION['login'] = $email;
            header("Location: index.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastre-se</title>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method='POST'>
            <br> <br> <br>
            <div class='card card-login'>
          
            
            <h5>Cadastre-se</h5>
         
        <label>Nome:
            <input type='name' name='nome' required></label>
        <label>E-mail:<br>
            <input type='email' name='email'required></label>
        <label>Senha:<br>
            <input type='password' name='Senha'required></label>
        <button type='submit' class="insert-button" name='enviar' class='btn btn-secondary'> Cadastrar</button>
        
        <a style='text-decoration:none;color:#fff;'href='login.php'>Já Possui um login?</a>    
        
</body>
</html>