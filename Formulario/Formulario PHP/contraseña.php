<?php

$passwords = ['root', 'juan', 'brian', 'enrique'];

foreach ($passwords as $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo "Contraseña: {$password} | Contraseña hasheada: {$hashed_password} <br>";
}

?>
