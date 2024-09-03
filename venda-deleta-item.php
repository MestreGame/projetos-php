<?php
include("conectadb.php");

$iddiv=$_GET['id'];
$sqldeleta= "DELETA FROM tb_item_venda WHERE iv_id = $iddiv";
$resultado= mysqli_query($link,$sqldeleta);

header("Location:vendas.php")