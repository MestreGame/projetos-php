<?php
include("conectadb.php");
include('topo.php');
// include("header.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['txtlogin'];
    $email = $_POST['txtemail'];

    // COMEÇA VALIDAR BANCO DE DADOS
    $sql = "SELECT COUNT(usu_id) FROM tb_usuarios
    WHERE usu_login = '$login' AND usu_senha = '$senha' AND
    usu_status = '1'";
    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);

    $contagem = mysqli_fetch_array($retorno) [0];

    // VERIFICA SE NATAN EXISTE
    if($contagem == 1){
        $sql = "SELECT usu_id, usu_login FROM tb_usuarios
        WHERE usu_login = '$login'AND usu_senha = '$senha'";
        $retorno = mysqli_query($link, $sql);
        //RETORNANDO O NOME DO NATAN + ID DELE
        while($tbl = mysqli_fetch_array($retorno)){
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
        }
        echo"<script>window.location.href='backoffice.php';</script>";
    }
    else{
        echo"<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>CADASTRO DE USUARIO</title>
</head>
<body class="fundo" style="background-image: url(img/fundo.avif);">
<a href="backoffice.php"><img src='icons.old/arrowhead-left-01.png' width="16" height="16"></a>

    <div class="container-global">
        
        <form class="formulario" action="usuario-cadastro.php" method="post">

            <label>LOGIN</label>
            <input type="text" name="txtlogin" placeholder="Digite seu login" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" placeholder="Digite sua senha" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
         
            <br>
            <input type="submit" value="CRIAR">
        </form>

    </div>
    
</body>
</html>