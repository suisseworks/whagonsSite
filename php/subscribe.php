<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $whsubject = $_POST["whsubject"];
  $messages = '<!DOCTYPE html>
  <html>

  <head>

  <title>WhaGons Suscriptor</title>

  <style type="text/css">

  p{

    margin: 0;

  }

  </style>

  </head>

  <body>

  <table border="0" cellpadding="1" cellspacing="1" style="width:600px; margin: 0 auto;">

  <tbody>

  <tr>

  <td>

  <strong style="margin: 10px 0 0;"><u>Correo: </u></strong> '.$email.'

  </td>

  </tr>

  </tbody>

  </table>

  </body>

  </html>';

  $receiver = "yaseen3327095758@gmail.com";

  $subject = "Nueva suscriptor";

  $email_headers = "From: Whagons <noreply@whagons.com>";

  $email_headers .= 'MIME-Version: 1.0' . "\r\n";

  $email_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  if (mail($receiver, $subject, $messages, $email_headers)) { 
    $result = ['type' => 'success', 'msg' => '¡Gracias! por suscribirse'];
    echo json_encode($result);

  } else {
    $result = ['type' => 'error', 'msg' => "¡UPS! Algo salió mal y no pudimos enviar su mensaje."];
    echo json_encode($result);
  }
} else {
  $result = ['type' => 'error', 'msg' => "Hubo un problema con su envío. Vuelva a intentarlo."];
  echo json_encode($result);

}

?>
