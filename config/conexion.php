<?php
    $conexion = new mysqli('localhost', 'root', '', 'sistema_login');
    if($conexion->connect_error){
        die("Error de conexión: " . $conexion->connect_error);
    }
    else {
        //echo "Conexión exitosa a la base de datos.";
    }
?>