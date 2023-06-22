<?php
header("Content-Type: application/json; charset=UTF-8");

include_once("db.php");
$conectar = conn();

$sql = "SELECT id_producto FROM producto";
$result = $conectar->query($sql);

$empleados = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $empleados[] = $row["id_producto"];
    }
}

echo json_encode($empleados);
$conectar->close();
?>