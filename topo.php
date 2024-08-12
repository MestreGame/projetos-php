<?php
// include ("header.php");
session_start();
$nomeusuario = $_SESSION['nomeusuario'];

?>
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

           
            <a href="backoffice.php"><img src='incons/Navigation-left-01-256.png' width ="30px" height= "30px" >Sair</a>


        </div>