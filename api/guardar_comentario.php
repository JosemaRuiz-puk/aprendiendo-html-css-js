<?php

require_once "conexion.php";

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

echo "Comentario guardado correctamente";