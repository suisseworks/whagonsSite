<?php

ini_set('display_errors', 1);
error_reporting(-1);
require("./phpmailer/PHPMailerAutoload.php");
$mail = new PHPMailer();


    if (isset($_POST['g-recaptcha-response']))
        $captcha = $_POST['g-recaptcha-response'];

    if (!$captcha) {
        echo -2; //'<h2>Please check the the captcha form</h2>';
        exit;
    }

    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfVGy4UAAAAAAk8mGKlH7Q-A18e_rlUkODg-72s&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
    if ($response['success'] == false) {
        echo '<h2>You are spammer ! ';
        exit;
    } else {
        echo '<h2>Thanks for posting comment.</h2>';
    }

    $mail->Username = "dingdone2.0@gmail.com"; // your GMail user name
    $mail->Password = "Dinganddone135";
    $mail->AddAddress("hello@dinganddone.com"); // recipients email
    $mail->AddAddress("matthiasmalek72@gmail.com"); // recipients email
    $mail->AddAddress("edricklpcr@gmail.com"); // recipients email
    $mail->FromName = "dingdone2.0@gmail.com"; // readable name
    $mail->Subject = "Nuevo Contacto DingDone!";
    $mail->isHTML(true);
    $mail->Body =   'Nuevo Contacto DingDone! <br>' .
                    'Teléfono: ' . $_POST["inputPhone"] . '<br>' .
                    'Correo: ' . $_POST["inputEmail"] . '<br>' .
                    'Comentario: ' . $_POST["inputComment"];

    //$mail->Host = "smtp.gmail.com"; // GMail
    $mail->Host = gethostbyname("smtp.gmail.com");
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPDebug = 1; // turn on SMTP authentication
    $mail->SMTPSecure = "ssl"; // turn on SMTP authentication
    $mail->From = $mail->Username;

    if(!$mail->Send())
         echo "Mailer Error: " . $mail->ErrorInfo;
    else
         echo "Message has been sent";
?>