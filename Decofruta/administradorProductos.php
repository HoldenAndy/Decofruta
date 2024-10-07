<?php
require 'conexion_bd.php';

try {
    // Crear Producto
    if (isset($_POST['create'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];
        $categoria = $_POST['categoria'];
        $activo = isset($_POST['activo']) ? (int)$_POST['activo'] : 0; // Convertir a número

        $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, imagen, id_categoria, activo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $imagen, $categoria, $activo]);

        header("Location: administradorProductos.php");
        exit; // Terminar la ejecución después de redireccionar
    }

    // Actualizar Producto
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];
        $categoria = $_POST['categoria'];
        $activo = isset($_POST['activo']) ? (int)$_POST['activo'] : 0; // Convertir a número

        $sql = "UPDATE productos SET nombre_producto = ?, descripcion = ?, precio = ?, imagen = ?, id_categoria = ?, activo = ? WHERE id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $imagen, $categoria, $activo, $id]);

        header("Location: administradorProductos.php");
        exit; // Terminar la ejecución después de redireccionar
    }

    // Eliminar Producto
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];

        $sql = "DELETE FROM productos WHERE id_producto = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: administradorProductos.php");
        exit; // Terminar la ejecución después de redireccionar
    }

    // Leer Productos
    $sql_products = $conn->prepare("SELECT * FROM productos");
    $sql_products->execute();
    $resultado = $sql_products->fetchAll(PDO::FETCH_ASSOC);

    // Leer Categorias
    $sql_categories = $conn->prepare("SELECT id_categoria, nombre_categoria FROM categoria");
    $sql_categories->execute();
    $categorias = $sql_categories->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="mb-4 text-center">Lista de Productos</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Agregar Producto</button>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $row) : ?>
                        <tr>
                            <td><?= $row['id_producto'] ?></td>
                            <td><?= $row['nombre_producto'] ?></td>
                            <td><?= $row['descripcion'] ?></td>
                            <td><?= $row['precio'] ?></td>
                            <td><img src="image/products/<?= $row['imagen'] ?>" alt="<?= $row['nombre_producto'] ?>" width="50" height="50"></td>
                            <td><?= $row['id_categoria'] ?></td>
                            <td><?= $row['activo'] ? 'Sí' : 'No' ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal" data-id="<?= $row['id_producto'] ?>" data-nombre="<?= $row['nombre_producto'] ?>" data-descripcion="<?= $row['descripcion'] ?>" data-precio="<?= $row['precio'] ?>" data-imagen="<?= $row['imagen'] ?>" data-categoria="<?= $row['id_categoria'] ?>" data-activo="<?= $row['activo'] ?>">Editar</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?= $row['id_producto'] ?>">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear Producto -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Agregar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen" required accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <?php
                                    foreach ($categorias as $categoria) {
                                        echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre_categoria'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="activo">Activo</label>
                                <select class="form-control" id="activo" name="activo" required>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" name="create">Guardar</button>
                            </div>
                        </form>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <!-- Modal Actualizar Producto -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_update" name="id">
                        <div class="form-group">
                            <label for="nombre_update">Nombre</label>
                            <input type="text" class="form-control" id="nombre_update" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion_update">Descripción</label>
                            <textarea class="form-control" id="descripcion_update" name="descripcion" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio_update">Precio</label>
                            <input type="number" class="form-control" id="precio_update" name="precio" required>
                        </div>
                        <div class="form-group">
                            <label for="imagen_update">Imagen</label>
                            <input type="file" class="form-control-file" id="imagen_file_update" name="imagen_file" accept="image/*">
                            <input type="text" class="form-control" id="imagen_update" name="imagen" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="categoria_update">Categoría</label>
                            <select class="form-control" id="categoria_update" name="categoria" required>
                                <?php
                                foreach ($categorias as $categoria) {
                                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre_categoria'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activo_update">Activo</label>
                            <select class="form-control" id="activo_update" name="activo" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="update">Guardar Cambios</button>
                        </div>
                    </div>

                </form>
            </div>
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
                    ¿Estás seguro de que deseas eliminar este producto?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="" id="deleteForm">
                        <input type="hidden" name="delete" id="deleteId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap y jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para cargar datos en el modal de actualización -->
    <script>
        $('#updateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var descripcion = button.data('descripcion');
            var precio = button.data('precio');
            var imagen = button.data('imagen');
            var categoria = button.data('categoria');
            var activo = button.data('activo');

            var modal = $(this);
            modal.find('.modal-body #id_update').val(id);
            modal.find('.modal-body #nombre_update').val(nombre);
            modal.find('.modal-body #descripcion_update').val(descripcion);
            modal.find('.modal-body #precio_update').val(precio);
            modal.find('.modal-body #imagen_update').val(imagen);
            modal.find('.modal-body #categoria_update').val(categoria);
            modal.find('.modal-body #activo_update').val(activo);

            modal.find('.modal-body #imagen_file_update').val('');
            modal.find('#imagen_file_update').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $('#imagen_update').val(fileName);
                } else {
                    $('#imagen_update').val(imagen);
                }
            });
        });

        $('#confirmDeleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            console.log(id);
            var modal = $(this);
            modal.find('#deleteId').val(id);
        });
    </script>
</body>

</html>