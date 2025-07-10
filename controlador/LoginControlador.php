<?php
// controlador/LoginControlador.php

require_once 'modelo/Usuario.php';
require_once 'vista/loginVista.php';
require_once 'vista/panelAdmin.php';
require_once 'vista/panelDocente.php';
require_once 'vista/panelEstudiante.php';

class LoginControlador {
    public function mostrarFormulario() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $recordado = $_COOKIE['usuario'] ?? '';
        $mensaje = $_SESSION['mensaje_login'] ?? '';
        unset($_SESSION['mensaje_login']);

        mostrarFormularioLogin($mensaje, $recordado);
    }

    public function validar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $usuario = $_POST['usuario'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $recordar = isset($_POST['recordar']);

        $rol = Usuario::verificar($usuario, $clave);

        if ($rol) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $rol;

            if ($recordar) {
                setcookie('usuario', $usuario, time() + (60 * 60 * 24 * 30), '/');
            } else {
                setcookie('usuario', '', time() - 3600, '/');
            }

            header('Location: index.php');
            exit();
        } else {
            $_SESSION['mensaje_login'] = "Credenciales incorrectas. Inténtalo de nuevo.";
            header('Location: index.php');
            exit();
        }
    }

    public function dashboard() {
        $usuario = $_SESSION['usuario'] ?? '';
        $rol = $_SESSION['rol'] ?? '';

        switch ($rol) {
            case 'admin': mostrarPanelAdmin($usuario); break;
            case 'docente': mostrarPanelDocente($usuario); break;
            case 'estudiante': mostrarPanelEstudiante($usuario); break;
            default:
                $_SESSION['mensaje_login'] = "Acceso no autorizado. Por favor, inicia sesión.";
                header('Location: index.php');
                exit();
        }
    }

    public function salir() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function registrar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $nuevo_usuario = $_POST['nuevo_usuario'] ?? '';
        $nueva_clave = $_POST['nueva_clave'] ?? '';
        $rol = 'estudiante'; // Por defecto

        if ($nuevo_usuario && $nueva_clave) {
            if (Usuario::crearUsuario($nuevo_usuario, $nueva_clave, $rol)) {
                $_SESSION['mensaje_login'] = "Usuario '{$nuevo_usuario}' registrado exitosamente como {$rol}. Ya puedes iniciar sesión.";
                header('Location: index.php?accion=registrar_exito');
                exit();
            } else {
                $_SESSION['mensaje_login'] = "Error al registrar el usuario '{$nuevo_usuario}'. Posiblemente ya existe o hubo un problema en la base de datos.";
                header('Location: index.php?accion=registrar_error');
                exit();
            }
        } else {
            $_SESSION['mensaje_login'] = "Por favor, completa todos los campos para el registro.";
            header('Location: index.php?accion=registrar_error');
            exit();
        }
    }

    public function cambiarRol() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SESSION['rol'] !== 'admin') {
            $_SESSION['mensaje_login'] = "Acceso no autorizado";
            header('Location: index.php');
            exit();
        }

        $id = $_POST['usuario_id'] ?? '';
        $nuevoRol = $_POST['nuevo_rol'] ?? '';
        $mensaje = '';

        if ($id && $nuevoRol) {
            if (Usuario::actualizarRol($id, $nuevoRol)) {
                $mensaje = "Rol actualizado correctamente";
            } else {
                $mensaje = "Error al cambiar el rol del usuario";
            }
        } else {
            $mensaje = "Datos incompletos";
        }

        $usuarios = Usuario::listarUsuarios();
        mostrarPanelAdmin($_SESSION['usuario'], $usuarios, $mensaje);
    }
}
