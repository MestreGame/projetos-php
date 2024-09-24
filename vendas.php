<?php
include("conectadb.php");
include("topo.php");

#VERIFICAÇÃO DO POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    // QUEBRAR A VARIÁVEL PRODUTO EM 3 OUTRAS VARIÁVEIS
    list($idproduto, $nomeproduto, $valorproduto) = explode(',', $produto);
    $qtditem = $_POST['qtditem'];
    // CALCULAR O VALOR DOS ITENS
    $valorlista = $valorproduto * $_POST['qtditem'];
    
    // Inicializar $quantidade_disponivel com um valor padrão
    //- adicionado
    $quantidade_disponivel = 0;

    // Verificar a quantidade disponível no inventário
    // - adicionado
    $sql_check_inventory = "SELECT pro_quantidade FROM tb_produtos WHERE pro_id = $idproduto";
    $retorno_inventory = mysqli_query($link, $sql_check_inventory);
       //adicionado
    if (mysqli_num_rows($retorno_inventory) > 0) {
        $tbl_inventory = mysqli_fetch_array($retorno_inventory);
        $quantidade_disponivel = $tbl_inventory['pro_quantidade'];
           //adicionado
        if ($qtditem > $quantidade_disponivel) {
            // Se a quantidade solicitada for maior que a disponível
            echo "Quantidade insuficiente em estoque para o produto: $nomeproduto. Disponível: $quantidade_disponivel.";
        } else {
            // Se houver quantidade suficiente, continua com o processo existente
            $sql = "SELECT COUNT(iv_status) FROM tb_item_venda WHERE iv_status = 1";
            $retorno = mysqli_query($link, $sql);
           //adicionado
            while ($tbl = mysqli_fetch_array($retorno)) {
                $cont = $tbl[0];

                # SE NÃO EXISTIR CARRINHO ABERTO, CRIA UM NOVO
                if ($cont == 0) {
                    // CRIA O CÓDIGO ITEM_VENDA
                    $codigo_itemvenda = md5(rand(1, 99999) . date('h:i:s'));

                    // INSERINDO O ITEM NA VENDA
                    $sqlitem = "INSERT INTO tb_item_venda(iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status) 
                                VALUES ($valorlista, $qtditem, '$codigo_itemvenda', $idproduto, '1')";
                    mysqli_query($link, $sqlitem);

                    // Atualizar a quantidade do produto no inventário
                    $nova_quantidade = $quantidade_disponivel - $qtditem;
                    $sql_update_inventory = "UPDATE tb_produtos SET pro_quantidade = $nova_quantidade WHERE pro_id = $idproduto";
                    mysqli_query($link, $sql_update_inventory);
                } else {
                    # SE CARRINHO JÁ EXISTIR, RETORNA O NUMERO IV_COD_IV ATIVO E INSERE MAIS ITENS NA VENDA
                    $sql = "SELECT iv_cod_iv FROM tb_item_venda WHERE iv_status = 1";
                    $carrinhoaberto = mysqli_query($link, $sql);
                    $tbl = mysqli_fetch_array($carrinhoaberto);
                    $codigo_itemvenda_ok = $tbl[0];

                    // INSERINDO O ITEM NA VENDA
                    $sqlitem = "INSERT INTO tb_item_venda(iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status) 
                                VALUES ($valorlista, $qtditem, '$codigo_itemvenda_ok', $idproduto, '1')";
                    mysqli_query($link, $sqlitem);

                    // Atualizar a quantidade do produto no inventário
                    $nova_quantidade = $quantidade_disponivel - $qtditem;
                    $sql_update_inventory = "UPDATE tb_produtos SET pro_quantidade = $nova_quantidade WHERE pro_id = $idproduto";
                    mysqli_query($link, $sql_update_inventory);
                }
            }
        }
    } else {
        // Caso o produto não seja encontrado no inventário
        echo "Erro: Produto não encontrado no inventário.";
    }
}

#SELEÇÃO DE ITEM
$sqlpro = "SELECT * FROM tb_produtos";
$retornopro = mysqli_query($link,$sqlpro);

#LISTA DE CLIENTES
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link,$sqlcli);

