<?php
session_start();
include "conexion.php";

$role = $_POST['role'];
$usuario = $_POST['usuario']; // aquí usas "usuario" o "correo" según tu formulario
$password = $_POST['password'];

// Buscar usuario en la tabla usuario
$sql = "SELECT * FROM usuario WHERE nombre = '$usuario' OR correo = '$usuario'";
$result = $conexion->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    
    if(password_verify($password, $row['contraseña'])){
        // Guardar datos en sesión
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellido'] = $row['apellido'];
        $_SESSION['role'] = $role;

        // Redirigir según rol
        if($role == 'administrador'){
            header("Location: ../admin/prueba.php");
            exit();
        } elseif($role == 'empleado'){
            header("Location: ../empleado/welcome_employee.php");
            exit();
        } elseif($role == 'soporte'){
            header("Location: ../support/welcome_support.php");
            exit();
        }
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.history.back();</script>";
}
$conexion->close();
?>
