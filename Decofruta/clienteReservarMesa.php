<?php
session_start();
require 'conexion_bd.php';

$message = '';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) { //no definido
    $message = 'Por favor, inicie sesión para agendar una mesa';
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") { //Se verifica si el método de solicitud es POST
        if (!empty($_POST['dateSel']) && !empty($_POST['timeMeet']) && !empty($_POST['eventType']) && !empty($_POST['ctp'])) {
            //Asignar las variables
            $user_id = $_SESSION['user_id'];
            $fecha_evento = $_POST['dateSel'];
            $hora_evento = $_POST['timeMeet'];
            $tipo_evento = $_POST['eventType'];
            $cantidad_personas = $_POST['ctp'];
            $comentario = $_POST['comment'];

            //Validar la fecha de la reserva:
            $currentDate = new DateTime();
            $eventDate = new DateTime($fecha_evento);
            $interval = $currentDate->diff($eventDate);

            // Verificar que la reserva se haga al menos un día antes
            if ($interval->days < 1 || $eventDate < $currentDate) {
                $message = 'Error al realizar la reserva, la reserva debe hacerse al menos un día antes';
            } else {
                try {
                    // Comprobar la disponibilidad de mesas: Se permite un máximo de 2 reservas por día.
                        $sql = "SELECT COUNT(*) as count FROM reservas_especiales WHERE fecha_evento = :fecha_evento";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':fecha_evento', $fecha_evento); //Se vinculan los valores del formulario a los parámetros
                    $stmt->execute(); //ejecuta la consulta
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Permitir solo 2 reservas por día
                    if ($result['count'] >= 2) {
                        $message = 'Error al realizar la reserva, mesas agotadas para la fecha seleccionada';
                    } else {
                        $sql = "INSERT INTO reservas_especiales (id_usuario, fecha_evento, hora_evento, tipo_evento, cantidad_personas, comentario) 
                                VALUES (:id_usuario, :fecha_evento, :hora_evento, :tipo_evento, :cantidad_personas, :comentario)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_usuario', $user_id);
                        $stmt->bindParam(':fecha_evento', $fecha_evento);
                        $stmt->bindParam(':hora_evento', $hora_evento);
                        $stmt->bindParam(':tipo_evento', $tipo_evento);
                        $stmt->bindParam(':cantidad_personas', $cantidad_personas);
                        $stmt->bindParam(':comentario', $comentario);

                        if ($stmt->execute()) {
                            $message = 'Reserva realizada con éxito';
                        } else {
                            $message = 'Error al realizar la reserva';
                        }
                    }
            } catch (PDOException $e) {
                    $message = 'Error en la base de datos';
                    exit; 
                } finally {
                    // Cerrar la conexión a la base de datos
                    $conn = null;
                }
            }
        } else {
            $message = 'Por favor, complete todos los campos del formulario';
        }
    }
}
?>

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

        <!-- RESERVAR MESA  -->
        <div class="container" id="contact">

            <?php if (!empty($message)) : ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
                <script>
                    var phpMessage = "<?php echo $message; ?>";
                </script>
            <?php else : ?>
                <script>
                    var phpMessage = "";
                </script>
            <?php endif; ?>

            <h1>RESERVAR MESA</h1>
            <div class="row" style="margin-top:50px;">
                <!--Bootstrap 6/12 | padding (relleno) de 1 rem (16 píxeles) | "py-md-0": Elimina el espacio vertical (padding) en dispositivos de tamaño mediano (md) y superiores.-->
                <div class="col-md-6 py-3 py-md-0">
                    <form method="POST" id="reserveForm">
                        <div class="form-group">
                            <input type="date" id="dateSel" name="dateSel" class="form-control" placeholder="Ingresar fecha de la reunión">
                        </div>
                        <div class="form-group">
                            <input type="time" id="timeMeet" name="timeMeet" class="form-control" min="08:30" max="21:00" placeholder="Ingresar hora de la reunión">
                        </div>
                        <div class="form-group">
                            <select id="eventType" name="eventType" class="form-control">
                                <option value="">Seleccione el tipo de evento</option>
                                <option value="Cumpleaños">Cumpleaños</option>
                                <option value="Reunión de amigos">Reunión de amigos</option>
                                <option value="Cena familiar">Cena familiar</option>
                                <option value="Boda">Boda</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="ctp" name="ctp" placeholder="Ingrese cantidad de personas" min="2" max="16">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="7" id="comment" name="comment" placeholder="Mensaje"></textarea>
                        </div>
                        <button type="submit" id="messagebtn">Enviar mensaje</button>
                    </form>

                </div>

                <div class="col-md-6 py-3 py-md-0">
                    <div class="card h-100">
                        <!--Bootstrap para que ocupe el 100% de la altura de su contenedor principal-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15894.366404788012!2d-80.6283567!3d-5.1692047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904a112b7894cf4d%3A0x3a0d2bda63366981!2sDecofruta!5e0!3m2!1ses-419!2spe!4v1714083642249!5m2!1ses-419!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>

        </div>

        <?php include 'footer.php'; ?>

    </div>

    <?php include 'mensajeFlotante.php'; ?>
    
    <!--bibliotecas que trabajan con  bootstrap para crear una barra de navegación responsiva con elementos interactivos-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--Bootstrap utiliza jQuery para varias de sus funcionalidades, como el manejo de eventos, animaciones, etc-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap usa Popper.js para garantizar que los elementos se muestren correctamente y de manera interactiva.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Bootstrap JS (bootstrap.min.js): biblioteca de JavaScript oficial de Bootstrap. se encarga de la funcionalidad de los componentes basados en JavaScript, como las barras de navegación responsivas.-->
    <script src="scriptReserve.js"></script>
</body>

</html>