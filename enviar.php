<?php

require("class.phpmailer.php");
require("class.smtp.php");
// Llamando a los campos
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$destinatario = "venditti.erica@hotmail.com";
$asunto = "Contacto desde nuestra web";
// Datos de la cuenta de correo utilizada para enviar v�a SMTP
$smtpHost = "mail.tudominio.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "correo@tudominio.com";  // Mi cuenta de correo
$smtpClave = "123456789";  // Mi contrase�a

if (empty($_POST['nombre'] 
)) {
    echo "El campo nombre está vacío"; 
  }else {
    $carta = "De: $nombre \n";      
  }
if (empty($_POST['apellido'])) {
    echo "El campo apellido está vacío"; 
  }else {
    $carta .= "Apellido: $apellido \n";    
  }
if (empty($_POST['email'])) {
    echo "El campo email está vacío"; 
  }else {
    $carta .= "Email: $email \n";      
  }
if (empty($_POST['mensaje'])) {
    echo "El campo mensaje está vacío"; 
  }else {
    $carta .= "Mensaje: $mensaje";    
  }
  


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde env�o el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);

$mail->Body = "
<html> 

<body> 

<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>nombre: {$nombre}</p>

<p>apellidp: {$apellido}</p>

<p>asunto: {$asunto}</p>

<p>email: {$email}</p>

<p>mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //


$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente.";
} else {
    echo "Ocurrio un error inesperado.";
}

//mensaje 
//$contenido = "Nombre: " $nombre "\nEmail: " "\nApellido: " $apellido "\nMensaje: " $mensaje "";
// Datos para el correo




?>

