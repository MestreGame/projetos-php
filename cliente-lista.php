<?php
include("conectadb.php");
// include("header.php");




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
<a href="backoffice.php"><img src="icons/arrowhead-left-01.png" width="16" height="16"></a>

    <div class="container-listausuarios">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form>

        </form>
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">
            <tr>
                <th>Nome</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>CPF</th>
                <th>ID</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 
                 <tr>
                    <td><?=$tbl[0]?></td> <!-- COLETA O NOME DO CLIENTE-->
                    <td><?=$tbl[1]?></td> <!-- COLETA O EMAIL DO CLIENTE-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O TELEFONE DO CLIENTE-->
                    <td><?=$tbl[3]?></td> <!-- COLETA O CPF DO CLIENTE-->
                    <td><?=$tbl[4]?></td> <!-- COLETA O STATUS DO CLIENTE-->
                
                    <td><a href="cliente-lista.php?id=<?=$tbl[4]?>">
                            <input type="button" value="ALTERAR">
                        </a>
                    </td>
                 </tr>
                 
                 <?php
                }
                ?>
        </table>

    </div>
    
</body>
</html>