#LISTA DE PRODUTOS DA COMPRA
$sqllistapro = "SELECT
pro.pro_id, pro.pro_nome, pro.pro_imagem, pro.pro_preco,
iv.iv_quantidade, iv.iv_valortotal, iv.iv_id
FROM tb_produtos pro
JOIN tb_item_venda iv ON pro.pro_id = iv.fk_pro_id
WHERE iv.iv_status = 1;";

$retorno = mysqli_query($link, $sqllistapro);



################### FINALIZAR VENDA ###############

#SELECT DOS ITENS VENDA
#UPDATE DE RETIRAR ITENS
#INSERT NA VENDA
//SOMATORIA DO VALOR
//PESQUISAR A DATA
//UPDATE DO STATUS (1 - 0)

################### FINALIZAR VENDA ###############
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>VENDAS</title>
</head>
<body>
    <div class="container-global">
        
        <form class = "formulario" action="vendas.php" method="post">
            <label>SELECIONE O PRODUTO </label>
            <select name='produto'>
                <!-- PUXA OS DADOS DO SERVER PREENCHENDO O OPTION -->
                 <?php while ($tblpro = mysqli_fetch_array($retornopro)){
                ?>
                    <option value="<?= $tblpro[0] . ',' .  $tblpro[1] . ',' .  $tblpro[4]?>">
                    <?= strtoupper($tblpro[1]) ?></option>
                 <?php   
                 }
                 ?>
            </select>
            <br>
            <label>QUANTIDADE</label>
            <input type='decimal' name="qtditem">
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
        </div> 
        <!-- TIRAR A DIV DE BAIO E FECHAR AQUI -->
                <br>
        <div class="container-listaproduto">
            <table class="lista">
                <tr>
                    <th>ID</th>
                    <th>NOME PRODUTO</th>
                    <th>VALOR UN.</th>
                    <th>QUANTIDADE</th>
                    <th>IMAGEM</th>
                    <th>DELETAR</th>
                </tr>
                <?php
                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                <tr>    <!-- ABRIR A TR -->
                    <td><?=$tbl[0]?></td> <!--COLETA ID-->
                    <td><?=$tbl[1]?></td> <!--COLETA NOME-->
                    <td><?=$tbl[3]?></td> <!--COLETA QTD-->
                    <td><?=$tbl[4]?></td> <!--COLETA VALOR UNITARIO-->
                    <td><img src='data:image/jpeg;base64,<?=$tbl[2]?>'
                    width="200" height="200"></td> <!--COLETA IMG-->
                    <td><a href="venda-deleta-item.php?id=<?=$tbl[6]?>">
                        <input type="button" value="EXCLUIR">
                    </a>
                    </td>
                </tr>  <!-- FECHAR A TR -->

                <?php
                    }
                ?>
            </table>
            <br>
        </div>
    
    <!-- FORMULARIO FINAL DE NOME E ENVIO -->
     <div class="container-global">
        <form class="formulario" action="vendas-finalizar.php" method = "post"> <!-- mudar o nome da pag php -->

            <label>SELECIONE O CLIENTE</label>
                    <select name='nomecliente'>
                        <!-- PUXANDOS DADOS DO SERVIDOR E PREENCHENDO O OPTION -->
                         <!-- <option value='vazio'> VAZIO</option -->
                        <!-- PUXAR OS NOMES DOS CLIENTES -->
                        <?php while ($tblcli = mysqli_fetch_array($retornocli)){
                        ?>
                            <option value="<?=$tblcli[0]?>">   <!--faltou o = dps do ?  -->
                            <?=strtoupper($tblcli[1])?>
                            </option>
                        <?php
                         }
                         ?>
                    </select>

            <label>VALOR TOTAL</label>
            <!-- SELECT PARA RETORNAR A SOMA DO VALOR TOTAL  -->
                <?php $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda
                WHERE iv_status = 1 ";
                $retornovalortotal = mysqli_query($link,$valortotal);
                    while($tblvalortotal = mysqli_fetch_array($retornovalortotal)){
                        echo "R$" . $tblvalortotal[0];
                    }?>
                    <input type="submit" value="CONFIRMAR">
        </form>
     </div>

</body>
</html>