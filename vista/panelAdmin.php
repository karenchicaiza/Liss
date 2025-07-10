<?php
function mostrarPanelAdmin($usuario, $usuarios = [], $mensaje = '') {
  if (!$usuarios) {
    $usuarios = Usuario::listarUsuarios(); // Asegúrate de que la clase Usuario existe
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Admin</title>
</head>
<body>
  <h2>Bienvenido ADMIN: <?= htmlspecialchars($usuario) ?></h2>
  <p>Este es el panel de control administrativo.</p>

  <?php if ($mensaje): ?>
    <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
  <?php endif; ?>

  <h3>Usuarios registrados</h3>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Usuario</th>
      <th>Rol</th>
      <th>Nuevo rol</th>
      <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
      <tr>
        <form method="POST" action="index.php?accion=cambiar_rol">
          <td><?= htmlspecialchars($u['id']) ?></td>
          <td><?= htmlspecialchars($u['usuario']) ?></td>
          <td><?= htmlspecialchars($u['rol']) ?></td>
          <td>
            <select name="nuevo_rol">
              <option value="admin">Administrador</option>
              <option value="docente">Docente</option>
              <option value="estudiante">Estudiante</option>
            </select>
          </td>
          <td>
            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($u['id']) ?>">
            <button type="submit">Cambiar Rol</button>
          </td>
        </form>
      </tr>
    <?php endforeach; ?>
  </table>

  <br>
  <a href="index.php?accion=salir">Cerrar sesión</a>
</body>
</html>
<?php
} // Cierre de la función
?>

