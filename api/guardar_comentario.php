<?php

require_once __DIR__ . "/conexion.php";
require_once __DIR__ . "/correo.php";

$apodo = $_POST["apodo"];
$email = $_POST["email"];
$tipoVisita = $_POST["tipo_visita"];
$comentario = $_POST["comentario"];

$sql = "INSERT INTO comentarios
        (apodo, email, tipo_visita, comentario)
        VALUES
        (:apodo, :email, :tipo_visita, :comentario)";

$sentencia = $conexion->prepare($sql);

$sentencia->execute([
    ":apodo" => $apodo,
    ":email" => $email,
    ":tipo_visita" => $tipoVisita,
    ":comentario" => $comentario
]);

$mensaje =
"Nuevo comentario pendiente de moderación.

Apodo: $apodo

Email: $email

Tipo de visitante: $tipoVisita

Comentario:

$comentario";

enviarCorreo(
    "Nuevo comentario en la web",
    $mensaje
);

header("Location: comentarios.php");
exit;