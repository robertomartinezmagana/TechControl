<?php
include "conexion.php";

// Capturar datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];

// Cifrar contraseña
$pass_hash = password_hash($password, PASSWORD_BCRYPT);

// Fecha actual
$fecha_creacion = date("Y-m-d H:i:s");

// Estado inicial
$estado = 'activo';

// Insertar usuario en la base de datos
$sql_usuario = "INSERT INTO usuario (nombre, apellido, correo, contraseña, telefono, estado, fecha_creacion)
VALUES ('$nombre', '$apellidos', '$correo', '$pass_hash', '$telefono', '$estado', '$fecha_creacion')";

if ($conexion->query($sql_usuario) === TRUE) {
    // Obtener el ID generado automáticamente
    $id_usuario = $conexion->insert_id;

    // Insertar en tabla administrador
    $sql_admin = "INSERT INTO administrador (id_usuario) VALUES ($id_usuario)";
    if ($conexion->query($sql_admin) === TRUE) {
        echo "<script>alert('Administrador registrado correctamente'); window.location='../admin/login_admin.php';</script>";
    } else {
        echo "Error al registrar administrador: " . $conexion->error;
    }
} else {
    echo "Error al registrar usuario: " . $conexion->error;
}

$conexion->close();
?>
