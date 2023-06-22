<?php
include 'confimarcion_autenticacion.php';
?>
<!DOCTYPE html>
<html>
    <html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Panel de Empleado</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!--Iconos footer-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!-- JavaScript de jQuery, Bootstrap y DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS personalizado -->
    <link rel='stylesheet' type='text/css' media='screen' href="css/style.css">
<div id="logo">
    <img src="img/1.jpg" alt="Imagen 1" class="img-fluid">
</div>
<body>
<div class="container_stock">
    <div class="menu_stock">
	<h1>PANEL DE EMPLEADO</h1>
	<a href="producto.php" class="btn">Productos</a>
	<a href="stock.php" class="btn">Stock</a>
	<a href="venta.php" class="btn">Venta</a>
	<a href="empleado.php" class="btn">Empleados</a>
	<a href="cliente.php" class="btn">Clientes</a>
    </div>
</div>
<div class="container_stock mt-4">
    <a href="logout.php" class="btn logout">Cerrar sesión</a>
</div>
</body>
    <script>
        $(document).ready(function() {
            $('#tablaClientes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>
</html>