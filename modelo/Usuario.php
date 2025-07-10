<?php
require_once 'config/conexion.php';

class Usuario {
    public static function verificar($usuario, $clave) {
        global $conexion;
        $stmt = $conexion->prepare("SELECT rol FROM usuarios WHERE usuario = ? AND clave = ?");
        $stmt->bind_param("ss", $usuario, $clave);
        $stmt->execute();
        $stmt->bind_result($rol);
        if ($stmt->fetch()) {
            return $rol;
        }
        return false;
    }

    public static function crearUsuario($usuario, $clave) {
        global $conexion;
        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, clave) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $clave);
        return $stmt->execute();
    }

    public static function listarUsuarios() {
        global $conexion;
        $resultado = $conexion->query("SELECT id, usuario, rol FROM usuarios");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public static function actualizarRol($idUsr, $nuevoRol) {
        global $conexion;
        $stmt = $conexion->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevoRol, $idUsr);
        return $stmt->execute();
    }
}
