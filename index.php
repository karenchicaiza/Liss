<?php
session_start(); // Inicia la sesión al principio

require_once 'controlador/LoginControlador.php';

$accion = $_GET['accion'] ?? '';

$controlador = new LoginControlador();

switch ($accion) {
    case 'validar':
        $controlador->validar();
        break;
    case 'salir':
        $controlador->salir();
        break;
    case 'cambiar_rol':   // Nota: debe ser "cambiar_rol" y coincidir con el form en panelAdmin.php
        $controlador->cambiarRol();
        break;
    default:
        if (isset($_SESSION['usuario'])) {
            $controlador->dashboard();
        } else {
            $controlador->mostrarFormulario();
        }
        break;
}
