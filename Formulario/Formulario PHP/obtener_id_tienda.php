<?php
// Incluir el archivo db.php para obtener la conexión a la base de datos
require_once 'db.php';

// Obtener el DNI del empleado desde el parámetro en la URL
$idEmpleado = $_GET["id_empleado"];

// Realizar la consulta para obtener el ID de la tienda asignada al empleado
$sql = "SELECT id_tienda FROM empleados WHERE dni_empleado = '$idEmpleado'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$idTienda = $row["id_tienda"];

// Retornar el ID de la tienda como objeto JSON
echo json_encode(array("id_tienda" => $idTienda));
?>