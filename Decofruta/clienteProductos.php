<?php
session_start();
require 'conexion_bd.php';

try {
    // Obtener productos activos
    $sql_products = $conn->prepare("SELECT * FROM productos WHERE activo = 1");
    $sql_products->execute();
    $resultado = $sql_products->fetchAll(PDO::FETCH_ASSOC);

    $message = '';

    // Gestionar la compra solo si se trata de una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json'); //tipo de contenido de la respuesta como JSON.
        if (isset($_SESSION['user_id'])) {
            $data = json_decode(file_get_contents('php://input'), true);//Se decodifica el cuerpo de la solicitud JSON en un array asociativo.

            if (!isset($data['productos']) || !is_array($data['productos'])) {
                $message = 'No se enviaron productos válidos para la compra';
                echo json_encode(['message' => $message]);
                exit;
            } else {
                $user_id = $_SESSION['user_id'];
                $productos = $data['productos'];

                foreach ($productos as $producto) {
                    if (!isset($producto['cantidad']) || !isset($producto['id_producto'])) {
                        continue; // Salta a la siguiente iteración si los datos no son válidos
                    }

                    $cantidad = $producto['cantidad'];
                    $id_producto = $producto['id_producto'];

                    $sql = "INSERT INTO compras_productos (cantidad, id_usuario, id_producto) VALUES (:cantidad, :id_usuario, :id_producto)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':cantidad', $cantidad);
                    $stmt->bindParam(':id_usuario', $user_id);
                    $stmt->bindParam(':id_producto', $id_producto);
                    $stmt->execute();
                }
                $message = 'Compra realizada con éxito';
                echo json_encode(['message' => $message]);
                exit;
            }
        }
    }
} catch (PDOException $e) {
    // Manejo de errores
    $message = 'Error en la base de datos';
    echo json_encode(['message' => $message]);
    exit;
} finally {
    // Cerrar la conexión
    $conn = null;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="all-content">
        <!-- NAVEGACIÓN -->
        <header class="header">
            <nav class="navbar navbar-expand-md" id="navbar">
                <a class="navbar-brand" href="clienteInicio.php" id="logo"><img src="./image/logoNav.png" alt="" width="100">Decofruta Piura</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span><img src="./image/menu.png" alt="" width="30px"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <!--collapse y navbar-collapse son clases de Bootstrap para diseñar elementos colapsables dentro de una barra de navegación-->
                    <ul class="navbar-nav">


                        <li class="nav-item">
                            <a class="nav-link" href="clienteInicio.php">Inicio</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="clienteProductos.php" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                                <!--Bootstrap  activa el comportamiento del menú-->
                                Productos
                            </a>
                            <div class="dropdown-menu"> <!--Bootstrap Elementos del menú desplegable-->
                                <a href="clienteProductos.php#1" class="dropdown-item">Detalles
                                    Personalizados</a>
                                <a href="clienteProductos.php#2" class="dropdown-item">Cumpleaños</a>
                                <a href="clienteProductos.php#3" class="dropdown-item">Platos a la carta</a>
                                <a href="clienteProductos.php#4" class="dropdown-item">¡Los más pedidos!</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="clienteGaleria.php">Galeria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clienteNosotros.php">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clienteReservarMesa.php">Reservar Mesa</a>
                        </li>

                    </ul>
                </div>
                
                <!---Carrito de compras-->
                <div class="container-icon">
                    <div class="container-cart-icon">
                        <div class="icons">
                            <a href="acceso.php"><i class='bx bxs-user-plus'></i></a>
                            <a href="logout.php"><i class='bx bx-log-out-circle'></i></a>
                            <i class='bx bxs-cart-alt'></i>
                        </div>
                        <div class="count-products"><span id="contador-productos">0</span></div>
                    </div>
                    <div class="container-cart-products hidden-cart">
                        <div class="row-product hidden">
                            <div class="cart-product">
                                <div class="info-cart-product">
                                    <h6 class="cantidad-producto-carrito"></h6>
                                    <h3 class="titulo-producto-carrito"></h3>
                                    <h6 class="precio-producto-carrito"></h6>
                                </div>
                                <i class='bx bx-x-circle'></i>
                            </div>
                        </div>
                        <div class="cart-total hidden">
                            <h3 class="total-pagar"></h3>
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <button id="btn-pay">Pagar</button>
                            <?php else : ?>
                                <p>Por favor, inicie sesión para continuar con la compra</p>
                            <?php endif; ?>
                        </div>
                        <p class="cart-empty">El carrito está vacío</p>
                    </div>
                </div>
            </nav>
        </header>

        <!-- SECCIÓN PRODUCTOS -->
        <section id="product-cards">
            <?php
            $categories = [
                1 => 'Detalles Personalizados',
                2 => 'Cumpleaños',
                3 => 'Platos a la carta',
                4 => '¡Los más pedidos!'
            ];
            foreach ($categories as $category_id => $category_name) {
                echo "<div class='container' id='{$category_id}'>
                    <h1>{$category_name}</h1>
                    <div class='row'>";
                foreach ($resultado as $row) {
                    if ($row['id_categoria'] == $category_id) {
                        $bdImg = $row['imagen'];
                        $img = "./image/products/$bdImg";
                        if (!file_exists($img)) {
                            $img = "./image/logo.png";
                        }
                        echo "<div class='content col-md-4 py-3 py-md-0'>
                            <div class='card' data-product-id={$row['id_producto']}; ?>
                                <img src='{$img}' alt=''>
                                <div class='card-body'>
                                    <h3>{$row['nombre_producto']}</h3>
                                    <p>{$row['descripcion']}</p>
                                    <h6>S/{$row['precio']}</h6>
                                    <button class='btn-add-cart'>Agregar</button>
                                </div>
                            </div>
                        </div>";
                    }
                }
                echo "</div></div>";
            }
            ?>
        </section>
        <!-- FIN SECCIÓN PRODUCTOS -->

        <!---Formulario Pago-->
        <div id="formulario-pago-container" class="hidden">
            <div class="formulario-pago-content">
                <div class="formulario-section">
                    <h2>Métodos de Entrega</h2>
                    <label for="opcion-entrega">Opción de entrega:</label>
                    <select id="opcion-entrega" name="opcion-entrega">
                        <option value="recojo">Recojo en tienda</option>
                        <option value="despacho">Despacho a domicilio</option>
                    </select>
                    <div id="campos-recojo" class="hidden">
                        <label for="fecha-recojo">Fecha de recojo:</label>
                        <input type="date" id="fecha-recojo" name="fecha-recojo">
                    </div>
                    <div id="campos-despacho" class="hidden">
                        <label for="telefono-despacho">Teléfono:</label>
                        <input type="text" id="telefono-despacho" name="telefono-despacho">
                        <label for="direccion-despacho">Dirección:</label>
                        <input type="text" id="direccion-despacho" name="direccion-despacho">
                        <label for="referencia-despacho">Referencia:</label>
                        <input type="text" id="referencia-despacho" name="referencia-despacho">
                    </div>
                    <div class="form-buttons">
                        <button id="btn-continuar">Continuar</button>
                        <button id="btn-cancelar">Cancelar</button>
                    </div>
                </div>
                <div class="productos-section">
                    <h2>Productos Seleccionados</h2>
                    <div id="productos-seleccionados"></div>
                    <div id="precio-total"></div>
                </div>
            </div>
        </div>

        <!-- Método de pago por tarjeta de crédito -->
        <div id="metodo-pago-tarjeta" class="hidden">
            <div class="metodo-pago-content">
                <h2>Ingresa los datos de tu tarjeta</h2>
                <form id="form-tarjeta" method="POST">
                <div class="form-group">
                    <label for="cardNumber">Número de tarjeta</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="cardNumber" placeholder="Número de tarjeta">
                    </div>
                </div>
                <div class="form-group">
                    <label for="expiryMonth">Mes de vencimiento</label>
                    <select class="form-control" id="expiryMonth">
                        <option value="" disabled selected>Mes de vencimiento</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expiryYear">Año de vencimiento</label>
                    <select class="form-control" id="expiryYear">
                        <option value="" disabled selected>Año de vencimiento</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="cvv" placeholder="CVV">
                    </div>
                </div>
                    <button type="submit" id="btn-finalizar-compra">Finalizar Compra</button>
                    <button type="button" id="btn-cerrar-tarjeta">Cerrar</button>
                </form>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include 'footer.php'; ?>

    </div>

    <?php include 'mensajeFlotante.php'; ?>
    

    <!--bibliotecas que trabajan con  bootstrap para crear una barra de navegación responsiva con elementos interactivos-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="scriptBuys.js"></script>
</body>

</html>