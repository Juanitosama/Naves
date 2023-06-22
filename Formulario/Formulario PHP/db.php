<?php
//datos de la conexión
function conn(){
    $hostname = "sql109.epizy.com";
    $usuariodb = "epiz_33851260";
    $passworddb = "QZleV6tiqpXo";
    $dbname = "epiz_33851260_prueba";

    //crear la conexión
    $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

        // Establecer el conjunto de caracteres a utf8
    mysqli_set_charset($conectar, 'utf8');

    //comprobar si la conexión es exitosa
    if (!$conectar) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    return $conectar;
}

function obtenerEmpleados($conectar) {
    $empleados = [];
    $sql = "SELECT DNI_empleado FROM Empleado";
    $result = $conectar->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row['DNI_empleado'];
        }
    }
    return $empleados;
}

function obtenerClientes($conectar) {
    $clientes = [];
    $sql = "SELECT DNI_cliente FROM Cliente";
    $result = $conectar->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row['DNI_cliente'];
        }
    }
    return $clientes;
}

function obtenerProductos($conectar) {
    $clientes = [];
    $sql = "SELECT id_producto FROM Producto";
    $result = $conectar->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row['id_producto'];
        }
    }
    return $clientes;
}
?>