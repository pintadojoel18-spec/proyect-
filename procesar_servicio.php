<?php
// Incluir conexión a la base de datos
include 'includes/db.php';

// --- LÓGICA PARA CREAR (INSERT) ---
if (isset($_POST['guardar_servicio'])) {
    
    // Capturar y limpiar datos procedentes del formulario para prevenir inyección SQL básica
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);

    // Armar consulta SQL
    $query = "INSERT INTO servicios (nombre, descripción, precio) VALUES ('$nombre', '$descripcion', '$precio')";
    
    // Ejecutar de forma procedimental
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        // Redirigir con éxito
        header("Location: servicios.php?mensaje=guardado");
        exit();
    } else {
        die("Error al guardar: " . mysqli_error($conexion));
    }
}

// --- LÓGICA PARA ELIMINAR (DELETE) ---
if (isset($_GET['eliminar'])) {
    
    // Obtener el ID de la URL
    $id = mysqli_real_escape_string($conexion, $_GET['eliminar']);

    // Armar consulta SQL
    $query = "DELETE FROM servicios WHERE id = $id";
    
    // Ejecutar
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        // Redirigir con éxito
        header("Location: servicios.php?mensaje=eliminado");
        exit();
    } else {
        die("Error al eliminar: " . mysqli_error($conexion));
    }
}
?>