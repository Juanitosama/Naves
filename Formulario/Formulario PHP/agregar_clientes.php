<?php
//Conexión a la db
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Recibo los datos del formulario
    $DNI = $_POST['dni_cliente'];
    $nombre = $_POST['nombre_cliente'];
    $apellidos = $_POST['apellido_cliente'];
    $edad = $_POST['edad_cliente'];
    $telefono = $_POST['telefono_cliente'];
    $ciudad = $_POST['ciudad_cliente'];
    $puntos = $_POST['puntos'];

    $conectar = conn(); //ejecuta las conexiones a la db
    $sql = "INSERT INTO cliente (dni_cliente, nombre_cliente, apellido_cliente, edad_cliente, telefono_cliente, ciudad_cliente, puntos) 
    VALUES ('$DNI','$nombre','$apellidos','$edad','$telefono','$ciudad', '$puntos')"; //Se indica en que tabla insertar los valores de las variables introducidas
    
    $resul = mysqli_query($conectar, $sql) or trigger_error("Query Failed! SQL - Error: " . mysqli_error($conectar)); //Conectar con sql sino !ERROR!

    if ($resul) {
        echo "El empleado ha sido registrado correctamente.<br>";
        echo '<a href="cliente.php"><button>Volver al formulario</button></a>'; //Si se registra correctamente sale aviso y boton para volver al formulario
    } else {
        echo "Ha ocurrido un error al registrar el empleado. Por favor, inténtalo de nuevo más tarde.<br>"; //Sino hay un error, aviso y boton para volver al formulario
        echo '<a href="cliente.php"><button>Volver al formulario</button></a>';
    }
}
?>