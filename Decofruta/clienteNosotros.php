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

        <!-- NOSOTROS  -->
        <div class="container" id="about" style="text-align: center;">
            <div class="row" style="margin-top:50px;">
                <div class="col-md-6 py-3 py-md-0">
                    <img src="image/NosotrosDecofruta.jpg" alt="" height="580" width="550" class="rounded-image">
                </div>
                <div class="col-md-6 py-3 py-md-0">
                    <br><br>
                    <h1>¡SOMOS DECOFRUTA!</h1>
                    <hr>
                    <p>"Desde 2018, hemos llevado detalles frutales y florales a sus hogares, y en 2021 nos
                        convertimos en pioneros al abrir nuestro acogedor establecimiento en Piura. En Decofruta,
                        nos enorgullece ser reconocidos como una marca innovadora que va más allá de lo
                        convencional. Nuestra pasión por la innovación se refleja en cada detalle de nuestros
                        productos, diseñados para sorprender y encantar a todos. Nos esforzamos por crear
                        experiencias únicas y memorables, donde cada regalo se convierte en una expresión de amor,
                        gratitud o celebración. Desde nuestras incomparables fresas con chocolate hasta los más
                        deliciosos churros y otros exquisitos platillos, todo está pensado exclusivamente para
                        ustedes. Nos complace ser una opción atractiva para nuestros clientes, quienes valoran la
                        originalidad, la calidad y el cuidado que ponemos en cada uno de nuestros productos. Al
                        unirte a la familia Decofruta, te invitamos a descubrir un mundo de emociones y sabores,
                        donde cada regalo es una experiencia verdaderamente especial. ¡Bienvenidos a Decofruta,
                        donde la innovación y la excelencia van de la mano!"</p>
                </div>
            </div>
        </div>

        <!-- MISION  -->
        <div class="container" id="about">
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-6 order-md-2 py-3 py-md-0" style="text-align: right;">
                    <!-- Bootstrap 6/12 | padding (relleno) de 1 rem (16 píxeles) | "py-md-0": Elimina el espacio vertical (padding) en dispositivos de tamaño mediano (md) y superiores. | order-md-2: Cambia el orden de la columna en dispositivos medianos (md) y superiores para que esta columna aparezca en segundo lugar. -->
                    <img src="image/MisionDecofruta.jpg" alt="" height="580" class="rounded-image">
                </div>
                <div class="col-md-6 order-md-1 py-3 py-md-0" style="text-align: center;">
                    <br><br><br><br>
                    <h1>¡NUESTRA MISIÓN!</h1>
                    <hr style="margin-top: 20px;"> <!-- Agregamos el <hr> con un margen superior -->
                    <p>
                        "Nuestra misión en Decofruta es garantizar la máxima satisfacción en cada uno de nuestros
                        productos y servicios. Nos esforzamos por superar las expectativas de nuestros clientes en cada
                        interacción, brindando experiencias excepcionales que perduren en el tiempo. ¿Cómo lo logramos?
                        Utilizando ingredientes de primera calidad, cuidadosamente seleccionados para ofrecer el mejor
                        sabor y frescura en cada bocado. Además, nos comprometemos a proporcionar la máxima comodidad en
                        nuestro establecimiento, creando un ambiente acogedor y amigable donde todos se sientan
                        bienvenidos. En Decofruta, llevamos siempre la mentalidad de lo mejor para nuestros clientes,
                        buscando continuamente formas de mejorar y enriquecer sus vidas a través de nuestros productos y
                        servicios. ¡Estamos aquí para hacer que cada experiencia sea extraordinaria y memorable!"
                    </p>
                </div>
            </div>
        </div>

        <!-- VISION  -->
        <div class="container" id="about" style="text-align: center;">
            <div class="row" style="margin-top:50px;">
                <div class="col-md-6 py-3 py-md-0">
                    <img src="image/VisionDecofruta.jpg" alt="" height="580" width="550" class="rounded-image">
                </div>
                <div class="col-md-6 py-3 py-md-0">
                    <br><br><br><br><br><br>
                    <h1>¡NUESTRA VISIÓN!</h1>
                    <hr>
                    <p>"Nos proyectamos a consolidarnos como una marca líder a largo plazo, aspirando a establecer una
                        cadena de establecimientos. Iniciaremos este camino en la localidad de Piura y sus distritos,
                        expandiendo nuestra innovadora idea de negocio. Nos enfocaremos principalmente en el norte del
                        país, llevando nuestros productos y servicios a más personas y comunidades. ¡Aspiramos a ser el
                        referente de calidad y excelencia en nuestra región y más allá!"</p>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include 'footer.php'; ?>

    </div>

    <!--bibliotecas que trabajan con  bootstrap para crear una barra de navegación responsiva con elementos interactivos-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--Bootstrap utiliza jQuery para varias de sus funcionalidades, como el manejo de eventos, animaciones, etc-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap usa Popper.js para garantizar que los elementos se muestren correctamente y de manera interactiva.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap JS (bootstrap.min.js): biblioteca de JavaScript oficial de Bootstrap. se encarga de la funcionalidad de los componentes basados en JavaScript, como las barras de navegación responsivas.-->

</body>

</html>