<?php
include('conectadb.php');

//COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql =" SELECT  * FROM tb_usuarios WHERE use_id = $id";
$retorno = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($retorno)){
    $login = $tbl[0];
    $email = $tbl[1];
    $senha = $tbl[2];
    $status = $tbl[3];
    
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>ALETERÇÃO DE USUSARIO</title>
</head>
<body>
    <div class="container-global">
    <form class="formulario" action="login.php" method="post">
    <label>LOGIN</label>
    <input type="hidden" name="id" value="<?= $id?>">
    <input type="text" name="txtlogin"value="<?=$login?> "placeholder="Digite seu login" required>
    <br>
    <label>SENHA</label>
    <input type="password" name="txtsenha" value="<?=$senha?> "placeholder="Digite sua senha" required>
    <br>
    <label>EMAIL</label>
    <input type="email" name="txtlogin" value="<?=$email?> "placeholder="Digite seu email" required>
    <br>
    <br>
    <input type="submit" value="ACESSAR">
    </form>

    </div>
    
</body>
</html>