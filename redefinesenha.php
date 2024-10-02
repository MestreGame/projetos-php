<?php
if($_SERVER ["REQUEST_METHOD"]=="POST"){

    include('conectadb,php');
   $email = $_POST['email'];
   $email = $_POST['cod'];
   $email = $_POST['senha'];
 
   if($cod=""){//VALIDAÇÃO SE O CAMPO COD FOI DIGITADO NULO
    header("Location:redefinesenha.php?msg=Cod invalido");
    exit();
   }
   $sql = "SELECT COUNT(usu_id) FROM tb_usuarios WHERE usu_email = '$email' AND recupera = '$cod'";
   $resultado = mysqli_query($link,$sql);

   while($tql= mysqli_fetch_array($resultado)){
    $cont = $tql[0];
   }
   if($cont == 0 ){
    $sql = "UPDATE tb_usuarios SET recupera = '' WHERE usu_email '$email'";
    mysqli_query($link,$sql);
    header("Location:redefinesenha.php?msg=Codigo errado, solicite outro");
    exit();

   }
   else{
    $randoe = rand(100000,999999);
    $tempero = md5($tempero . $senha);
    $sql = "UPDATE tb_usuarios SET  usu_senha = '$senha', tempero = '$tempero',
    recupera = $random WHERE usu_email = 'email'";
    mysqli_query($link, $sql);
    header("Location.login.php?msg=Senha alterada com sucesso");
   }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/redefinir.css">
    <link href="https://fonts.cdnfontos.com/css/curely" rel="styleshhet">
    <title>Redefine Senha</title>
</head>
<body>
<body class="fundo" style="background-image: url(img/fundo.avif);">
    <div class = container-global>
    <form class="formulario"  action="redefinesenha.php" method="post">
    <h1>REDEFINE SENHA</h1>
    <label>EMAIL</label>
    <input type="text" id="email" name = "email" required>
    <br>
    <label>CODIGO</label>
    <input type="cod" id="cod" name = "cod"  required>
    <br>
    <label>NOVA SENHA</label>
    <input type="Password" id="senha" name = "senha"   required>
    <br>
    <input type="sumbit" value="REDEFINIR">
    </form>

    <p id="msg">
        <?php
        if(isset($_GET['msg'])){
            echo($_GET['msg']);
            if($_GET['msg'] == "Usuario ou senha inforretos"){
                echo("<br><a href='recuperasenha.php'>Squeci minha senha</a>");
            }
        }
        ?>
        </p>
    </div>
    
</body>
</html>