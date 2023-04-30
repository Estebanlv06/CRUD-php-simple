<?php
// Variables de conexión
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "crud_expertos";

// Conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}

?>
