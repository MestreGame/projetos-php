<?php
include("conectadb.php");
// include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cpf = $_POST['txtcpf'];
    $telefone = $_POST['txttelefone'];
    // Consultar o banco de dados para verificar se o cliente já existe
    $sql = "SELECT COUNT(cli_id) FROM tb_clientes WHERE cli_email = '$email' OR cli_cpf = '$cpf'";
    $retorno = mysqli_query($link, $sql);
    
    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno)[0];

    if ($contagem == 0) {
        // Inserir novo cliente
        $sql = "INSERT INTO tb_clientes (cli_nome, cli_email, cli_cel, cli_cpf, cli_status)
                VALUES ('$nome', '$email', '$telefone', '$cpf', '1')";
        if (mysqli_query($link, $sql)) {
            echo "<script>window.alert('Cliente cadastrado com sucesso.');</script>";
            echo "<script>window.location.href='login.php';</script>";
        } else {
            echo "<script>window.alert('Erro ao cadastrar cliente: " . mysqli_error($link) . "');</script>";
        }
    } else {
        echo "<script>window.alert('Cliente \"CLIENTE JÁ CADASTRADO\" já existe.');</script>";
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
                
    <title>CLIENTES CADASTRAR</title>
</head>
<body>
<a href="backoffice.php"><img src="icons.old/arrowhead-left-01.png" width="16" height="16"></a>

    <div class="container-global">
        
        <form class="formulario" action="cliente-cadastro.php" method="post">
            
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
            <input type="submit" value="CADASTRAR CLIENTE">
        </form>

    </div>
    
</body>
</html>