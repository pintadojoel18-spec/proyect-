<?php
// 1. Conectar a la base de datos de manera procedimental
include 'includes/db.php';

// --- LÓGICA PARA INSERTAR CLIENTE ---
if (isset($_POST['guardar_cliente'])) {
    
    // 2. Sanitizar cadenas con funciones mysqli procedimentales
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    
    // 3. Encriptar contraseña de manera segura usando password_hash nativo de PHP
    $contrasena_plana = $_POST['contrasena'];
    $contrasena_encriptada = password_hash($contrasena_plana, PASSWORD_DEFAULT);

    // 4. Sentencia SQL
    // CORRECCIÓN: Uso de comillas invertidas ` ` en columnas con tilde y eñe.
    $query = "INSERT INTO clientes (nombre, correo, `contraseña`, `teléfono`) VALUES ('$nombre', '$correo', '$contrasena_encriptada', '$telefono')";
    
    // 5. Ejecutar consulta
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        header("Location: clientes.php?status=success");
        exit();
    } else {
        die("Error al registrar cliente: " . mysqli_error($conexion));
    }
}

// --- LÓGICA PARA ELIMINAR CLIENTE ---
if (isset($_GET['eliminar'])) {
    
    // Convertir a entero por seguridad (Evita inyección SQL al eliminar)
    $id = (int) $_GET['eliminar']; 

    $query = "DELETE FROM clientes WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        header("Location: clientes.php?status=deleted");
        exit();
    } else {
        die("Error al eliminar cliente: " . mysqli_error($conexion));
    }
}
?>