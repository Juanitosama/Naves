<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Conexión a la db
    include_once('db.php');

    //Recibo los datos del formulario
    $ID=$_POST['id_producto'];
    $nombre=$_POST['nombre_producto'];
    $capacidad=$_POST['memoria'];
    $descripcion=$_POST['descripcion_producto'];
    $marca=$_POST['marca_producto'];
    $precio=$_POST['precio_producto'];
    $categoria=$_POST['categoria'];

    $conectar=conn(); //ejecuta las conexiones a la db

    $query = "INSERT INTO producto (id_producto, nombre_producto, memoria, descripcion_producto, marca_producto, precio_producto, categoria) 
    VALUES ('$ID', '$nombre', '$capacidad', '$descripcion', '$marca', '$precio', '$categoria')";

    $resultado=mysqli_query($conectar, $query); // Ejecuta la consulta SQL

    if ($resultado) {
        echo "El producto ha sido registrado correctamente.<br>";
        echo '<a href="agregar_producto.php"><button>Volver al formulario</button></a>';
    } else {
        echo "Ha ocurrido un error al registrar el producto. Por favor, inténtalo de nuevo más tarde.<br>";
        echo '<a href="agregar_producto.php"><button>Volver al formulario</button></a>';
    }

    mysqli_close($conectar); // Cierra la conexión a la base de datos
}
?>