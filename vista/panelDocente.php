<?php
function mostrarPanelDocente($usuario) {
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Docente</title></head>
<body>
  <h2>Hola DOCENTE: <?= htmlspecialchars($usuario) ?></h2>
  <p>Panel para subir calificaciones, revisar estudiantes, etc.</p>
  <a href="index.php?accion=salir">Cerrar sesión</a>
</body>
</html>
<?php } ?>
