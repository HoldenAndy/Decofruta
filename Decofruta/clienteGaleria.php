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

        <!-- GALERÍA-->
        <section id="gallary">
            <div class="container">
                <h1 style="margin-top: 30px;">GALERÍA</h1>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <!--Bootstrap 3/12 | padding (relleno) de 1 rem (16 píxeles) | "py-md-0": Elimina el espacio vertical (padding) en dispositivos de tamaño mediano (md) y superiores.-->
                        <div class="card">
                            <img src="./image/galeria5.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria16.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <p class="TextoGrande san-valentin">SAN VALENTÍN</p>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <p class="TextoGrande dia-de-la-madre">DIA DE LA MADRE</p>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria3.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria15.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria6.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria8.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria11.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/galeria2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <p class="TextoGrande cumpleaños">CUMPLEAÑOS</p>
                    </div>
                </div>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <p class="TextoGrande navidad">NAVIDAD</p>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/navidad1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/navidad2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="./image/navidad3.jpg" alt="">
                        </div>
                    </div>
                </div>
        </section>

        <!-- FOOTER -->
        <?php include 'footer.php'; ?>

        <!--bibliotecas que trabajan con  bootstrap para crear una barra de navegación responsiva con elementos interactivos-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <!--Bootstrap utiliza jQuery para varias de sus funcionalidades, como el manejo de eventos, animaciones, etc-->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <!-- Bootstrap usa Popper.js para garantizar que los elementos se muestren correctamente y de manera interactiva.-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!--Bootstrap JS (bootstrap.min.js): biblioteca de JavaScript oficial de Bootstrap. se encarga de la funcionalidad de los componentes basados en JavaScript, como las barras de navegación responsivas.-->


    </div>

</body>

</html>