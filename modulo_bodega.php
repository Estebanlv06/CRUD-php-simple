<?php

    // Archivo de conexión
    include('conexion.php');

    // Función de ingreso
    function insertar_bodega($nombre) {
        global $conexion;
        $query = "INSERT INTO bodegas (nombre_bodega) VALUES ('$nombre');";
        if (mysqli_query($conexion, $query)) {
            echo "<script>alert('Se ha agregado una nueva bodega');</script>";
        } else {
            echo "<script>alert('Error: ".mysqli_error($conexion)."');</script>";
        }
    }

    // Función de actualización
    function actualizar_bodega($id_bodega, $nombre) {
        global $conexion;
        if(!empty($id_bodega)) {
            $query = "UPDATE bodegas SET nombre_bodega='$nombre' WHERE id_bodega=$id_bodega";
            if (mysqli_query($conexion, $query)) {
                echo "Se ha actualizado la bodega";
            } else {
                echo "Error: ".$query."<br>".mysqli_error($conexion);
            }
        } else {
            echo "Error: ID de bodega no válido";
        }
    }
    

    // Función de eliminación
    function eliminar_bodega($id_bodega) {
        global $conexion;
        $query = "DELETE FROM bodegas WHERE id_bodega=$id_bodega";
        if (mysqli_query($conexion, $query)) {
            echo "Se ha eliminado la bodega";
        } else {
            echo "Error: ".$query."<br>".mysqli_error($conexion);
        }
    }

    // Función de consulta
    function consultar_bodega() {
        global $conexion;
        $query = "SELECT * FROM bodegas;";
        ## $query = "SELECT * FROM tabla_bodegas";
        $result = mysqli_query($conexion, $query);
        $bodegas = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $bodegas[] = $row;
        }
        return $bodegas;
        
    }

    function consultar_bodega_por_id($id_bodega) {
        global $conexion;
        $query = "SELECT * FROM bodegas WHERE id_bodega = $id_bodega;";
        $result = mysqli_query($conexion, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    function buscar_id_bodega($id_bodega){
        global $conexion;
        $query = "SELECT id_bodega FROM productosbodegas WHERE id_bodega = $id_bodega;";
        $result = mysqli_query($conexion, $query);
        if (mysqli_num_rows($result) == 0) {
            return false; // No se encontraron registros
        }
        return true; // Se encontraron registros
    }

    // Verificar si se ha enviado el formulario de editar bodega
    if (isset($_POST['agregar_bodega'])) {
        $nombre = $_POST['nombre'];
        insertar_bodega($nombre);
        $alerta = "Se inserto una nueva bodega.";
        $color ="success";
        header("Location: index.php?view=bodegas&alerta=$alerta&color=$color");
        exit();
        
    }

    // Verificar si se ha enviado el formulario de editar bodega
    if (isset($_POST['editar_bodega'])) {
        $id_bodega = $_POST['id_bodega'];
        $nombre = $_POST['nombre_bodega'];
        actualizar_bodega($id_bodega, $nombre);
        $alerta = "Se actualizo la bodega.";
        $color ="success";
        header("Location: index.php?view=bodegas&alerta=$alerta&color=$color");
        exit();
    }

    // Verificar si se ha enviado el formulario de eliminar bodega
    if (isset($_POST['eliminar_bodega'])) {
        $id_bodega = $_POST['id_bodega'];
        if(buscar_id_bodega($id_bodega)==true){
            $alerta = "No se puede eliminar la bodega.";
            $color ="danger";
            header("Location: index.php?view=bodegas&alerta=$alerta&color=$color");
            exit();
        }else{ 
            eliminar_bodega($id_bodega);
            $alerta = "Se elimino la bodega.";
            $color ="success";
            header("Location: index.php?view=bodegas&alerta=$alerta&color=$color");
            exit();
        }
    }
?>