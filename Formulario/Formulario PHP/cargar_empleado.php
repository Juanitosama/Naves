<?php
header("Content-Type: application/json; charset=UTF-8");

include_once("db.php");
$conectar = conn();

$sql = "SELECT dni_empleado FROM empleado";
$result = $conectar->query($sql);

$empleados = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $empleados[] = $row["dni_empleado"];
    }
}

echo json_encode($empleados);
$conectar->close();
?>