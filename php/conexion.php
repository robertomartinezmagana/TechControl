<?php
$host = "localhost";
$usuario = "root";
$password = ""; // deja vacío si estás usando XAMPP por defecto
$base_datos = "mantenimiento_cyp";

$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>