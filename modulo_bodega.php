<?php
// Archivo de conexión
include('conexion.php');

// Función de ingreso
function insertar_bodega($nombre) {
    global $conexion;
    $query = "INSERT INTO `bodegas` (nombre_bodega) VALUES ('$nombre');";
    if (mysqli_query($conexion, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

// Función de actualización
function actualizar_bodega($id_bodega, $nombre) {
    global $conexion;
    $query = "UPDATE bodegas SET nombre_bodega='$nombre' WHERE id_bodega=$id_bodega";
    if (mysqli_query($conexion, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

// Función de eliminación
function eliminar_bodega($id_bodega) {
    global $conexion;
    $query = "DELETE FROM bodegas WHERE id_bodega=$id_bodega";
    if (mysqli_query($conexion, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}

// Función de consulta
function consultar_bodega() {
    global $conexion;
    $query = "SELECT * FROM `bodegas`;";
    ## $query = "SELECT * FROM tabla_bodegas";
    $result = mysqli_query($conexion, $query);
    $bodegas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bodegas[] = $row;
    }
    return $bodegas;
    
}

// Verificar si se ha enviado el formulario de editar bodega
if (isset($_POST['agregar_bodega'])) {
    $nombre = $_POST['nombre'];
    insertar_bodega($nombre);
    header("Location: index.php");
    exit();
    
}

// Verificar si se ha enviado el formulario de editar bodega
if (isset($_POST['editar_bodega'])) {
    $id_bodega = $_POST['id_bodega'];
    $nombre = $_POST['nombre'];
    actualizar_bodega($id_bodega, $nombre);
    header("Location: index.php");
    exit();
}

// Verificar si se ha enviado el formulario de eliminar bodega
if (isset($_POST['eliminar_bodega'])) {
    $id_bodega = $_POST['id'];
    eliminar_bodega($id_bodega);
    header("Location: index.php");
    exit();
}

?>