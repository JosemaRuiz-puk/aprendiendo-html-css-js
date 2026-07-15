<?php

require_once __DIR__ . "/api/conexion.php";

$sql = "SELECT apodo, tipo_visita, comentario
        FROM comentarios
        WHERE estado = 'aprobado'
        ORDER BY id DESC";

$sentencia = $conexion->query($sql);

$comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulario de la visita">
    <title>Formulario de la visita</title>

    <link type="text/css" rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Formulario de las visitas</h1>

    <p>Déjame un comentario. Valoro positivamente las visitas.</p>

    <?php if (isset($_GET["enviado"])): ?>

        <p>
            <strong>¡Gracias por tu comentario!</strong>
            Se ha enviado correctamente y aparecerá en esta página cuando sea aprobado.
        </p>

    <?php endif; ?>

    <form action="api/guardar_comentario.php" method="POST">

        <fieldset>

            <legend>Dame información sobre ti:</legend>

            <p>
                <label for="apodo">Apodo:</label>
                <input type="text" id="apodo" name="apodo" required>
            </p>

            <p>
                <label for="lugar">Lugar de procedencia:</label>
                <input type="text" id="lugar" name="lugar">
            </p>

            <p>
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad">
            </p>

            <p>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </p>

            <p>
                <label for="tipo">Tipo de visitante:</label>

                <select id="tipo" name="tipo_visita" required>
                    <option value="" selected disabled>
                        -- Elige una opción --
                    </option>
                    <option value="amigo">Amigo</option>
                    <option value="profesor">Profesor</option>
                    <option value="critico">Crítico con mi vida</option>
                    <option value="contratante">Posible contratante</option>
                </select>
            </p>

            <p>
                <label for="comentario">Comentario:</label>
            </p>

            <p>
                <textarea
                    name="comentario"
                    id="comentario"
                    rows="10"
                    cols="50"
                    placeholder="Escribe un comentario constructivo"
                    required></textarea>
            </p>

            <p>¿Cómo has conocido mi web?</p>

            <input type="radio" id="github" name="origen" value="github">
            <label for="github">GitHub</label><br>

            <input type="radio" id="amigo" name="origen" value="amigo">
            <label for="amigo">Un amigo</label><br>

            <input type="radio" id="google" name="origen" value="google">
            <label for="google">Google</label><br>

            <input type="radio" id="otro" name="origen" value="otro">
            <label for="otro">Otro</label>

            <p>¿Qué contenido te interesa?</p>

            <input
                type="checkbox"
                id="cosmere"
                name="intereses[]"
                value="cosmere">
            <label for="cosmere">Cosmere</label><br>

            <input
                type="checkbox"
                id="onepiece"
                name="intereses[]"
                value="onepiece">
            <label for="onepiece">One Piece</label><br>

            <input
                type="checkbox"
                id="programacion"
                name="intereses[]"
                value="programacion">
            <label for="programacion">Programación</label><br>

            <input
                type="checkbox"
                id="hamburguesas"
                name="intereses[]"
                value="hamburguesas">
            <label for="hamburguesas">Hamburguesas</label>

        </fieldset>

        <button type="submit">Enviar</button>

        <button type="reset">
            Borrar las entradas al formulario
        </button>

    </form>

    <hr>

    <section>

        <h2>Comentarios de los visitantes</h2>

        <?php if (empty($comentarios)): ?>

            <p>Todavía no hay comentarios publicados.</p>

        <?php else: ?>

            <?php foreach ($comentarios as $comentario): ?>

                <article>

                    <h3>
                        <?= htmlspecialchars(
                            $comentario["apodo"],
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>
                    </h3>

                    <p>
                        <strong>Tipo de visitante:</strong>

                        <?= htmlspecialchars(
                            ucfirst($comentario["tipo_visita"]),
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>
                    </p>

                    <p>
                        <?= nl2br(
                            htmlspecialchars(
                                $comentario["comentario"],
                                ENT_QUOTES,
                                "UTF-8"
                            )
                        ) ?>
                    </p>

                </article>

                <hr>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

    <p>
        <a href="index.php">Volver a la página principal</a>
    </p>

</body>

</html>