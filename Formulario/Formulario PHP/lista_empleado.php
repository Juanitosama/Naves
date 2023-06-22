<?php
include 'confimarcion_autenticacion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Consultar Empleados</title>
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
    <style>
        .container {
            max-width: 100%;
        }
    </style>
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
                    <li class="nav-php">
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
    <div class="container mt-4">
        <h1 class="text-center mb-4">CONSULTAR EMPLEADOS</h1>

        <!-- Tabla de clientes -->
        <div class="table-responsive"> <!-- Agrega un contenedor para la tabla -->
            <table id="tablaClientes" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Edad</th>
                <th>Fecha de contratación</th>
                <th>Lugar Trabajo</th>
            </tr>
        </thead>
        <tbody>
    <?php
    // Conexión a la db
    include_once('db.php');
    $conectar = conn();

    if (!$conectar) {
        echo "<tr><td colspan='14'>Error de conexión: " . mysqli_connect_error() . "</td></tr>";
    } else {
        $sql_productos = "SELECT * FROM empleado";
        $result_productos = $conectar->query($sql_productos);

        if ($result_productos->num_rows > 0) {
            while($row = $result_productos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row['dni_empleado'] . "</td>";
                echo "<td>". $row['nombre_empleado'] . "</td>";
                echo "<td>". $row['apellido_empleado'] . "</td>";
                echo "<td>" . $row['telefono_empleado'] . "</td>";
                echo "<td>" . $row['edad_empleado'] . "</td>";
                echo "<td>" . $row['fecha_contratacion'] . "</td>";
                echo "<td>" . $row['id_tienda'] . "</td>";
                echo "</tr>";
            }
        }
    
        // Cerrar la conexión
        $conectar->close();
    }
    ?>
        </tbody>
    </body>
    <script>
        $(document).ready(function() {
            $('#tablaClientes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
            });
        });
    </script>
</html>
    