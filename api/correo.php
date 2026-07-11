<?php

require_once __DIR__ . "/../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreo($asunto, $mensaje)
{
    $config = require "/opt/web/config.php";

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = $config["smtp"]["host"];
        $mail->SMTPAuth = true;
        $mail->Username = $config["smtp"]["username"];
        $mail->Password = $config["smtp"]["password"];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config["smtp"]["port"];

        $mail->CharSet = "UTF-8";

        $mail->setFrom(
            $config["smtp"]["username"],
            $config["smtp"]["from_name"]
        );

        $mail->addAddress($config["smtp"]["username"]);

        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        $mail->send();

    } catch (Exception $e) {

        // No hacemos nada.
        // El comentario ya está guardado y no queremos molestar al visitante.

    }
}