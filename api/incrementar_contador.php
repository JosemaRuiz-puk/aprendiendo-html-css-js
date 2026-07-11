<?php

require_once __DIR__ . "/conexion.php";

$sql = "UPDATE estadisticas
        SET valor = valor + 1
        WHERE nombre = 'pulsaciones_boton'";

$conexion->prepare($sql)->execute();

$sql = "SELECT valor
        FROM estadisticas
        WHERE nombre = 'pulsaciones_boton'";

$sentencia = $conexion->prepare($sql);
$sentencia->execute();

$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

header("Content-Type: application/json");

echo json_encode([
    "valor" => $resultado["valor"]
]);