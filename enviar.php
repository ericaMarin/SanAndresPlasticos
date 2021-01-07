<?php

require("class.phpmailer.php");
require("class.smtp.php");
// Llamando a los campos
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$destinatario = "mauro@mtcsistemas.com.ar";
$asunto = "Contacto desde el sitio web";
$smtpHost = "mail.sanandresplasticos.com.ar";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "mailing@sanandresplasticos.com.ar";  // Mi cuenta de correo
$smtpClave = "Mailing1234";  // Mi contrase�a
  

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

$mail->From = $smtpUsuario; // Email desde donde env�o el correo.
$mail->FromName = 'Contacto Web';
$mail->AddAddress($destinatario); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = $asunto; // Este es el titulo del email.

$mail->Body = "
<html> 
<body> 
<h1>Recibiste un nuevo mensaje desde el formulario de contacto</h1>
<p>Informacion enviada por el usuario de la web:</p>
<p>Nombre: <strong>{$nombre}</strong></p>
<p>Apellido: <strong>{$apellido}</strong></p>
<p>Email: <strong>{$email}</strong></p>
<p>Mensaje: <strong>{$mensaje}</strong></p>
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
$respuesta = new stdClass();
if($estadoEnvio){
    //echo "El correo fue enviado correctamente.";
    $respuesta->estado = 'OK';
    $respuesta->mensaje = 'El correo fue enviado correctamente.';
    echo json_encode($respuesta);
} else {
    //echo "Ocurrio un error inesperado.";
    $respuesta->estado = 'KO';
    $respuesta->mensaje = 'Ocurrio un error inesperado.';
    echo json_encode($respuesta);
}

?>

