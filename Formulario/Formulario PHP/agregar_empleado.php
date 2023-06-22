<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Nuevo Empleado</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Icono de la casa en el menú-->
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
                        <a class="nav-link" href="venta.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="venta.php">Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="empleado.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<h1>
    NUEVO EMPLEADO 
</h1>
<!-- Se genera un formulario para introducir los datos de la tabla de empleado-->
<form name="form" action="agregar_empleados.php" method="post">
    DNI:<input type="text" name="dni_empleado" required><p>
    Nombre:<input type="text" name="nombre_empleado" required><p>
    Apellidos:<input type="text" name="apellido_empleado" required><p>
    Email:<input type="text" name="email_empleado" required><p>
    Tel&eacute;fono:<input type="number" name="telefono_empleado" required><p>
    Edad:<input type="number" min="18" name="edad_empleado" required><p>
    Fecha de contrataci&oacute;n:<input type="date" name="fecha_contratacion" required><p>
    </br>
    Lugar de trabajo:
        <select name="id_tienda">
            <option value="">--Selecciona una opción--</option>
            <option value="TI01">Tienda Madrid</option>
            <option value="TI02">Tienda Asturias</option>
            <option value="TI03">Tienda Valencia</option>
        </select>
    
    <!-- Botones de registrar y borrar -->
    <input type="submit" value="Registrar">
    <input type="reset" value="Borrar">
    <input type="button" value="Volver" onclick="window.location.href='empleado.php'">
</form>
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }
        });
    });
</script>
</body>
</html>
