<?
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_almacen = $_POST['id_almacen'];
    $id_tienda = $_POST['id_tienda'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $conectar = conn();

    // Preparar la consulta para actualizar el stock en el almacén
    $sql_almacen = "UPDATE stock_almacen SET cantidad = cantidad - ? WHERE id_almacen = ? AND id_producto = ?";
    $stmt_almacen = mysqli_prepare($conectar, $sql_almacen);

    // Preparar la consulta para actualizar el stock en la tienda
    $sql_tienda= "UPDATE stock_tienda SET cantidad = cantidad + ? WHERE id_tienda = ? AND id_producto = ?";
    $stmt_tienda = mysqli_prepare($conectar, $sql_tienda);

    if ($stmt_almacen && $stmt_tienda) {
        // Vincular los parámetros para la consulta del almacén
        mysqli_stmt_bind_param($stmt_almacen, "iss", $cantidad, $id_almacen, $id_producto);

        // Ejecutar la consulta del almacén
        if (mysqli_stmt_execute($stmt_almacen)) {
            // Vincular los parámetros para la consulta de la tienda
            mysqli_stmt_bind_param($stmt_tienda, "iss", $cantidad, $id_tienda, $id_producto);

            // Ejecutar la consulta de la tienda
            if (mysqli_stmt_execute($stmt_tienda)) {
                if (mysqli_stmt_affected_rows($stmt_almacen) > 0 && mysqli_stmt_affected_rows($stmt_tienda) > 0) {
                    echo "Se han enviado $cantidad unidades del producto con ID: $id_producto del almacén con ID: $id_almacen a la tienda con ID: $id_tienda.";
                    echo "<br>";
                    echo '<a href="stock.php"><button>Volver al formulario</button></a>';
                } else {
                    echo "No se ha encontrado ningún registro de stock para el producto con ID $id_producto en el almacén con ID $id_almacen.";
                }
            } else {
                echo "Error al actualizar el registro de stock en la tienda: " . mysqli_stmt_error($stmt_tienda);
                echo "<br>";
                echo '<a href="stock.php"><button>Volver al formulario</button></a>';
            }

            mysqli_stmt_close($stmt_tienda);
        } else {
            echo "Error al actualizar el registro de stock en el almacén: " . mysqli_stmt_error($stmt_almacen);
            echo "<br>";
            echo '<a href="stock.php"><button>Volver al formulario</button></a>';
        }

        mysqli_stmt_close($stmt_almacen);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conectar);
    }

    mysqli_close($conectar);
}
?>