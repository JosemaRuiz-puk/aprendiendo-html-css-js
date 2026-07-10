<?php

$host = "localhost";
$bd = "web_puk";
$usuario = "web_puk";
$password = "MiWeb2026!";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8mb4",
        $usuario,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conexión correcta con MariaDB";

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}