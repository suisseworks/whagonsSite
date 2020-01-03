<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.googlemail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dingdone2.0@gmail.com';                     // SMTP username
    $mail->Password   = 'lbfkkcynarymiolw';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->AddAddress("edricklpcr@gmail.com");     // Add a recipient
    // $mail->AddAddress("mm@whagons.com");     // Add a recipient
    // $mail->AddAddress("help@dinganddone.com");     // Add a recipient
    // $mail->AddAddress("bussines@whagons.com");     // Add a recipient

    $mail->SetFrom('dingdone2.0@gmail.com');

    // Content
    $mail->Subject = "Solicitud de Demo Whagons!";
    $mail->isHTML(true);
    $mail->Body =   '<h1>Solicitud de Whagons!</h1> <br><br>' .
                    '<b>Nombre: </b>' . $_POST["inputName"] . '<br>' .
                    '<b>Correo: </b>' . $_POST["inputEmail"] . '<br>' .
                    '<b>Telefono: </b>' . $_POST["inputPhone"] . '<br>' .
                    '<b>Organizacion: </b>' . $_POST["inputOrganization"] . '<br>' .
                    '<b>País: </b>' . $_POST["country"] . '<br>' .
                    '<b>Comentario: </b>' . $_POST["inputComment"];

    $mail->send();
    
    echo json_encode([
        "result" => true,
        "msj" => 'Message has been sent'
    ]);

} catch (Exception $e) {
    echo json_encode([
        "result" => false,
        "msj" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ]);
}