<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMail\src\Exception.php';
require 'PHPMail\src\PHPMailer.php';
require 'PHPMail\src\SMTP.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    include('conectadb.php');
    $email = $_POST['email'];
    //VERIFICAÇAO SE O USUARIO E VALIDO
    $sql = "SELECT COUNT(usu_id) FROM tb_usuarios WHERE usu_email = '$email'";
    $resultado= mysqli_query($link,$sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $cont = $tbl[0];
    }
    if($cont ! = 0){
        $recupera  = rand(100000, 999999);
        $sql= "UPDATE tb_usuarios SET recupera = '$recupera'
        WHERE usu_email = '$email'";
        mysqli_query($link,$sql);

        $to = $email;
        $subject = "RECUPERAÇÃO DE SENHA"; 
        $message = "Esse é o seu codigo de recuperação: $recupera. <br>
        Acesso  <a href= 'http://localhost/projetoti28/mafia-do-pao/redefinesenha.php'> aqui </a>
        para redefinir sua senha. ";
        $email = new PHPMailer(true);
        try
        {
            $email->SMTPDebug = 0;
            $email->isSMTP();
            $email->Host = 'smtp.office365.com';
            $email->SMTPAuth=true;
            $email->Username = 'seuemail@outlook.com';
            $email->Password = 'suasenha';
            $email->SMTPSecure = PHPMailer::ENCRYPITION_STARTILS;
            $email->Port = 587;
            $email->setfrom('seuemail@outlook.com', 'EMAIL REC');
            $email->addAddress($to);
            $email->isHTML(true);
            $email->Subject = $subject;
            $email->Body = $message;
            $email->send();
            echo"<script>windows.alert('EMAIL ENVIADO COM SUCESSO!');<script>";
        }
        catch (Exception $e)
        {
          echo "NÃO FOI POSSIVELENVIAR A MENSAGEM:($email->Errorinfo)";
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">

    <title>RECUPERAÇÃO DE SENHA</title>
</head>
<body>
    <div class= "container global">
        <form class="formulario" action="recuperasenha.php" method= "POST">
            <h2><label>Redefinir Senha</label></h2>
            <label for="email">EMAIL</label>
            <br>
            <input type="submit" value="Enviar">

        </form>
</div>

    
</body>
</html>