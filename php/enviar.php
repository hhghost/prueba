<!-- Alertas -->
<script src="sweetalert2.all.min.js"></script>
<sript src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Mailer/Exception.php';
require '../Mailer/PHPMailer.php';
require '../Mailer/SMTP.php';

// Load Composer's autoloader
// require 'vendor/autoload.php';

$correo = $_POST ['correo'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'crservices.soporte@gmail.com';                     // SMTP username
    $mail->Password   = 'AdrianHansel2020..';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom( 'crservices.soporte@gmail.com','Contacto');
    $mail->addAddress('crservices.soporte@gmail.com', 'Crservices');     // Add a recipient
    

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto; 
    $mail->Body    = '<b>El cliente:</b> ' . $mensaje . '<b> Contactar con:</b> ' . $correo;   
    $mail->AltBody = 'El cliente:' . $mensaje . ' Contactar con: ' . $correo; 

    $mail->send();
    echo'<script> 
    swal.fire({
    position: "center",
    icon: "success",
    title: "Email Enviado..!!",
    showConfirmButton: true,
    confirmButtonText: "Aceptar"
    }).then(function(result){
        if(result.value){
         window.location = "../nosotros";
        }
    })
    </script>';
   

} catch (Exception $e) {
    echo'<script> 
	swal.fire({
        position: "center",
        icon: "error",
        title: "Email no fue Enviado.!!",
        showConfirmButton: true,
        confirmButtonText: "Aceptar"
        }).then(function(result){
            if(result.value){
             window.location = "../nosotros";
            }
        })
        </script>';
}
