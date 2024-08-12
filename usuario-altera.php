<?php
include('conectadb.php');
include('topo.php');
//COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql =" SELECT  * FROM tb_usuarios WHERE usu_id = $id";
$retorno = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($retorno)){
    $login = $tbl[0];
    $email = $tbl[1];
    $senha = $tbl[2];
    $status = $tbl[3];
    
}
// BORA FAZER O UPDATE??
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $senha = $_POST['txtsenha'];
    $email = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_usuarios 
    SET usu_senha = '$senha', usu_email = '$email', usu_status = '$status'
    WHERE usu_id = $id";

    mysqli_query($link, $sql);

    echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='usuario-lista.php';</script>";
    exit();
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
    
     <!-- SELETOR DE ATIVO E INATIVO -->
     <input type="radio" name="status" value="1" <?= $status == '1'?"checked" : ""?>>ATIVO
                <input type="radio" name="status" value="0" <?= $status == '0'?"checked" : ""?>>INATIVO
                <br>
                <br>
                <input type="submit" value="CONFIRMAR">
    </form>

    </div>
    
</body>
</html>