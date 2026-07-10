<?php

require_once "conexion.php";

$sql = "SELECT apodo, comentario, fecha
        FROM comentarios
        WHERE estado = 'aprobado'
        ORDER BY fecha DESC";

$sentencia = $conexion->prepare($sql);
$sentencia->execute();

$comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios de los visitantes</title>

    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <h1>Comentarios de los visitantes</h1>

    <p>
        Gracias por dejar tu comentario.
        Lo revisaré antes de publicarlo.
    </p>

    <?php if (count($comentarios) === 0): ?>

        <p>Todavía no hay comentarios publicados.</p>

    <?php else: ?>

        <?php foreach ($comentarios as $comentario): ?>

            <article>
                <h2>
                    <?= htmlspecialchars($comentario["apodo"]) ?>
                </h2>

                <p>
                    <?= nl2br(htmlspecialchars($comentario["comentario"])) ?>
                </p>

                <small>
                    <?= htmlspecialchars($comentario["fecha"]) ?>
                </small>
            </article>

            <hr>

        <?php endforeach; ?>

    <?php endif; ?>

    <p>
        <a href="../visita.html">Dejar otro comentario</a>
    </p>

    <p>
        <a href="../index.html">Volver a la página principal</a>
    </p>

</body>

</html>