<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];

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
<body class="fundo" style="background-image: url(img/fundo.avif);">
    <div class="container-home">
    <!-- TOPO SEM MOBILE -->
        <div class="topo">
            <?php
                if ($nomeusuario != null) {
                ?>
              <label>BEM VINDO <?= strtoupper($nomeusuario)?></label>
            <?php
                }
                else {
                    echo"<script>window.alert('USUARIO NÃO LOGADO');window.location.href='login.php';</script>";
                }
            ?>
            <a href="logout.php"><img src='incons/Exit-02-WF-256.png'width="50" height="50"></a>
        </div>
  
        <!-- BOTÕES DE MENU -->
         <div class="menu">
            <a href="usuario-cadastro.php"><span class="tooltiptext">Cadastro de Usuario</span>
                                            <img src="./incons/user-add.png"></a>
            <a href="usuario-lista.php"><span class="tooltiptext">Listar Usuarios</span>
                                            <img src="incons/user-find.png"></a>
            <a href="produto-cadastro.php"><span class="tooltiptext">Cadastro Produto</span>
                                            <img src="incons/box.png"></a></a>
            <a href="produto-lista.php"><span class="tooltiptext">Listar Produto</span>
                                            <img src="incons/gantt.png"></a>
            <a href="cliente-cadastro.php"><span class="tooltiptext">Cadastrar Cliente</span>
                                            <img src="incons/customer.png"></a>
            <a href="cliente-lista.php"><span class="tooltiptext">Listar Cliente</span>
                                            <img src="incons/people.png"></a></a>
                                            
            <a href="cupom-cadastro.php"><span class="tooltiptext">Cadastrar Cupom</span>
                                            <img src="incons/sale.png"></a>
            <a href="cupom-lista.php"><span class="tooltiptext">Listar Cupom</span>
                                            <img src="incons/money-credit-card.png"></a></a>

            <a href="vendas.php"><span class="tooltiptext">Vendas</span>
                                            <img src="incons/shopping-cart-02.png"></a>
            <a href="venda-lista.php"><span class="tooltiptext">Listar Vendas</span>
                                            <img src="incons/money.png"></a>
        
         </div>
    </div>
    
</body>
</html>