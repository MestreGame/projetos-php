<?php
// include ("header.php");
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
            <?php
            if($nomeusuario != null)
            ?>
            <li class="perfil"><label>Bem Vindo <?= $nomeusuario?></label></li>
            <?php
            else
            {
                echo("<script>windows.alert('USUARIOS NAO LOGADO');
                window.location.href='login.php';</script>");

            }
            ?>

            <label>Bem Vindo</label>
            <a href="logout.php"><img src='incons/Exit-02-WF-256.png'>Sair</a>


        </div>
  
        <!-- BOTÕES DE MENU -->
         <div class="menu">
            <a href="usuario-cadastro.php"><span class="tooltiptext">CADASTRAR USUARIOS <img src="./incons/user-add.png"></a></span>
                                  
            <a href="usuario-lista.php"><span class="tooltiptext">LISTAR USUARIOS</span><img src=".incons/user-find.png"></a>
            <a href="produto-cadastro.php"><span class="tooltiptext">CADASTRAR PRODUTO</span> <img src=".incons/box.png"></a>
            <a href="produto-lista.php"><span class="tooltiptext">LISTAR PRODUTO</span><img src=".incons/gantt.png"></a>
            <a href="cliente-cadastro.php"><span class="tooltiptext">CADASTRAR CLIENTE</span><img src=".incons/customer.png"></a>
            <a href="cliente-lista.php"><span class="tooltiptext">LISTAR CLIENTE</span><img src=".incons/people.png"></a>
            <a href="vendas.php"><span class="tooltiptext">VENDAS</span><img src=".incons/shopping-cart-04.png"></a>
        
         </div>
    </div>
    
</body>
</html>