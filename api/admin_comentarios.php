<?php

require_once "conexion.php";

$sql = "SELECT id, apodo, email, tipo_visita, comentario, fecha
        FROM comentarios
        WHERE estado = 'pendiente'
        ORDER BY fecha ASC";

$sentencia = $conexion->prepare($sql);
$sentencia->execute();

$comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderación de comentarios</title>

    <link rel="stylesheet" href="../styles.css">
</head>

<body>

    <h1>Comentarios pendientes</h1>

    <?php if (count($comentarios) === 0): ?>

        <p>No hay comentarios pendientes de revisión.</p>

    <?php else: ?>

        <?php foreach ($comentarios as $comentario): ?>

            <article>

                <h2>
                    <?= htmlspecialchars($comentario["apodo"]) ?>
                </h2>

                <p>
                    <strong>Email:</strong>
                    <?= htmlspecialchars($comentario["email"] ?? "") ?>
                </p>

                <p>
                    <strong>Tipo de visitante:</strong>
                    <?= htmlspecialchars($comentario["tipo_visita"]) ?>
                </p>

                <p>
                    <?= nl2br(htmlspecialchars($comentario["comentario"])) ?>
                </p>

                <small>
                    <?= htmlspecialchars($comentario["fecha"]) ?>
                </small>

                <form action="cambiar_estado.php" method="POST">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $comentario["id"] ?>"
                    >

                    <button
                        type="submit"
                        name="estado"
                        value="aprobado"
                    >
                        Aprobar
                    </button>

                    <button
                        type="submit"
                        name="estado"
                        value="rechazado"
                    >
                        Rechazar
                    </button>

                </form>

            </article>

            <hr>

        <?php endforeach; ?>

    <?php endif; ?>

    <p>
        <a href="comentarios.php">Ver comentarios publicados</a>
    </p>

    <p>
        <a href="../index.html">Volver a la página principal</a>
    </p>

</body>

</html>