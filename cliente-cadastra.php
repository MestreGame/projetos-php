<?php
include("conectadb.php");
// include("header.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cel = $_POST['txtcel'];

    $sql = "SELECT COUNT(cli_id) FROM tb_clientes WHERE cli_cpf = '$cpf' ";

    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    if($contagem == 0){
        $sql = "INSERT INTO tb_clientes(cli_cpf, cli_nome, cli_email, cli_cel, cli_status)
        VALUES ('$cpf', '$nome', '$email', '$cel', '1')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='backoffice.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('CLIENTE JÁ EXISTENTE');</script>";
    }

}
        
    
    



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo-formulario.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>CLIENTES CADASTRA</title>
</head>
<body>
<a href="backoffice.php"><img src="icons.old/arrowhead-left-01.png" width="16" height="16"></a>

    <div class="container-global">
        
        <form class="formulario" action="cliente-cadastra.php" method="post">
            
            <label>CADASTRAR O CLIENTE</label>
            <label>Nome</label>
            <input type="text" name="txtnome" placeholder="Digite Seu Nome" required>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
            <br>
            <label>CPF</label>
            <input type="text" id="cpf" name="txtcpf" placeholder="000.000.000-00" maxlength="14" required >
            <br>
            <label>Telefone</label>
            <input type="text" id="telefone" name="txttelefone" placeholder="(00) 00000-0000" maxlength="11" required>
            <br>
            <input type="submit" value="CADASTRA CLIENTE">
        </form>

    </div>
    
</body>
</html>