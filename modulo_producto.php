<?php

    // Archivo de conexión
    include('conexion.php');

    // Función de ingreso
    function insertar_producto($nombre, $detalle) {
        global $conexion;
        $query = "INSERT INTO `productos` (nombre_producto, detalle_producto) VALUES ('$nombre', '$detalle');";
        if (mysqli_query($conexion, $query)) {
            echo "Se ha agregado un nuevo producto";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
        }
    }

    // Función de actualización
    function actualizar_producto($id_producto, $nombre, $detalle) {
        global $conexion;
        $query = "UPDATE productos SET nombre_producto='$nombre', detalle_producto='$detalle' WHERE id_producto=$id_producto";
        if (mysqli_query($conexion, $query)) {
            echo "Se ha actualizado un producto";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
        }
    }

    // Función de eliminación
    function eliminar_producto($id_producto) {
        global $conexion;
        $query = "DELETE FROM productos WHERE id_producto=$id_producto";
        if (mysqli_query($conexion, $query)) {
            echo "Se ha eliminado un producto";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
        }
    }

    // Función de consulta
    function consultar_producto() {
        global $conexion;
        $query = "SELECT * FROM productos";
        $result = mysqli_query($conexion, $query);
        $productos = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
        return $productos;
    }

    function buscar_id_producto($id_producto){
        global $conexion;
        $query = "SELECT * FROM productosbodegas WHERE id_producto = $id_producto;";
        $result = mysqli_query($conexion, $query);
        if (mysqli_num_rows($result) == 0) {
            return false; // No se encontraron registros
        }
        return true; // Se encontraron registros
    }

    // Verificar si se ha enviado el formulario de editar producto
    if (isset($_POST['agregar_producto'])) {
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        insertar_producto($nombre, $detalle);
        $alerta = "Se inserto un nuevo producto.";
        $color ="success";
        header("Location: index.php?view=productos&alerta=$alerta&color=$color");
        exit();  
    }

    // Verificar si se ha enviado el formulario de editar producto
    if (isset($_POST['editar_producto'])) {
        $id_producto = $_POST['id_producto'];
        $nombre = $_POST['nombre_producto'];
        $detalle = $_POST['detalle_producto'];
        actualizar_producto($id_producto, $nombre, $detalle);
        $alerta = "Se actualizo el producto.";
        $color ="success";
        header("Location: index.php?view=productos&alerta=$alerta&color=$color");
        exit();
    }

    // Verificar si se ha enviado el formulario de eliminar producto
    if (isset($_POST['eliminar_producto'])) {
        $id_producto = $_POST['id_producto'];
        if(buscar_id_producto($id_producto)==true){
            $alerta = "No se puede eliminar el producto.";
            $color ="danger";
            header("Location: index.php?view=productos&alerta=$alerta&color=$color");
            exit();
        }else{ 
            eliminar_producto($id_producto);
            $alerta = "Se elimino el producto.";
            $color ="success";
            header("Location: index.php?view=productos&alerta=$alerta&color=$color");
            exit();
        }
    }

?>