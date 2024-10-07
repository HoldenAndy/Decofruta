<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decofruta</title>
    <link rel="shortcut icon" type="image" href="./image/logo.png">
    <link rel="stylesheet" href="styles.css">
    <!-- bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- icons links -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="all-content">
        <!-- Header -->
        <?php include 'clienteHeader.php'; ?>

        <!--CARRUSEL-->
        <div id="carouselExampleControls" class="carousel slide custom-carousel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="image/carrusel1.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Decofruta detalles que enamoran</h3>
                        <p>Somos un concepto original y saludable para regalar en cualquier
                            ocasión, incluso para decorar las mesas en tus celebraciones.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="image/carrusel2.jpg" alt="Second slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Decofruta detalles que enamoran</h3>
                        <p> Descubre nuestras irresistibles creaciones originales y saludables, diseñadas para
                            sorprender en cada ocasión y deleitar hasta el último bocado
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="image/carrusel3.png" alt="Third slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Decofruta detalles que enamoran</h3>
                        <p> Somos tu opción saludable y original para regalar en cualquier ocasión. Añade un toque de
                            sabor y estilo a tus celebraciones con nuestras deliciosas creaciones.
                        </p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- IMÁGENES CON OPCIONES -->
        <div class="container" id="box"> <!--Contenedor de Bootstrap-->
            <div class="row"> <!--Fila el contedor-->
                <div class="col-md-4 py-3 py-md-0">
                    <!--Bootstrap 4/12 | padding (relleno) de 1 rem (16 píxeles) | "py-md-0": Elimina el espacio vertical (padding) en dispositivos de tamaño mediano (md) y superiores.-->
                    <div class="card"> <!--card tarjetas en bootstrap-->
                        <img src="./image/box1.jpg" alt="">
                        <a href="clienteProductos.php#detallesPersonalizados" class="btn">Detalles Personalizados</a>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img src="./image/box2.jpg" alt="">
                        <a href="clienteProductos.php#platosCarta" class="btn">Platos a la Carta</a>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img src="./image/box3.jpg" alt="">
                        <a href="clienteReservarMesa.php" class="btn">Reservar Mesa</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include 'footer.php'; ?>

    </div>

    <!-- Modal de Cookies -->
    <div class="modal fade" id="cookiesModal" tabindex="-1" role="dialog" aria-labelledby="cookiesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookiesModalLabel">Utilizamos Cookies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Usamos cookies para mejorar su experiencia de navegación en nuestra web, para mostrarle contenidos
                    personalizados y para analizar el tráfico en nuestra web. <a href="#cookiesPolicyModal" data-toggle="modal" data-dismiss="modal" style="text-decoration: underline;">Ver política de
                        cookies</a>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Rechazar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Política de Cookies -->
    <div class="modal fade" id="cookiesPolicyModal" tabindex="-1" role="dialog" aria-labelledby="cookiesPolicyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookiesPolicyModalLabel">Política de Cookies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">

                    <p>En Decofruta, utilizamos cookies para mejorar su experiencia en nuestro sitio web y para
                        personalizar el contenido que se muestra. Al continuar utilizando nuestro sitio, usted acepta el
                        uso de cookies de acuerdo con esta política.</p>
                    <p>Utilizamos cookies para:</p>
                    <ul>
                        <li><strong>Mejorar la funcionalidad:</strong> Utilizamos cookies para asegurarnos de que
                            nuestro sitio web funcione correctamente y para proporcionarle funciones y servicios
                            esenciales, como la navegación por el sitio y el acceso a áreas seguras.</li>
                        <li><strong>Analizar el uso del sitio:</strong> Utilizamos cookies para entender cómo los
                            visitantes interactúan con nuestro sitio web, qué páginas visitan y cuánto tiempo pasan en
                            cada página. Esto nos ayuda a mejorar el diseño y el contenido del sitio para adaptarlo
                            mejor a las necesidades de nuestros usuarios.</li>
                        <li><strong>Personalizar la experiencia:</strong> Utilizamos cookies para personalizar el
                            contenido y los anuncios que se muestran en nuestro sitio web, de modo que sean más
                            relevantes para usted.</li>
                    </ul>
                    <p>Al utilizar nuestro sitio web, usted acepta el uso de cookies de acuerdo con esta política. Si
                        decide no aceptar nuestras cookies, es posible que algunas partes de nuestro sitio web no
                        funcionen correctamente.</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Rechazar</button>
            </div>
        </div>
    </div>

    </div>


    </div>


    <!--bibliotecas que trabajan con  bootstrap para crear una barra de navegación responsiva con elementos interactivos-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Script para mostrar automáticamente el modal de cookies al cargar la página -->
    <script>
        $(document).ready(function() {
            $('#cookiesModal').modal('show');
        });
    </script>

</body>

</html>