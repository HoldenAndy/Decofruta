<?php
try {
    require 'conexion_bd.php';

    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d');

    // Consulta para obtener las reservas desde hoy en adelante
    $sql_reservas = "SELECT r.id, u.nombre, r.fecha_evento, r.hora_evento, r.tipo_evento, r.cantidad_personas, r.atendido, r.comentario 
        FROM reservas_especiales r
        JOIN usuarios u ON r.id_usuario = u.id_usuario
        WHERE r.fecha_evento >= ?
        ORDER BY r.fecha_evento ASC";
    $stmt = $conn->prepare($sql_reservas); //preparando la consulta
    $stmt->execute([$fecha_actual]); //ejecutando la consulta con la fecha actual
    $reservas_futuras = $stmt->fetchAll(PDO::FETCH_ASSOC); //obtiene la fila de los resultados

    // Consulta para obtener las reservas anteriores a hoy
    $sql_historial = "SELECT r.id, u.nombre, r.fecha_evento, r.hora_evento, r.tipo_evento, r.cantidad_personas, r.atendido, r.comentario 
        FROM reservas_especiales r
        JOIN usuarios u ON r.id_usuario = u.id_usuario
        WHERE r.fecha_evento < ?
        ORDER BY r.fecha_evento DESC";
    $stmt_historial = $conn->prepare($sql_historial);
    $stmt_historial->execute([$fecha_actual]);
    $reservas_historial = $stmt_historial->fetchAll(PDO::FETCH_ASSOC);

    $tipo_evento = '';
} catch (PDOException $e) {
    // Manejar el error
    die('Error en la base de datos: ' . $e->getMessage());
} finally {
    // Cerrar la conexión después de usarla
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decofruta Administrador</title>
    <link rel="shortcut icon" type="image" href="./image/logoAdmin.png">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <!-- Header -->
    <?php include 'administradorHeader.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Reservas de Mesas</h2>

        <!-- Botón para mostrar el historial -->
        <button id="btnHistorial" class="btn btn-secondary mb-4">Historial de Mesas</button>

        <!-- Tabla para reservas desde hoy en adelante -->
        <div id="reservas_futuras" class="container mt-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Usuario</th>
                            <th>Fecha del Evento</th>
                            <th>Hora del Evento</th>
                            <th>Tipo de Evento</th>
                            <th>Cantidad de Personas</th>
                            <th>Atendido</th>
                            <th>Comentario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas_futuras as $reserva) : ?>
                            <tr>
                                <td><?= htmlspecialchars($reserva['id']) ?></td>
                                <td><?= htmlspecialchars($reserva['nombre']) ?></td>
                                <td><?= htmlspecialchars($reserva['fecha_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['hora_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['tipo_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['cantidad_personas']) ?></td>
                                <td><?= htmlspecialchars($reserva['atendido'] ? 'Sí' : 'No') ?></td>
                                <td><?= htmlspecialchars($reserva['comentario']) ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?= $reserva['id'] ?>">Eliminar</button>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $reserva['id'] ?>" data-nombre="<?= $reserva['nombre'] ?>" data-fecha="<?= $reserva['fecha_evento'] ?>" data-hora="<?= $reserva['hora_evento'] ?>" data-tipo="<?= $reserva['tipo_evento'] ?>" data-cantidad="<?= $reserva['cantidad_personas'] ?>" data-comentario="<?= $reserva['comentario'] ?>" data-atendido="<?= $reserva['atendido'] ?>">Editar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sección para el historial de reservas, inicialmente oculta -->
        <div id="historial" class="container mt-5" style="display:none;">
            <h3 class="mb-4 text-center">Historial de Reservas</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Usuario</th>
                            <th>Fecha del Evento</th>
                            <th>Hora del Evento</th>
                            <th>Tipo de Evento</th>
                            <th>Cantidad de Personas</th>
                            <th>Atendido</th>
                            <th>Comentario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas_historial as $reserva) : ?>
                            <tr>
                                <td><?= htmlspecialchars($reserva['id']) ?></td>
                                <td><?= htmlspecialchars($reserva['nombre']) ?></td>
                                <td><?= htmlspecialchars($reserva['fecha_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['hora_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['tipo_evento']) ?></td>
                                <td><?= htmlspecialchars($reserva['cantidad_personas']) ?></td>
                                <td><?= htmlspecialchars($reserva['atendido'] ? 'Sí' : 'No') ?></td>
                                <td><?= htmlspecialchars($reserva['comentario']) ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $reserva['id'] ?>" data-nombre="<?= $reserva['nombre'] ?>" data-fecha="<?= $reserva['fecha_evento'] ?>" data-hora="<?= $reserva['hora_evento'] ?>" data-tipo="<?= $reserva['tipo_evento'] ?>" data-cantidad="<?= $reserva['cantidad_personas'] ?>" data-comentario="<?= $reserva['comentario'] ?>" data-atendido="<?= $reserva['atendido'] ?>">Editar</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?= $reserva['id'] ?>">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Confirmar Eliminación -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar esta reserva?</p>
                        <form id="deleteForm" action="eliminar_reserva.php" method="POST">
                            <input type="hidden" name="id" id="deleteId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Reserva -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="editar_reserva.php">
                        <div class="modal-body">
                            <input type="hidden" id="id_edit" name="id">
                            <div class="form-group">
                                <label for="nombre_edit">Nombre Usuario</label>
                                <input type="text" class="form-control" id="nombre_edit" name="nombre" readonly>
                            </div>
                            <div class="form-group">
                                <label for="fecha_edit">Fecha del Evento</label>
                                <input type="date" class="form-control" id="fecha_edit" name="fecha_evento" required>
                            </div>
                            <div class="form-group">
                                <label for="hora_edit">Hora del Evento</label>
                                <input type="time" class="form-control" id="hora_edit" name="hora_evento" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo_edit">Tipo de Evento</label>
                                <select class="form-control" id="tipo_edit" name="tipo_evento" required>
                                    <option value="Cumpleaños" <?php if ($tipo_evento == 'Cumpleaños') echo 'selected'; ?>>Cumpleaños</option>
                                    <option value="Reunión de amigos" <?php if ($tipo_evento == 'Reunión de amigos') echo 'selected'; ?>>Reunión de amigos</option>
                                    <option value="Cena familiar" <?php if ($tipo_evento == 'Cena familiar') echo 'selected'; ?>>Cena familiar</option>
                                    <option value="Boda" <?php if ($tipo_evento == 'Boda') echo 'selected'; ?>>Boda</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cantidad_edit">Cantidad de Personas</label>
                                <input type="number" class="form-control" id="cantidad_edit" name="cantidad_personas" required>
                            </div>
                            <div class="form-group">
                                <label for="atendido_edit">Atendido</label>
                                <select class="form-control" id="atendido_edit" name="atendido">
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comentario_edit">Comentario</label>
                                <textarea class="form-control" id="comentario_edit" name="comentario"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>


    <!-- jQuery and Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            $('#deleteId').val(id);
        });

        // Script para cargar datos en el modal de actualización
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var fecha = button.data('fecha');
            var hora = button.data('hora');
            var tipo = button.data('tipo');
            var cantidad = button.data('cantidad');
            var comentario = button.data('comentario');
            var atendido = button.data('atendido');

            var modal = $(this);
            modal.find('.modal-body #id_edit').val(id);
            modal.find('.modal-body #nombre_edit').val(nombre);
            modal.find('.modal-body #fecha_edit').val(fecha);
            modal.find('.modal-body #hora_edit').val(hora);
            modal.find('.modal-body #tipo_edit').val(tipo);
            modal.find('.modal-body #cantidad_edit').val(cantidad);
            modal.find('.modal-body #comentario_edit').val(comentario);
            modal.find('.modal-body #atendido_edit').val(atendido);
        });

        // Script para mostrar/ocultar el historial
        $('#btnHistorial').on('click', function() {
            $('#reservas_futuras').toggle();
            $('#historial').toggle();
        });
    </script>
</body>

</html>