<?php
    function mostrarDashboard($usuario){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/estilo.css">
    </head>
<body>
    <div class="login-container">
        <h2>Bienvenido, <?php echo htmlspecialchars($usuario)?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="index.php">Cerrar Sesión</a>
        </div>
        </body>
</html>
<?php
    }
    ?>