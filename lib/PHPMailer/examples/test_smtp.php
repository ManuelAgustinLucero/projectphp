<?php

include_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded


$mensaje = "Este es un mail de confirmación para la modificacion de sus datos. Sus datos ya se encuentran modificados. Mantenga siempre sus datos al dia, son nuestra via de contacto.\n\n";
$mensaje .= "Atte. Agencias Joker.\n\n";


$mensaje2 = "Desde el IP ".$_SERVER['REMOTE_ADDR']." se han modificado los datos de ".$_SESSION["nick_usuario"]."\n";
$mensaje2 .= "Fecha y Hora: ".date("d-m-Y H:i:s");
//mail($email_usuario, "Confirmacion de cambio de datos", $mensaje, "FROM: Agencias Joker <noresponder@jokerapuestas.com.ar>");
//mail("administracion@jokerapuestas.com.ar, rupion@hotmail.com, gabriel_vago@hotmail.com", "Cambio de Datos", $mensaje2, "FROM: Agencias Joker <noresponder@jokerapuestas.com.ar>");



$mail             = new PHPMailer();

//$body             = $mail->getFile('contents.html');
//$body             = eregi_replace("[\]",'',$body);
//$mail->IsSMTP(); // telling the class to use SMTP

$mail->Mailer = "smtp";
$mail->Host       = "190.228.29.20"; // SMTP server
$mail->SMTPAuth = true;
$mail->Username = "testing@jokerapuestas.com.ar";
$mail->Password = "123456";


$mail->From       = "noresponder@jokerapuestas.com.ar";
$mail->FromName   = "Agencias Joker";

$mail->AddAddress("leotioni@hotmail.com", "Leo Tioni");

$mail->Subject    = "Confirmacion de cambio de datos";

$mail->Body = eregi_replace("\n", "<br />", $mensaje);
$mail->AltBody = $mensaje;

//$mail->MsgHTML($body);
//$mail->AddAttachment("images/phpmailer.gif");             // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
