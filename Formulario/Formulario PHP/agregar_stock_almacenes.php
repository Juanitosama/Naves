<?
include_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_almacen = $_POST['id_almacen'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $conectar = conn();

    $sql = "UPDATE stock_almacen SET cantidad = cantidad + ? WHERE id_almacen = ? AND id_producto = ?";
    $stmt = mysqli_prepare($conectar, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iss", $cantidad, $id_almacen, $id_producto);
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Se han agregado $cantidad unidades del producto con ID $id_producto en el almacén con ID $id_almacen.";
            } else {
                echo "No se ha encontrado ningún registro de stock para el producto con ID $id_producto en el almacén con ID $id_almacen.";
            }
            echo "<br>";
            echo '<a href="stock.php"><button>Volver al formulario</button></a>'; //Si se actualiza correctamente sale aviso y boton para volver al formulario
        } else {
            echo "Error al actualizar el registro de stock: " . mysqli_stmt_error($stmt);
            echo "<br>";
            echo '<a href="stock.php"><button>Volver al formulario</button></a>';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conectar);
    }

    mysqli_close($conectar);
}
?>