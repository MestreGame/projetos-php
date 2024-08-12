<?php
include('conectadb.php');
include('topo.php');

$nomeusuario = $_SESSION['nomeusuario'];

// include("header.php");


// CONSULTA CLIENTES CADASTRADOS
$sql = "SELECT cli_nome, cli_email,cli_cel,cli_cpf,cli_id, cli_status 
        FROM tb_clientes WHERE cli_status = '1'";
$retorno = mysqli_query($link, $sql);
$status = '1';

//ENVIANDO PARA SEVIDOR  O SELETOR RADIO EM 0 A 1
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $status = $_POST['status'];
}
if($status="1"){
    $sql ="SELECT * FROM tb_clientes WHERE cli_status ='1'";
    $retorno = mysqli_query($link, $sql);
}
else{
    $sql ="SELECT * FROM tb_clientes WHERE cli_status ='0'";
    $retorno = mysqli_query($link,$sql);
}






?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE USUARIOS</title>
</head>
<body>
<a href="backoffice.php"><img src="icons.old/arrowhead-left-01.png" width="16" height="16"></a>

    <div class="container-listausuarios">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="cliente-lista.php" id="bu"> 
            <input type="radio" name="status" value="1" required onclick= "submit()">
            <?$status="1" ? "checked": ""?>>ATIVOS
            <input type="radio" name="status" value="0" required onclick= "submit()">
            <?$status="0" ? "checked": ""?>>INATIVOS



        </form>
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">
            <tr>
                <th>Nome</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>CPF</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
              
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 
                 <tr>
                    <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO CLIENTE-->
                    <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO CLIENTE-->
                    <td><?=$tbl[0]?></td> <!-- COLETA O TELEFONE DO CLIENTE-->
                    <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO CLIENTE-->
                    <td><?=$tbl[5]?></td> <!-- COLETA O STATUS DO CLIENTE-->
                    <td><a href="cliente-altera.php?id=<?=$tbl[4]?>">
                            <input type="button" value="ALTERAR"></a>
                    </td>
                 </tr>
                 
                 <?php
                }
                ?>
        </table>

    </div>
    
</body>
</html>