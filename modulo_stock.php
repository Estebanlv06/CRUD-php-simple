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
        $query = "SELECT p.id_producto, p.nombre_producto, p.detalle_producto, s.stock FROM productos AS p INNER JOIN productosbodegas AS s ON p.id_producto = s.id_producto WHERE s.id_bodega = $id_bodega;";
        $result = mysqli_query($conexion, $query);
        $productos_bodega = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $productos_bodega[] = $row;
        }
        return $productos_bodega;
    }


    function actualizar_stock_producto_bodega($id_producto, $id_bodega, $nuevo_stock) {
        global $conexion;
        $query = "UPDATE productosbodegas SET stock=$nuevo_stock WHERE id_bodega=$id_bodega AND id_producto=$id_producto";
        if (mysqli_query($conexion, $query)) {
            return true;
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
            return false;
        }
    }

    // Función de eliminación
    function eliminar_producto_bodega($id_producto, $id_bodega) {
        global $conexion;
        $query = "DELETE FROM productosbodegas WHERE id_producto=$id_producto AND id_bodega=$id_bodega";
        if (mysqli_query($conexion, $query)) {
            echo "Se ha eliminado un producto";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
        }
    }
    //Funcion que busca producto que no estan en una bodega
    function consultar_productos_sin_bodega($id_bodega) {
        global $conexion;
        $query = "SELECT id_producto, nombre_producto FROM productos WHERE id_producto NOT IN (SELECT id_producto FROM productosbodegas WHERE id_bodega=$id_bodega)";
        $result = mysqli_query($conexion, $query);
    
        if (mysqli_num_rows($result) > 0) {
            $no_productos = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $no_productos[] = $row;
            }
            return $no_productos;
        } else {
            return null;
        }
    }

    // Verificar si se ha enviado el formulario de editar producto
    if (isset($_POST['actualizar_stock'])) {
        $id_producto = $_POST['id_producto'];
        $id_bodega = $_POST['id_bodega'];
        $stock = $_POST['nuevo_stock'];
        actualizar_stock_producto_bodega($id_producto,  $id_bodega,  $stock);
        $alerta = "Se actualizo el stock del producto con id $id_producto y bodega con id $bodega.";
        $color ="success";
        header("Location: index.php?view=stock&alerta=$alerta&color=$color");
        exit();  
    }

    // Verificar si se ha enviado el formulario de eliminar producto
    if (isset($_POST['eliminar_producto_bodega'])) {
        $id_producto = $_POST['id_producto'];
        $id_bodega = $_POST['id_bodega'];
        eliminar_producto_bodega($id_producto, $id_bodega);
        $alerta = "Se elimino el producto.";
        $color ="success";
        header("Location: index.php?view=stock&alerta=$alerta&color=$color");
        exit();
    }
?>
