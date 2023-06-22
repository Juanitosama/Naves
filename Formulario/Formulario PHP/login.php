<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS personalizado -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 5% auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1 class="mb-4 text-center">Iniciar sesión</h1>
        <form action="autenticador.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario:</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>