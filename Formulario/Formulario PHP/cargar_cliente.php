<?php
header("Content-Type: application/json; charset=UTF-8");

include_once("db.php");
$conectar = conn();

$sql = "SELECT dni_cliente, puntos FROM cliente";
$result = $conectar->query($sql);

$clientes = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clientes[] = array(
            "dni_cliente" => $row["dni_cliente"],
            "puntos" => $row["puntos"]
        );
    }
}

echo json_encode($clientes);
$conectar->close();
?>