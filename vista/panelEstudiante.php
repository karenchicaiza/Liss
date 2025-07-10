<?php
function mostrarPanelEstudiante($usuario) {
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Estudiante</title></head>
<body>
  <h2>Bienvenido ESTUDIANTE: <?= htmlspecialchars($usuario) ?></h2>
  <p>Visualiza tus materias, notas y tareas.</p>
  <a href="index.php?accion=salir">Cerrar sesión</a>
</body>
</html>
<?php } ?>
