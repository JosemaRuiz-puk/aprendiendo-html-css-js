<?php

require_once "conexion.php";

$id = $_POST["id"];
$estado = $_POST["estado"];

if ($estado !== "aprobado" && $estado !== "rechazado") {
    die("Estado no válido");
}

$sql = "UPDATE comentarios
        SET estado = :estado
        WHERE id = :id";

$sentencia = $conexion->prepare($sql);

$sentencia->execute([
    ":estado" => $estado,
    ":id" => $id
]);

header("Location: admin_comentarios.php");
exit;       