<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Conexión a la db
    include_once('db.php');

    //Recibo los datos del formulario
    $DNI=$_POST['dni_empleado'];
    $nombre=$_POST['nombre_empleado'];
    $apellidos=$_POST['apellido_empleado'];
    $telefono=$_POST['telefono_empleado'];
    $edad=$_POST['edad_empleado'];
    $fecha_contratacion=$_POST['fecha_contratacion'];
    $id_tienda=$_POST['id_tienda'];

    $conectar=conn(); //ejecuta las conexiones a la db

    $query = "INSERT INTO empleado (dni_empleado, nombre_empleado, apellido_empleado, telefono_empleado, edad_empleado, fecha_contratacion, id_tienda) 
    VALUES ('$DNI', '$nombre', '$apellidos', '$telefono', '$edad', '$fecha_contratacion', '$id_tienda')";

    $resultado=mysqli_query($conectar, $query); // Ejecuta la consulta SQL

    if ($resultado) {
        echo "El empleado ha sido registrado correctamente.<br>";
        echo '<a href="empleado.php"><button>Volver al formulario</button></a>';
    } else {
        echo "Ha ocurrido un error al registrar el empleado. Por favor, inténtalo de nuevo más tarde.<br>";
        echo '<a href="empleado.php"><button>Volver al formulario</button></a>';
    }

    mysqli_close($conectar); // Cierra la conexión a la base de datos
}
?>