<?php
// include ("header.php");
session_start();
$nomeusuario = $_SESSION['nomeusuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>HOME PRINCIPAL</title>
</head>
<body>
    <div class="container-home">
    <!-- TOPO SEM MOBILE -->
        <div class="topo">
        <label>Bem Vindo</label>
        <a href="logout.php">Sair</a>
            
        </div>
  
        <!-- BOTÕES DE MENU -->
         <div class="menu">   
        <a href="usuario-cadastro.php"><span class="tooltiptext">CADASTRAR USUARIOS <img src="./incons/user-add.png" width="150" height="150"></a></span>                    
        <a href="usuario-lista.php"><span class="tooltiptext">LISTAR USUARIOS</span><img src="./incons/user-find.png"width="150" height="150" ></a>
        <a href="produto-cadastro.php"><span class="tooltiptext">CADASTRAR PRODUTO</span> <img src="./incons/box.png"width="150" height="150"></a>
        <a href="produto-lista.php"><span class="tooltiptext">LISTAR PRODUTO</span><img src="./incons/gantt.png"width="150" height="150"></a>
        <a href="cliente-cadastro.php"><span class="tooltiptext">CADASTRAR CLIENTE</span><img src="./incons/customer.png"width="150" height="150"></a>
        <a href="cliente-lista.php"><span class="tooltiptext">LISTAR CLIENTE</span><img src="./incons/people.png"width="150" height="150"></a>
        <a href="vendas.php"><span class="tooltiptext">VENDAS</span><img src="./incons/shopping-cart-04.png"width="150" height="150"></a>
        
         </div>
    </div>
    
</body>
</html>