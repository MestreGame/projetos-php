<?php
include('conectadb.php');
include('topo.php');

// Inicializa a variável $status para evitar o aviso
$status = '';
//COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql =" SELECT  * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[0];
    $email = $tbl[1];
    $cpf = $tbl[2];
    $cel = $tbl[3];
    $status = $tbl[4];
    
}
// BORA FAZER O UPDATE??
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $cel = $_POST['txttelefone'];
    $email = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_clientes 
            SET cli_cel = '$cel', cli_email = '$email', cli_status = '$status'
            WHERE cli_id = $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='cliente-lista.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo-altera.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
                
    <title>CLIENTES ALETERÇÃO</title>
</head>
<body>
<div class="container-global">
    <form class="formulario" action="login.php" method="post">
    
    <label>Nome</label>
    <input type="text" name="txtnome" placeholder="Digite Seu Nome" required>
    <br>
    <label>CPF</label>
    <input type="text" name="txtcpf" placeholder="Digite Seu Nome" required>
    <br>
    <label>EMAIL</label>
    <input type="email" name="txtemail" placeholder="Digite seu email" required>
    <br>
    <label>Telefone</label>
    <input type="text" id="telefone" name="txttelefone" placeholder="(00)00000-0000" maxlength="11" required>
    <br>

    <!-- SELETOR DE ATIVO E INATIVO -->
    <input type="radio" name="status" value="1" <?= $status == '1'?"checked" : ""?>>ATIVO
    <br>
    <input type="radio" name="status" value="0" <?= $status == '0'?"checked" : ""?>>INATIVO
    <br>
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="submit" value="CONFIRMAR">
</form>

<div>

</body>
</html>