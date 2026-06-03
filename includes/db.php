<?php
$host = "sql.freedb.tech";
$user = "u_31YJPT";
$password = "freedb_LwGi4t3A"; 
$database = "HBM0Fn5XDwR3";

$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");
