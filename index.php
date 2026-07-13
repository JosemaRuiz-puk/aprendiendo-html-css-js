<?php

require_once __DIR__ . "/api/conexion.php";

$sql = "SELECT cita, libro, personaje
        FROM citas_pratchett
        ORDER BY RAND()
        LIMIT 1";

$sentencia = $conexion->prepare($sql);
$sentencia->execute();

$citaPratchett = $sentencia->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Web personal de Josutpuk para aprender HTML, CSS, JavaScript, PHP y bases de datos"
    >

    <meta name="author" content="Josutpuk">

    <title>Aprendiendo a hacer una web</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header>

        <h1 class="portada">Un clásico: ¡HOLA MUNDO!</h1>

        <h2>Bienvenido a la web de aprendizaje de Josutpuk</h2>

        <h3>Estamos trabajando en ello...</h3>

        <p class="imagen-centro">
            <img
                src="imagen.png"
                alt="Una imagen cualquiera hecha por inteligencia artificial"
                width="300"
                height="180"
            >
        </p>

        <h3>
            Un rincón personal para aprender, experimentar y compartir.
        </h3>

        <section class="tiempo-contenedor">
            <p id="saludoTiempo">Consultando el tiempo...</p>
            <p id="datosTiempo"></p>
        </section>

        <nav>
            <ul>
                <li>
                    <a href="https://www.iesjuanbosco.es/" target="_blank">
                        Mi alma mater
                    </a>
                </li>

                <li>
                    <a href="cosmere.html">
                        Libros del Cosmere que he leído
                    </a>
                </li>

                <li>
                    <a href="sombrero.html">
                        Lista candidatos a Sombrero de Paja
                    </a>
                </li>

                <li>
                    <a href="hamburguesas.html">
                        Lista de hamburguesas
                    </a>
                </li>

                <li>
                    <a href="objetivos.html">
                        Objetivos alcanzados
                    </a>
                </li>

                <li>
                    <a href="visita.html">
                        Deja un comentario
                    </a>
                </li>
            </ul>
        </nav>

    </header>

    <main>

        <section>

            <h2 id="titulo">Sobre este proyecto</h2>

            <p>
                Esta web nació con una idea muy sencilla: aprender haciendo.
                En lugar de limitarme a realizar ejercicios que acaban olvidados
                en una carpeta del ordenador, decidí crear una página web real
                e ir ampliándola poco a poco.
            </p>

            <p>
                Cada vez que aprendo algo nuevo intento encontrar la forma de
                aplicarlo aquí, aunque sea mediante una pequeña mejora o una
                nueva funcionalidad.
            </p>

            <p>
                También considero esta web una especie de
                <strong>cajón de sastre</strong>. Aquí tienen cabida muchas de
                las cosas que me gustan o me llaman la atención: libros,
                videojuegos, curiosidades, proyectos personales o cualquier
                idea que me apetezca compartir.
            </p>

            <p>
                No pretende centrarse en un único tema, sino ser un espacio
                personal que pueda crecer en cualquier dirección conforme yo
                también vaya aprendiendo.
            </p>

            <p>
                La web está en constante evolución y probablemente nunca pueda
                decir que está completamente terminada. Siempre habrá algo
                nuevo que añadir, mejorar o aprender.
            </p>

            <p>
                Puedes consultar un resumen de los objetivos que he ido
                consiguiendo durante la creación de esta web
                <a href="objetivos.html">aquí</a>.
            </p>

            <p>
                También puedes ver el código fuente del proyecto en mi
                <a
                    href="https://github.com/JosemaRuiz-puk/aprendiendo-html-css-js"
                    target="_blank"
                >
                    repositorio de GitHub
                </a>.
            </p>

        </section>

        <section class="cita-pratchett">

            <h2>Cita aleatoria de Terry Pratchett</h2>

            <?php if ($citaPratchett): ?>

                <blockquote>
                    <?= nl2br(htmlspecialchars($citaPratchett["cita"])) ?>
                </blockquote>

                <p>

                    <?php if (
                        !empty($citaPratchett["personaje"]) &&
                        $citaPratchett["personaje"] !== "Narrador"
                    ): ?>

                        <strong>
                            <?= htmlspecialchars($citaPratchett["personaje"]) ?>
                        </strong>

                        —

                    <?php endif; ?>

                    <em>
                        <?= htmlspecialchars($citaPratchett["libro"]) ?>
                    </em>

                </p>

                <p>Terry Pratchett</p>

            <?php else: ?>

                <p>No se ha podido cargar ninguna cita.</p>

            <?php endif; ?>

        </section>

        <div class="reloj-contenedor">
            <p>Ahora mismo son las:</p>
            <p id="reloj">00:00:00</p>
            <p id="fecha"></p>
        </div>

    </main>

    <button id="modoOscuro">🌙 Modo oscuro</button>

    <button id="saludar">¡Púlsame!</button>

    <p id="contadorTexto"></p>

    <p id="mensaje" hidden>
        Qué obediente, has pulsado el botón. Gracias, bebé 😊
    </p>

    <footer>
        <p>Web creada por Josutpuk.</p>
        <p>
            Proyecto de aprendizaje de HTML, CSS, JavaScript, PHP y bases de datos.
        </p>
    </footer>

    <script src="script.js"></script>

</body>

</html>