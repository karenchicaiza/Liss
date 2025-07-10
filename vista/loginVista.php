<?php
// vista/loginVista.php

function mostrarFormularioLogin($mensaje = '', $usuarioRecordado = '') {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registro</title>
    <link rel="stylesheet" href="assets/estilo.css">
</head>
<body>

    <div class="login-container">
        <?php if (!empty($mensaje)): ?>
            <p id="mensaje-global" style="color: red; font-weight: bold;"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <div id="loginFormDiv">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="index.php?accion=validar" onsubmit="return validarFormulario()">
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?= htmlspecialchars($usuarioRecordado) ?>" required>
                <input type="password" name="clave" id="clave" placeholder="Contraseña" required>
                <label>
                    <input type="checkbox" name="recordar"> Recordarme
                </label>
                <button type="submit">Ingresar</button>
            </form>
            <p id="mensaje-login" style="color: red;"></p>
        </div>

        <hr> <button id="btnMostrarFormularioRegistro">Registrar Nuevo Usuario</button>

        <div id="formularioRegistro" class="formulario-oculto">
            <h2>Registrar Nuevo Usuario</h2>
            <form method="POST" action="index.php?accion=registrar">
                <input type="text" name="nuevo_usuario" id="nuevo_usuario" placeholder="Nombre de Usuario" required>
                <input type="password" name="nueva_clave" id="nueva_clave" placeholder="Contraseña" required>
                <button type="submit">Registrar</button>
                <button type="button" id="btnCerrarFormularioRegistro" class="btn-cancel">Cancelar</button>
            </form>
            <p id="mensaje-registro" style="color: red;"></p>
        </div>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>
<?php
}
?>