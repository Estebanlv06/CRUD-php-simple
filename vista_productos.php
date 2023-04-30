<?php
    require_once('modulo_producto.php');
    $productos = consultar_producto();

    if ($productos != null) {
        foreach ($productos as $producto) {
            echo "<tr>";
            echo "<td>".$producto['id_producto']."</td>";
            echo "<td>".$producto['nombre_producto']."</td>";
            echo "<td>".$producto['detalle_producto']."</td>";
            echo "<td>";
            echo "<button type='button' onclick='openModal(".$producto['id_producto'].")'>Editar</button>";
            echo "<form action='' method='POST'>";
            echo "<input type='hidden' name='id' value='".$producto['id_producto']."'>";
            echo "<button type='submit' name='eliminar_producto'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay productos registrados.</td></tr>";
    }

    
    mysqli_close($conexion);
?>