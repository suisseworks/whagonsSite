<?php
if (isset($_POST)) {
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $additional_details = $_POST['additional_details'];

    $message = '<b>Subejct: </b>'.$subject.'<br>'.
    '<b>Email: </b>'.$email.'<br>'.
    '<b>Additional Details: </b>'.$additional_details;

    $to = "help@whagons.com";
    // $to = "<info@explorelogics.com>, <yaseen3327095758@gmail.com>";
    $from = $email;
    $subject = $subject;

    $headers = "From: Support Contact " . $from."\r\n";;
    $headers .= "Reply-To: ".$email."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode( array('msg' => 'success', 'response' => 'Email successfully sent. We will be in touch with you shortly. Thanks.') );
        exit;
    } else {
        echo json_encode( array('msg' => 'error', 'response' => 'Sorry, an error occurred while a sending message, Please try again.') );
        exit;
    }

}