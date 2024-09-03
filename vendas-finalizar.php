<?php
include("conectadb.php");
include('topo.php');

//COLETAR DADOS DO POST
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $idcliente =($_POST['nomecliente']);
    
    #PESQUISA OS ITEMS DA COMPRA
    $sql= "SELECT * FROM tb_item_venda WHERE iv_status =1";
    
    #USADO PARA FAZER REMOÇÃO DE ITEMS NO INVENTARIO
    $retornoproduto= mysqli_query($link,$valortotal);

    #USADO PARA FAZER O TOTAL
    $total =0; //incializando a varivael
    $valortotal="SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_status =1";
    $retornoproduto = mysqli_fetch_array($link,$valortotal);

    while ($tblvalortotal= mysqli_fetch_array($retornoproduto)){
        $total = $tblvalortotal[0];
    }
    #USADO PARA FINALIZAR DE VENDA
    $retornocarrinho = mysqli_query($link,$sql);
    $usuario =$_SERVER['idusuario'];

     ///////////////////// REALIZAR CORREÇÃO DE VERIFICAÇÃO DE ITEM DO INVENTARIO
    


    //REALIZAR CORREÇÃO DE VERIFICAÇÃO DE ITEM DO INVENTARIO

    #REMOÇÃO DE ITEMS DO INVENTARIO
    while($tblitem = mysqli_fetch_array($retornoproduto)){
        $produto_id = $tbitem[4];
        $quantidade_item = $tblitem[2];

        //CONSULTA PARA OBTER A QUANTIDADE ATUAL DO PRODUTO
        $sqlproduto = "SELECT pro_quantidade FROM tb_produto WHERE pro_id = $produto_id";
        $retornoproduto_into = mysqli_query($link,$sqlproduto);

        //ATUALIZAÇÃO DA QUANTIDADE DP PRODUTO
        if($row = mysqli_fetch_array($retornoproduto_into)){
        $quantidade_produto = $row[0];
        $nova_quantidade - $quantidade_produto -$quantidade_item;
        $sql_update_produto -"UPDATE tb_produtos SET pro_quantidade= $nova_quantidade
        WHERE pro_id = $produto_id";
        $resultado_update_produto = mysqli_query($link,$sql_update_produto);
        }
      }

        //RETORNA A DATA E HORA ATUAL PARA FINALIZAR O CARRINHO
        $data = data("Y-m-d H-i:s");

        $tbl = mysqli_fetch_array($retornocarrinho);

        $sqlvenda = "INSERT INTO tb_venda (ven_datavenda, ven_totalvenda, fk_iv_cod_iv, fk_cli_id, fk_usu_id)
        VALUES ('$data',$total, '$tbl[3]',$idcliente,$usuario)";
        echo $sqlvenda;
        mysqli_query($link,$sqlvenda);

        #TROCAR O STATUS DA VENDA PARA FECHADO
        $sqlfechavenda= "UPDATE tb_item_venda SET iv_status = 0 WHERE iv_status=1";
        mysqli_query($link,$sqlfechavenda);
        
        header("Location: backoffice.php");









}
