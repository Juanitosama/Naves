<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la db
    include_once('db.php');

    // Obtener los datos del formulario
    $dni_empleado = $_POST['dni_empleado'];
    $dni_cliente = $_POST['dni_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $id_tienda = $_POST['id_tienda'];
    $puntos = $_POST['puntos'];

    $conectar = conn();

    // Obtener el stock actual y el precio del producto
    $sql_stock = 
        "SELECT p.id_producto, p.nombre_producto, s.id_tienda, s.cantidad AS cantidad_stock, p.precio_producto
        FROM stock_tienda AS s
        JOIN producto AS p ON s.id_producto = p.id_producto
        WHERE s.id_producto = '$id_producto' AND s.id_tienda = '$id_tienda';";
    $result_stock = $conectar->query($sql_stock);

    if ($result_stock->num_rows > 0) {
        $row = $result_stock->fetch_assoc();
        $stock_actual = $row['cantidad_stock'];
        $precio_producto = $row['precio_producto'];

        // Verificar si hay suficiente stock
        if ($cantidad <= $stock_actual) {
            // Calcular el total
            $total = $cantidad * $precio_producto;

            // Calcular el descuento
            $total_descuento = $total - ($puntos * 0.05);

            // Insertar la venta y obtener el ID de la venta insertada
            $sql_venta = "INSERT INTO venta (dni_empleado, dni_cliente, fecha_venta) VALUES ('$dni_empleado', '$dni_cliente', CURDATE())";
            if ($conectar->query($sql_venta) === TRUE) {
                $id_venta = $conectar->insert_id;

                // Insertar en detalle_venta
                $sql_detalle_venta = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad, descuento_puntos, total) VALUES ($id_venta, '$id_producto', $cantidad, $puntos, $total_descuento)";
                $conectar->query($sql_detalle_venta);

                // Actualizar el stock en la tienda seleccionada
                $sql_actualizar_stock = "UPDATE stock_tienda SET cantidad = cantidad - $cantidad WHERE id_producto = '$id_producto' AND id_tienda = '$id_tienda'";
                $conectar->query($sql_actualizar_stock);

                // Restar puntos al cliente
                $sql_restar_puntos = "UPDATE cliente SET puntos = puntos - $puntos WHERE dni_cliente = '$dni_cliente'";
                $conectar->query($sql_restar_puntos);

                // Sumar puntos generados con la compra
                $puntos_ganados = $total_descuento ;
                $sql_sumar_puntos = "UPDATE cliente SET puntos = puntos + $puntos_ganados WHERE dni_cliente = '$dni_cliente'";
                $conectar->query($sql_sumar_puntos);

                echo "Venta realizada con éxito<br>";
                echo "El precio total son $total_descuento €<br>";
                echo '<a href="venta.html"><button>Volver al formulario</button></a>';
                    } else {
                echo "Error al insertar la venta: <br>" . $conectar->error;
                echo '<a href="venta.html"><button>Volver al formulario</button></a>';
        }
        } else {
            echo "No hay suficiente stock para completar la venta.<br>";
            echo '<a href="venta.html"><button>Volver al formulario</button></a>';
        }
    } else {
        echo "Error al obtener el stock y precio del producto: <br>" . $conectar->error;
        echo '<a href="venta.html"><button>Volver al formulario</button></a>';
    }
} else {
    echo "No se ha enviado el formulario. Por favor, complete y envíe el formulario.<br>";
    echo '<a href="venta.html"><button>Volver al formulario</button></a>';
    }
    
    // Cerrar la conexión
    $conectar->close();
    ?>