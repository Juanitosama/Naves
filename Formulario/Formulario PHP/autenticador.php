<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Crear una instancia de conexión a la base de datos utilizando la función conn()
$conn = conn();

// Obtener los valores del formulario de inicio de sesión
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consultar en la base de datos si existe un usuario con ese nombre de usuario
$query = "SELECT * FROM usuario WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Si se encuentra un usuario con ese nombre de usuario, verificar la contraseña
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];
    
    // Verificar si la contraseña ingresada coincide con el hash almacenado en la base de datos
    
    if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['last_active'] = time(); // Añade esta línea
        header('Location: index.php');
    } else {    
        // Si la contraseña es incorrecta, mostrar mensaje de error
        echo 'Nombre de usuario o contraseña incorrecta.';
    }
} else {
    // Si no se encuentra un usuario, mostrar mensaje de error
    echo 'Nombre de usuario o contraseña incorrecta.</br>';
    echo '<a href="login.php"><button>Volver al formulario</button></a>';
}

// Cerrar la conexión a la base de datos
$conn->close();
?>