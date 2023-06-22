<?php
include 'confimarcion_autenticacion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Stock</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!--Iconos footer y menú-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!-- JavaScript de jQuery, Bootstrap y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS personalizado -->
    <link rel='stylesheet' type='text/css' media='screen' href="css/style.css">
</head>
<body>
    <!-- Se genera un menú para los diferentes formularios-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php">
                            <i class="bi bi-house-door-fill text-white" style="font-size: 1.7rem; margin-right: 40px;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="producto.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="venta.php">Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="empleado.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="logo">
    <img src="img/1.jpg" alt="Imagen 1" class="img-fluid">
    </div>
    <div class="container_stock">
        <div class="menu_stock">
            <h1>GESTIÓN STOCK</h1>
            <a href="lista_stock_tienda.php">Stock Tiendas</a>
            <a href="lista_stock_almacen.php">Stock Almacenes</a>
            <a href="cambio_stock.php">Mover Stock</a>
            <a href="agregar_stock_almacen.php">Agregar Stock a Almacenes</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#stock').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>
<footer class="bg-light p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Encuéntranos en:</h5>
                <p><i class="bi bi-geo-alt-fill me-2"></i>Gran Vía, 7, Madird, España</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5>Sitio Web:</h5>
                <a href="https://www.google.com"><i class="bi bi-globe2"></i> Discos Para Todos</a>
            </div>
        </div>
    </div>
</footer>
</html>