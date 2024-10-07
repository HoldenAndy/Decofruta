<header class="header">
    <nav class="navbar navbar-expand-md" id="navbar"> <!--clase de Bootstrap barra de navegación-->
        <a class="navbar-brand" href="clienteInicio.php" id="logo"><img src="./image/logoNav.png" alt="" width="100">Decofruta
            Piura</a>
        <!-- boton de hamburguesa Bootstrap-->
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

        <div class="icons">
            <a href="acceso.php"><i class='bx bxs-user-plus width="25px'></i></a>
            <a href="logout.php"><i class='bx bx-log-out-circle'></i></a>
        </div>

    </nav>
</header>