<?php
require_once("conexion.php");

function consultar_bodegas() {
    global $conexion;
    $query = "SELECT * FROM bodegas";
    $result = mysqli_query($conexion, $query);
    $bodegas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bodegas[] = $row;
    }
    return $bodegas;
}

function consultar_productos_bodega($id_bodega) {
    global $conexion;
    $query = "SELECT p.id_producto, p.nombre_producto, s.stock FROM productos AS p INNER JOIN productosbodegas AS s ON p.id_producto = s.id_producto WHERE s.id_bodega = $id_bodega;";
    $result = mysqli_query($conexion, $query);
    $productos_bodega = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $productos_bodega[] = $row;
    }
    return $productos_bodega;
}

/* function actualizar_bodega($id_bodega, $nombre) {
    global $conexion;
    $query = "UPDATE bodegas SET nombre_bodega='$nombre' WHERE id_bodega=$id_bodega";
    if (mysqli_query($conexion, $query)) {
        echo "Se ha actualizado la bodega";
    } else {
        echo "Error: ".$query."<br>".mysqli_error($conexion);
    }
} */

function actualizar_stock_producto_bodega($id_bodega, $id_producto, $nuevo_stock) {
    global $conexion;
    $query = "UPDATE stock SET stock=$nuevo_stock WHERE id_bodega=$id_bodega AND id_producto=$id_producto";
    if (mysqli_query($conexion, $query)) {
        return true;
    } else {
        echo "Error: ".$query."<br>".mysqli_error($conexion);
        return false;
    }
}
?>
