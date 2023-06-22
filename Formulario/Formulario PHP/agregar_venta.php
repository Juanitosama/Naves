<?php
include 'confimarcion_autenticacion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Nueva Venta</title>
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
                        <a class="nav-link" href="stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="venta.php">Venta</a>
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
    <h1>
        NUEVA VENTA
    </h1>
    <form name="form" action="agregar_ventas.php" method="post">
        DNI Empleado:     
        <select name="dni_empleado" id="dni_empleado">
            <option value="" selected>--Selecciona una opción--</option>
        </select>
        DNI Cliente: 
        <select name="dni_cliente" id="dni_cliente">
            <option value="" selected>--Selecciona una opción--</option>
        </select>
        ID Producto:
        <select name="id_producto" id="id_producto">
            <option value="" selected>--Selecciona una opción--</option>
        </select>
        Cantidad:<input type="number" name="cantidad" min="0" required><p>
        Tienda:
        <select name="id_tienda" id="id_tienda" onchange="cargarDesplegable()">
            <option value="NULL">-- Selecciona una opción --</option>
            <option value="TI01">TI01 -> Tienda Madrid</option>
            <option value="TI02">TI02 -> Tienda Asturias</option>
            <option value="TI03">TI03 -> Tienda Valencia</option>
        </select><p>
        Puntos de descuento:
        <select name="puntos" id="puntos">
            <option value="" selected>--Selecciona una opción--</option>
        </select><p>
        <input type="submit" value="Registrar Venta">
        <input type="reset" value="Borrar">
        <input type="button" value="Volver" onclick="window.location.href='venta.php'">

    </form>
    <script>
async function cargarEmpleados() {
    const response = await fetch('cargar_empleado.php');
    const empleados = await response.json();
    const selectEmpleado = document.getElementById('dni_empleado');

    empleados.forEach(empleado => {
        const option = document.createElement('option');
        option.value = empleado;
        option.textContent = empleado;
        selectEmpleado.appendChild(option);
    });

    selectEmpleado.addEventListener('change', function() {
        const idEmpleado = this.value;
        if (idEmpleado !== '') {
            // Llamada a la función para obtener el id_tienda del empleado seleccionado
            obtenerIdTienda(idEmpleado)
                .then(idTienda => {
                    const selectTienda = document.getElementById('id_tienda');
                    selectTienda.value = idTienda;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
}

async function obtenerIdTienda(idEmpleado) {
    const response = await fetch(`obtener_id_tienda.php?id_empleado=${idEmpleado}`);
    const data = await response.json();
    return data.id_tienda;
}
        async function cargarClientes() {
            const response = await fetch('cargar_cliente.php');
            const clientes = await response.json();
            const selectCliente = document.getElementById('dni_cliente');
            
            clientes.forEach(cliente => {
                const option = document.createElement('option');
                option.value = cliente.dni_cliente;
                option.textContent = cliente.dni_cliente;
                option.dataset.puntos = cliente.puntos; // Almacenar los puntos en un atributo dataset
                selectCliente.appendChild(option);
            });

            selectCliente.addEventListener('change', function() {
                const selectPuntos = document.getElementById('puntos');
                selectPuntos.innerHTML = ''; // Limpiar las opciones existentes

                // Si se selecciona un cliente, mostrar sus puntos y la opción 0
                if (this.value !== '') {
                    const puntosCliente = this.options[this.selectedIndex].dataset.puntos;
                    const puntosOption = document.createElement('option');
                    puntosOption.value = puntosCliente;
                    puntosOption.textContent = puntosCliente;
                    selectPuntos.appendChild(puntosOption);

                    const zeroOption = document.createElement('option');
                    zeroOption.value = "0";
                    zeroOption.textContent = "0";
                    selectPuntos.appendChild(zeroOption);
                } else {
                    // Si no se selecciona un cliente, vaciar el desplegable de puntos
                    const emptyOption = document.createElement('option');
                    emptyOption.value = "";
                    emptyOption.textContent = "--Selecciona una opción--";
                    selectPuntos.appendChild(emptyOption);
                }
            });
        }
            async function cargarProductos() {
            const response = await fetch('cargar_producto.php'); 
            const clientes = await response.json();
            const selectCliente = document.getElementById('id_producto');

            clientes.forEach(producto => {
                const option = document.createElement('option');
                option.value = producto;
                option.textContent = producto;
                selectCliente.appendChild(option);
            });
            }


        cargarEmpleados();
        cargarClientes();
        cargarProductos();
    </script>
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